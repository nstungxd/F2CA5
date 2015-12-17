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
    <title>PAGE2</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/angular.min.js"></script>
    <script src="js/ui-bootstrap-tpls-0.10.0.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/html5csv.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <script src="js/bootstrap.min.js"></script>
    <script src="app/app2.js">
    </script>
</head>
<body>
<div ng-controller="customersCrtl">
    <div class="container">
        <div class="row">
            <div class="col-md-3">Start Date:
            <input type="date"  ng-model="startdateFilter"  ng-change="startfilter(startdateFilter)"    />
            </div>
            <div class="col-md-3">End date:
                <input type="date" ng-model="enddateFilter"  ng-change="endfilter(enddateFilter)"  />
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-4" ng-show="filteredItems3 > 0">
                <h3>Count of destination_name</h3>
                <table class="table table-striped table-bordered" id="export">
                    <thead>
                    <th>Destination Name&nbsp;<a ng-click="sort_by3('o.name');"><i
                            class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Total&nbsp;<a ng-click="sort_by3('cEndPoint');"><i
                            class="glyphicon glyphicon-sort"></i></a></th>
                    </thead>
                    <tbody>
                    <tr ng-repeat="data in list3" >
                        <td>{{data.name}}</td>
                        <td>{{data.cEndPoint}}</td>
                    </tr>
                    </tbody>
                    <tr>
                        <td><b>Grand Total</b></td>
                        <td>{{ getTotal3() }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4" ng-show="filteredItems3 == 0">
                <div class="col-md-3">
                    <h4>No startPoint found</h4>
                </div>
            </div>
            
            <div class="col-md-3" ng-show="filteredItems > 0">
                <h3>Count of startPoint</h3>
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
            <div class="col-md-3" ng-show="filteredItems == 0">
                <div class="col-md-3">
                    <h4>No startPoint found</h4>
                </div>
            </div>
            <div class="col-md-2" ng-show="filteredItems1 > 0">
                <h3>Count of Lan</h3>
                <table class="table table-striped table-bordered">
                    <thead>
                    <th>Language&nbsp;<a ng-click="sort_by1('lang');"><i
                            class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Total&nbsp;<a ng-click="sort_by1('cLang');"><i
                            class="glyphicon glyphicon-sort"></i></a></th>
                    </thead>
                    <tbody>
                    <tr ng-repeat="data in list1" >
                        <td>{{data.lang}}</td>
                        <td>{{data.cLang}}</td>
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
            <div class="col-md-2" ng-show="filteredItems1 == 0">
                <div class="col-md-3">
                    <h4>No language found</h4>
                </div>
            </div>

            <div class="col-md-3" ng-show="filteredItems2 > 0">
                <h3>Count of HighLight</h3>
                <table class="table table-striped table-bordered">
                    <thead>
                    <th>HighLight&nbsp;<a ng-click="sort_by2('CAST(highlight AS CHAR)');"><i
                            class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Total&nbsp;<a ng-click="sort_by2('cHighlight ');"><i
                            class="glyphicon glyphicon-sort"></i></a></th>
                    </thead>
                    <tbody>
                    <tr ng-repeat="data in list2" >
                        <td>{{data.highlight}}</td>
                        <td>{{data.cHighlight}}</td>
                    </tr>
                    </tbody>
                    <tr>
                        <td><b>Grand Total</b></td>
                        <td>{{ getTotal2() }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3" ng-show="filteredItems2 == 0">
                <div class="col-md-3">
                    <h4>No HighLight found</h4>
                </div>
            </div>

        </div>
        </div>
    </div>
<script>
    $(document).ready(function() {

        $('#export').each(function() {
            var $table = $(this);

            var $button = $("<button type='button'>");
            $button.text("Export to CSV");
            $button.insertAfter($table);

            $button.click(function() {
                CSV.begin('table').download('Export.csv').go();
            });
        });
    })

</script>
</body>
</html>