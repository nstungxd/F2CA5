var app = angular.module('myApp', ['ui.bootstrap']);

app.controller('customersCrtl', function ($scope, $http, $timeout) {
    $http.get('ajax/getContent3.php').success(function(data) {

        $scope.list = data[0];
        $scope.filteredItems = $scope.list.length;

        $scope.list1 = data[1];
        $scope.filteredItems1 = $scope.list1.length;

        $scope.list2 = data[2];
        $scope.filteredItems2 = $scope.list2.length;

    });
    $scope.sort_by = function(predicate) {
        $scope.typeTable = '0';
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;

        $scope.predicateColumn =$scope.predicate;
        $scope.reverseColumn =$scope.reverse;

        $scope.requestData();
    };
    $scope.sort_by1 = function(predicate) {
        $scope.typeTable = '1';
        $scope.predicate1 = predicate;
        $scope.reverse1= !$scope.reverse1;

        $scope.predicateColumn =$scope.predicate1;
        $scope.reverseColumn =$scope.reverse1;

        $scope.requestData();
    };
    $scope.sort_by2 = function(predicate) {
        $scope.typeTable = '2';
        $scope.predicate2 = predicate;
        $scope.reverse2 = !$scope.reverse2;

        $scope.predicateColumn =$scope.predicate2;
        $scope.reverseColumn =$scope.reverse2;

        $scope.requestData();
    };
    $scope.getTotal = function(){
        var total = 0;
        for(var i = 0; i < $scope.list.length; i++){
            var product = $scope.list[i];
            total += parseInt(product.cStartPoint);
        }
        return total;
    }
    $scope.getTotal1 = function(){
        var total = 0;
        for(var i = 0; i < $scope.list1.length; i++){
            var product = $scope.list1[i];
            total += parseInt(product.cStartPoint);
        }
        return total;
    }
    $scope.getTotal2 = function(){
        var total = 0;
        for(var i = 0; i < $scope.list2.length; i++){
            var product = $scope.list2[i];
            total += parseInt(product.cStartPoint);
        }
        return total;
    }
    $scope.predicateColumn ='';
    $scope.reverseColumn ='';
    $scope.requestData =function() {
        $http({
            method: 'POST',
            url: "ajax/getContent3Ajax.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $.param({
                typeTable: $scope.typeTable,
                predicateColumn: $scope.predicateColumn,
                reverseColumn: $scope.reverseColumn
            })
        }).success(function(data) {
                if(data[0] != null)
                {
                    $scope.list = data[0];
                    $scope.filteredItems = $scope.list.length;
                }
                if(data[1] != null)
                {
                    $scope.list1 = data[1];
                    $scope.filteredItems1 = $scope.list1.length;
                }
                if(data[2] != null)
                {
                    $scope.list2 = data[2];
                    $scope.filteredItems2 = $scope.list2.length;
                }
            });
    };
});