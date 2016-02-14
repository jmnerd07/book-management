/**
 * Created by JM on 1/24/2016.
 */
/** @jsx React.DOM */
(function(){
	'use strict';
	angular
		.module('BookManagementApp')
		.controller('AuthorsController', function($scope, $http){
			$scope.authors = [];
			$scope.hide_author_suggestions = true;
			$scope.toggleAuthorsSuggestion = function(val) {
				$scope.hide_author_suggestions = val;
			};
			$http.get('/management/author/async/all').success(function(data) {
				$scope.authors = data;
			})
		});
})();