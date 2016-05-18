var model = new function () {
    var self = this;
    var LIST_MODE = "product-list";
    var DETAIL_MODE = "product-detail";

    self.mode = LIST_MODE;
    self.List = new ListModel(self);
    self.Detail = new DetailModel(self);

    self.activeList = function (refresh) {
        if (refresh)
            //self.List.fetchData();
        self.switchMode(LIST_MODE);
    }

    // active detail view
    self.activeDetail = function (id) {
        //self.Detail.detail(id)
        self.switchMode(DETAIL_MODE);
    }

    // switch view
    self.switchMode = function (mode) {
        if (self.mode == mode)
            return;
        self.mode = mode;
        if (self.mode == LIST_MODE) {
            $("#product-detail").hide();
            $("#product-list").show();
        }
        else if (self.mode == DETAIL_MODE) {
            $("#product-list").hide();
            $("#product-detail").show();
        }
    }
}();
$(document).ready(function () {
    // active list view
    model.activeList(true);
});