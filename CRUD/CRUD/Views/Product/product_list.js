function ListModel(parent) {
    var self = this;
    self.parent = parent;

    self.pageSize = 10;
    self.items = null;
    self.paging_options = {
        bootstrapMajorVersion: 3,
        alignment: 'right',
        currentPage: 1,
        totalPages: 1,
        onPageChanged: function (event, oldPage, newPage) {
            self.fetchData(newPage, self.pageSize);
        }
    };
    self.fetchData = function (pageIndex, pageSize) {
        if (!pageIndex || pageIndex <= 0) pageIndex = 1;
        if (!pageSize || pageSize <= 0) pageSize = self.pageSize;

        var data = {};
        $.ajax({
            url: GenerateUrl("/Product/GetList?pageIndex=" + pageIndex + "&pageSize=" + pageSize),
            data: JSON.stringify(data),
            type: "Post",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            timeout: defaultTimeout,
            beforeSend: function () {
                messageUtil.ShowAlert(2);
            },
            success: function (result) {
                messageUtil.HideAlert();
                //if (result.success != 0) {
                //    self.setPaging(result.data.pageIndex, result.data.pageSize, result.data.total);
                //    self.parent.Info.setData(result.data.Info);
                //    self.setData(result.data.Items);
                //}
                //else {
                //    messageUtil.ShowAlert(-1, "Lỗi truy vấn");
                //}
            },
            error: function (x, y, z) {
                if (y != "abort")
                    messageUtil.ShowAlert(-1, z);
            }
        });
    }

    self.setPaging = function (pageIndex, pageSize, total) {
        var max = (pageIndex) * pageSize;
        if (total < max) max = total;
        $("#paging_info").children(".max").html(max);
        $("#paging_info").children(".total").html(total);
        self.paging_options.currentPage = pageIndex;
        self.paging_options.totalPages = Math.ceil(total / pageSize);
        if (self.paging_options.totalPages > 0) {
            //$("#paging_info").children(".min").html((pageIndex - 1) * pageSize + 1);
            $("#paging").bootstrapPaginator(self.paging_options);
        }
        else {
            //$("#paging_info").children(".min").html(0);
            self.paging_options.currentPage = 1;
            self.paging_options.totalPages = 1;
            $("#paging").bootstrapPaginator(self.paging_options);
        }
    }
}