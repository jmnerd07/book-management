(function(){
	'use strict';
	angular
	.module('BookManagementApp')
	.directive('ngPublishersList', function($compile, PublishersListSuggestService){
		return {
			restrict: 'A',
			scope: {
				ngModel: '=',
				ngPublishersList: '@'
			},
			link: function(scope, iElement, iAttrs) {
				scope.$watch('ngPublishersList', function($new){
					PublishersListSuggestService.showList( scope.ngModel,  $new, scope, $('.publishers-autosuggest')[0]);
					$compile(iElement.contents())(scope.$new());
				})

			}
		}
	});
})();