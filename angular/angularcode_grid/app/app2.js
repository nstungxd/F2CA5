var app = angular.module('myApp', ['ui.bootstrap']);

app.controller('customersCrtl', function ($scope, $http, $timeout) {
    $http.get('ajax/getContent.php').success(function(data) {

        $scope.list = data[0];
        $scope.filteredItems = $scope.list.length;

        $scope.list1 = data[1];
        $scope.filteredItems1 = $scope.list1.length;

        $scope.list2 = data[2];
        $scope.filteredItems2 = $scope.list2.length;

        $scope.list3 = data[3];
        $scope.filteredItems3 = $scope.list3.length;
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
    $scope.sort_by3= function(predicate) {
        $scope.typeTable = '3';
        $scope.predicate3 = predicate;
        $scope.reverse3 = !$scope.reverse3;

        $scope.predicateColumn =$scope.predicate3;
        $scope.reverseColumn =$scope.reverse3;

        $scope.requestData();
    };
    $scope.typeTable ='';
    $scope.predicateColumn ='';
    $scope.reverseColumn ='';
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
            total += parseInt(product.cLang);
        }
        return total;
    }
    $scope.getTotal2 = function(){
        var total = 0;
        for(var i = 0; i < $scope.list2.length; i++){
            var product = $scope.list2[i];
            total += parseInt(product.cHighlight);
        }
        return total;
    }
    $scope.getTotal3 = function(){
        var total = 0;
        for(var i = 0; i < $scope.list3.length; i++){
            var product = $scope.list3[i];
            total += parseInt(product.cEndPoint);
        }
        return total;
    }
    $scope.minfilter = '1990-1-1';
    $scope.maxfilter = '2200-1-1';
    $scope.startfilter = function(input) {
        if(input=='') $scope.minfilter = '1990-1-1';
        else $scope.minfilter = input;
        $scope.typeTable =''
        $scope.requestData();
    };
    $scope.endfilter = function(input) {
        if(input=='') $scope.maxfilter = '2200-1-1';
        else $scope.maxfilter = input;
        $scope.typeTable =''
        $scope.requestData();
    };
    $scope.requestData =function() {
        $http({
            method: 'POST',
            url: "ajax/getContent1.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $.param({
                startdate:$scope.minfilter,
                enddate: $scope.maxfilter,
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
                if(data[3] != null)
                {
                $scope.list3 = data[3];
                $scope.filteredItems3 = $scope.list3.length;
                }
            });
    };
});