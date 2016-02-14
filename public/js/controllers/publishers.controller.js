(function(){
	'use strict';
	angular
	.module('BookManagementApp')
	.controller('PublishersController', function($scope, $http){
		$scope.publishers = [];
		$scope.hide_publisher_suggestions = true;
		$scope.togglePublisherSuggestion = function(val) {
			$scope.hide_publisher_suggestions = val;
		};
		$http.get('/management/publisher/async/all').success(function(data) {
			$scope.publishers = data;
		})
	});
})();