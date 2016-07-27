(function(){
	angular
		.module('BookManagementApp')
		// On click "Add new genre" button
		.directive('ngCreateNewGenre', function(ModalBoxFactory, $compile) {
			return {
				restrict: 'C',
				link: function(scope, elem, attrs) {
					elem.on('click', function() {
						ModalBoxFactory.load({
							title: "Create New Genre",
							body: [
									'<form data-ng-init="genre.name = \'\'; genre.description=\'\'; genre.parent_genre_id=0;">',
							            '<div class="form-group genre-name-group">',
							              '<label for="genre-name" class="form-control-label"><sup class="text-danger">*</sup> Genre Name:</label>',
							              '<input type="text" data-ng-model="genre.name" class="form-control" id="genre-name">',
							              '<div class="notif-genre-name"></div>',
							            '</div>',
							            '<div class="form-group">',
							              '<label for="parent-genre" class="form-control-label">Parent Genre <small class="text-muted">(optional)</small>:</label>',
							              '<select id="parent-genre" data-ng-options="g.id as g.name for g in genres track by g.id" class="form-control ng-genres-list-options" data-ng-genre-list="genres" data-ng-model="genre.parent_genre_id">',
							              //'<select class="form-control ng-genres-list-options" data-ng-init="genres=[];" data-ng-genre-list="genres">',
							              	'<option value="">-- Choose genre --</option>',
							              '</select>',
							            '</div>',
							            '<div class="form-group">',
							              '<label for="description-text" class="form-control-label">Description <small class="text-muted">(optional)</small>:</label>',
							              '<textarea class="form-control" data-ng-model="genre.description" id="description-text"></textarea>',
							            '</div>',
							        '</form>'
								].join(''),
							footer: [
									'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> ',
									'<button type="submit" class="btn btn-primary ng-save-genre" data-ng-genre-data="genre">Save</button>'
								].join("")

						});
						$compile(angular.element('.modal'))(scope);
					})
				}
			}
		})
		// On click edit genre button
		.directive('ngButtonEditGenre', function(ModalBoxFactory, $compile){
			return {
				restrict: 'C',
				scope: {
					genreId: '@'
				},
				link: function(scope, elem, attrs) {
					elem.on('click', function(){ 
						ModalBoxFactory.load({
							title: "Edit Genre",
							body: [
									'<div align="center" data-genre-id="'+ scope.genreId +'" class="ng-load-genre-details">',
										'<h3 class="text-muted">Please wait</h3>',
										'<small class="text-muted">(Fetching Genre Details)</small>',
									'</div>'
								].join(''),
							footer: ""
						})
						$compile(angular.element('.modal'))(scope);
					});
				}
			};
		})
		.directive('ngLoadGenreDetails', function($http){
			return {
				restrict: 'C',
				scope: {
					genreId: '@'
				},
				link: function(scope, elem, attr) {
					$http({
						method: 'POST',
						headers: {
							'X-Requested-With':'XMLHttpRequest'
						},
						url: 'genres/async/edit',
						data: {_requestType: 'LIST'}
					}).then(
						function(r) {
							if(r.data.rows > 1)
							{
								scope.ngGenreList = r.data.data;
							}
						},
						function(r) {
							console.log(r)
						}
					);
				}
			};
		})
		// Loads all Parent Genre in dropdown of Creating New Genre
		.directive('ngGenresListOptions', function($http, $compile){
			return {
				restrict: 'C',
				scope: {
					ngGenreList: '='
				},
				link: function(scope, elem, attrs) {
					var genreId = scope.genreId;
					$http({
						method: 'POST',
						headers: {
							'X-Requested-With':'XMLHttpRequest'
						},
						url: 'genres/async/list',
						data: {_requestType: 'LIST'}
					}).then(
						function(r) {
							if(r.data.rows > 1)
							{
								scope.ngGenreList = r.data.data;
							}
						},
						function(r) {
							console.log(r)
						}
					);
				}

			}
		})
		.directive('ngSaveGenre', function(ModalBoxFactory, $http){
			return {
				restrict: 'C',
				scope: {
					genreData: "=ngGenreData"
				},
				link: function(scope, elem, attrs) {
					elem.on('click', function(){
						// remove all notification messages
						angular.element('.notif-genre-name').children().remove();

						// remove success/error border color
						angular.element('.genre-name-group').removeClass('has-danger').removeClass('has-success');

						// disable textfield and remove icons
						angular.element('.genre-name-group').find('.form-control').attr('disabled', 'disabled').removeClass('form-control-danger').removeClass('form-control-success');
						
						var postData = scope.genreData;
						postData._requestType = 'VALIDATE';
						$http({
							method: 'POST',
							headers: {
								'X-Requested-With': 'XMLHttpRequest'
							},
							url: 'genres/async/new-genre',
							data: postData
						}).then(
							function(r) { // on success
								// If no error found
								if(typeof r.data !== "object")
								{
									console.info('Unknown error');
									return;
								}
								if(r.data.length === 0)
								{
									// Remove notification messages
									angular.element('.notif-genre-name').children().remove();

									// Add field border color
									angular.element('.genre-name-group').addClass('has-success');

									// Show success icon
									angular.element('.genre-name-group').find('.form-control').removeAttr('disabled', 'disabled').addClass('form-control-success');

									ModalBoxFactory.load({
										title: "Create New Genre - Success",
										body: [
												'<h3 class="text-success">Request successful</h3>',
												'<p class="text-success">New genre successfully created.</p>'
											].join(''),
										footer: ""
									})
									window.location.href = window.location.href;
								}
							},
							function(r) { // on error

								// If validation fails
								if(r.status == 422)
								{
									// if error messages are empty
									if(!r.data)
									{
										return;
									}
									
									// notification messages
									var notificationMessage = "";

									// get all array of notification messages
									for(var key in r.data)
									{
										if(r.data[key])
										{
											r.data[key].forEach(function(v, i){
												notificationMessage += '<p><small class="text-danger">' + v + '</small></p>';
											})
											if(key !== '_requestType')
											{
												// Show notification message
												angular.element('.notif-genre-name').html(notificationMessage);

												// Add field border color
												angular.element('.genre-name-group').addClass('has-danger');

												// Show error icon
												angular.element('.genre-name-group').find('.form-control').removeAttr('disabled', 'disabled').addClass('form-control-danger');
											}
										}
									}
								}
							}
						)
					})
				}
			}
		})
})();