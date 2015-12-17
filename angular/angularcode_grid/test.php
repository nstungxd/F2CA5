<!DOCTYPE html>
<html ng-app="myApp" ng-app lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        ul>li, a {
            cursor: pointer;
        }
    </style>
    <title>TUNGNS - DEMO</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/angular.min.js"></script>
    <script src="js/ui-bootstrap-tpls-0.10.0.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>
        var app = angular.module('myApp', ['ui.bootstrap']);
        app.filter('startFrom', function() {
            return function(input, start) {
                if (input) {
                    start = +start; //parse to int
                    return input.slice(start);
                }
                return [];
            }
        });
        app.controller('customersCrtl', function ($scope, $http, $timeout) {
            $http.get('ajax/getContent.php').success(function(data) {
                $scope.list = data[0];
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 5; //max no of items to display in a page
                $scope.filteredItems = $scope.list.length; //Initially for no filter
                $scope.totalItems = $scope.list.length;

            });
            $scope.filter = function() {
                $timeout(function() {
                    $scope.filteredItems = $scope.filtered.length;
                }, 10);
            };
            $scope.setPage = function(pageNo) {
                $scope.currentPage = pageNo;
            };
            $scope.sort_by = function(predicate) {
                $scope.predicate = predicate;
                $scope.reverse = !$scope.reverse;
            };
            $scope.filterType = "$";
            $scope.multi = "";
            $scope.changeFilterTo = function(pr) {
                $scope.filterType = pr;
            }
            $scope.getFilter = function() {
                switch ($scope.filterType) {
                    case 'id':
                        return {id: $scope.multi};
                    case 'startPoint':
                        return {startPoint: $scope.multi};
                    default:
                        return {$: $scope.multi}
                }
            }
        });

    </script>
</head>
<body>
<div ng-controller="customersCrtl">
    <div class="container">
        <div class="col-md-2">PageSize:
            <select ng-model="entryLimit" class="form-control">
                <option>5</option>
                <option>10</option>
                <option>15</option>
            </select>
        </div>
        <div class="col-md-3">Filter:
            <input type="text" ng-model="multi" ng-change="filter()" placeholder="Filter" class="form-control"/>by {{filterType}}
        </div>
        <div class="col-md-3">
            <ul>
                <li><a href="" ng-click="changeFilterTo('id')">By id</a></li>
                <li><a href="" ng-click="changeFilterTo('startPoint')">By startPoint</a></li>
            </select>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12" ng-show="filteredItems > 0">
                <table class="table table-striped table-bordered">
                    <thead>
                    <th>ID&nbsp;<a ng-click="sort_by('id');"><i
                            class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Start Point&nbsp;<a ng-click="sort_by('startPoint');"><i
                            class="glyphicon glyphicon-sort"></i></a></th>
                    <!--<th>DateTime&nbsp;<a ng-click="sort_by('time');"><i class="glyphicon glyphicon-sort"></i></a>-->
                    </th>

                    </th>
                    </thead>
                    <tbody>
                    <tr ng-repeat="data in filtered = (list | filter: getFilter() | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                        <td>{{data.id}}</td>
                        <td>{{data.startPoint}}</td>
                        <!--<td>{{data.time}}</td>-->
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12" ng-show="filteredItems == 0">
                <div class="col-md-12">
                    <h4>No route log found</h4>
                </div>
            </div>
            <div class="col-md-12" ng-show="filteredItems > 0">
                <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true"
                     total-items="filteredItems" items-per-page="entryLimit" class="pagination-small"
                     previous-text="&laquo;" next-text="&raquo;"></div>


            </div>
        </div>
    </div>
</div>
</body>
</html>