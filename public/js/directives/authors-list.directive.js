(function(){
	'use strict';
	angular
		.module('BookManagementApp')
		.directive('ngAuthorsList', function($compile, AuthorsListSuggestService){
			return {
				restrict: 'A',
				scope: {
					ngModel: '=',
					ngAuthorsList: '@'
				},
				link: function(scope, iElement, iAttrs) {
					scope.$watch('ngAuthorsList', function($new){
						AuthorsListSuggestService.showList( scope.ngModel,  $new, scope, $('.authors-autosuggest')[0]);
						$compile(iElement.contents())(scope.$new());
					})

				}
			}
		});
})();