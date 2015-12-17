var app = angular.module('myApp', ['ui.bootstrap']);

app.controller('customersCrtl', function ($scope, $http, $timeout) {
    $http.get('ajax/getContentPage1.php').success(function(data) {
        $scope.list = data[0];
        $scope.filteredItems =data[1];
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 500;
        $scope.totalItems = data[1];
    });
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
        $scope.requestData();

    };
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
        $scope.requestData();
    };
    $scope.filterType = "$";
    $scope.multi = "";
    $scope.updateType = function() {
        $scope.filterType = $scope.selectedItem.code;
        $scope.requestData();
        //alert($scope.filterType);
    };
    $scope.changetext = function() {
        $scope.requestData();
    };

    $scope.changepagesize = function() {
        $scope.requestData();
        if($scope.entryLimit == '0')
        {
            $scope.currentPage = 1;
        }

    };
    $scope.minfilter = '1990-1-1';
    $scope.maxfilter = '2200-1-1';
    $scope.startfilter = function(input) {
        if(input=='') $scope.minfilter = '1990-1-1';
        else $scope.minfilter = input;
        $scope.requestData();
    }
    $scope.endfilter = function(input) {
        if(input=='') $scope.maxfilter = '2200-1-1';
        else $scope.maxfilter = input;
        $scope.requestData();
    }
    $scope.requestData =function() {
        $http({
            method: 'POST',
            url: "ajax/getContentPage1Ajax.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $.param({
                currentPage:$scope.currentPage,
                entryLimit: $scope.entryLimit,
                predicate:$scope.predicate,
                reverse:$scope.reverse,
                minfilter:$scope.minfilter,
                maxfilter:$scope.maxfilter,
                textsearch:$scope.multi,
                filterType:$scope.filterType
            })
            }).success(function(data) {
                $scope.list = data[0];
                $scope.filteredItems =data[1];
                $scope.totalItems = data[1];
            });
    }
    $scope.sizes = [ {code: '$', name: 'Against all fields'},
        {code: 'r.id', name: 'id'},
        {code: 'r.startPoint', name: 'startPoint'},
        {code: 's.name', name: 'startpoint_name'},
        {code: 'r.endPoint', name: 'endPoint'},
        {code: 'j.name', name: 'destination_name'},
        {code: 'r.building', name: 'building'},
        {code: 'b.name', name: 'build_name'},
        {code: 'r.level', name: 'level'},
        {code: 'r.type', name: 'type'},
        {code: 'r.lang', name: 'lang'}
    ];

});