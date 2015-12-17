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
    <title>PAGE3</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/angular.min.js"></script>
    <script src="js/ui-bootstrap-tpls-0.10.0.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/html5csv.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <script src="js/bootstrap.min.js"></script>
    <script src="app/app3.js">
    </script>
</head>
<div ng-controller="customersCrtl">

    <div class="container">
        <div class="col-md-4" ng-show="filteredItems > 0">
            <h3>Count of startPoint Today</h3>
            <h3><?php echo date('Y-m-d'); ?></h3>
            <table class="table table-striped table-bordered" >
                <thead>
                <th>Start Point&nbsp;<a ng-click="sort_by('startPoint');"><i
                        class="glyphicon glyphicon-sort"></i></a></th>
                <th>Total&nbsp;<a ng-click="sort_by('cStartPoint');"><i
                        class="glyphicon glyphicon-sort"></i></a></th>
                </thead>
                <tbody>
                <tr ng-repeat="data in list" >
                    <td>{{data.startPoint}}</td>
                    <td>{{data.cStartPoint}}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td><b>Grand Total</b></td>
                    <td>{{ getTotal() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-4" ng-show="filteredItems == 0">
            <div class="col-md-3">
                <h4>No startPoint found today</h4>
            </div>
        </div>

        <div class="col-md-4" ng-show="filteredItems1 > 0">
            <h3>Count of startPoint yesterday</h3>
            <h3><?php echo date('Y-m-d', strtotime('-1 days')); ?></h3>
            <table class="table table-striped table-bordered" >
                <thead>
                <th>Start Point&nbsp;<a ng-click="sort_by1('startPoint');"><i
                        class="glyphicon glyphicon-sort"></i></a></th>
                <th>Total&nbsp;<a ng-click="sort_by1('cStartPoint');"><i
                        class="glyphicon glyphicon-sort"></i></a></th>
                </thead>
                <tbody>
                <tr ng-repeat="data in list1" >
                    <td>{{data.startPoint}}</td>
                    <td>{{data.cStartPoint}}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td><b>Grand Total</b></td>
                    <td>{{ getTotal1() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-4" ng-show="filteredItems1 == 0">
            <div class="col-md-3">
                <h4>No startPoint found yesterday</h4>
            </div>
        </div>


        <div class="col-md-4" ng-show="filteredItems2 > 0">
            <h3>Count of startPoint on 7 day ago</h3>
            <h3><?php echo date('Y-m-d', strtotime('-7 days')); ?></h3>
            <table class="table table-striped table-bordered" >
                <thead>
                <th>Start Point&nbsp;<a ng-click="sort_by2('startPoint');"><i
                        class="glyphicon glyphicon-sort"></i></a></th>
                <th>Total&nbsp;<a ng-click="sort_by2('cStartPoint');"><i
                        class="glyphicon glyphicon-sort"></i></a></th>
                </thead>
                <tbody>
                <tr ng-repeat="data in list2" >
                    <td>{{data.startPoint}}</td>
                    <td>{{data.cStartPoint}}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td><b>Grand Total</b></td>
                    <td>{{ getTotal2() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-4" ng-show="filteredItems2 == 0">
            <div class="col-md-3">
                <h4>No startPoint found on 7 day ago</h4>
            </div>
        </div>


      </div>
</div>