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
    <title>PAGE1</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/angular.min.js"></script>
    <script src="js/ui-bootstrap-tpls-0.10.0.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/html5csv.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="css/style.css" rel="stylesheet"
          type="text/css"/>
    <script src="js/bootstrap.min.js"></script>

    <script src="app/app1.js">
    </script>
</head>
<body>
<div ng-controller="customersCrtl">
    <div class="container">
        <h2>Report 1</h2>
            <div class="row">
                <div class="col-md-2">PageSize:
                    <select ng-model="entryLimit" ng-change="changepagesize()" class="form-control">
                        <option value="500">500</option>
                        <option value="0">All</option>
                    </select>

                    
                </div>
            <div class="col-md-3">Filter:<input type="text" ng-model="multi" ng-change="changetext()" placeholder="Filter" class="form-control"/></div>
            <div class="col-md-3">Column :
                <select ng-options="size as size.name for size in sizes " class="form-control" ng-model="selectedItem" ng-change="updateType()" ng-init="selectedItem = sizes[0]">
                </select>
            </div>
                <div class="col-md-2">Start date :
                    <input type="date"  ng-model="startdateFilter"  ng-change="startfilter(startdateFilter)" class="form-control" />
                    </div>
                <div class="col-md-2">End date :
                    <input type="date"  ng-model="enddateFilter"  ng-change="endfilter(enddateFilter)" class="form-control" />
                    </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-12" ng-show="filteredItems > 0">
                    <table class="table table-striped table-bordered" id="export">
                        <thead>
                        <th>id&nbsp;<a ng-click="sort_by('id');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>startPoint&nbsp;<a ng-click="sort_by('startPoint');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>startpoint_name&nbsp;<a ng-click="sort_by('startpoint_name');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>endPoint&nbsp;<a ng-click="sort_by('endPoint');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>destination_name&nbsp;<a ng-click="sort_by('destination_name');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>building&nbsp;<a ng-click="sort_by('building');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>build_name&nbsp;<a ng-click="sort_by('build_name');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>level&nbsp;<a ng-click="sort_by('level');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>type&nbsp;<a ng-click="sort_by('type');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>lang&nbsp;<a ng-click="sort_by('lang');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>time&nbsp;<a ng-click="sort_by('time');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        </thead>
                        <tbody>
                        <tr ng-repeat="data in list ">
                            <td>{{data.id}}</td>
                            <td>{{data.startPoint}}</td>
                            <td>{{data.startpoint_name}}</td>
                            <td>{{data.endPoint}}</td>
                            <td>{{data.destination_name}}</td>
                            <td>{{data.building}}</td>
                            <td>{{data.build_name}}</td>
                            <td>{{data.level}}</td>
                            <td>{{data.type}}</td>
                            <td>{{data.lang}}</td>
                            <td>{{data.time}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" ng-show="filteredItems == 0">
                <div class="col-md-12">
                    <h4>No records found</h4>
                </div>
                </div>


                <div class="col-md-12" ng-show="filteredItems > 0">
                    <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
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
