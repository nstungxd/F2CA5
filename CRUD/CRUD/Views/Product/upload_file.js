function UploadFileModel(url, callback) {

    var self = this;
    self.callback = callback;
    self.url = url;
    self.jqXHR;
    self.resultStatus = 0;
    self.listUpload;

    // Làm mới form Upload
    self.clearUpload = function () {
        $('#progress .progress-bar').css('width', 0 + '%').html(0 + '%');
        $('.body-table-upload').html('');
        $('#upload-data_import_type').val('1');
        $('#resultStatus').val("0");

        $(".fileupload-buttonbar .fileinput-button").show();
    }
    // Nạp dữ liệu tất cả các file up lên
    self.uploadAll = function () {
        self.listUpload = $('.body-table-upload .upload');
        self.uploadPerFile();
    }

    self.uploadPerFile = function () {
        if (self.listUpload) {
            self.listUpload.each(function (index, el) {
                $(this).addClass('hidden');
                $(this).before($('<img style="width:18px;" src="/Resources/img/wait16.gif" title="Chờ xử lý..."/>'));
                $(this).parent().find('.delete').addClass('hidden');
                el.click(); // thuc hien upload
            });
        }
    }

    self.OpenUploadFile = function () {
        self.clearUpload();
        $('#modalUploadFile').modal('show');
    }

    self.init = function () {
        var ul = $('#table-upload');
        self.jqXHR = $('#fileupload').fileupload({
            url: self.url,
            //limitMultiFileUploads: 1,
            sequentialUploads: true,
            formData: function (form) {
                return form.serializeArray();
            },
            // Khi bấm nút Thêm
            add: function (e, data) {
                $('#progress .progress-bar').css('width', 0.1 + '%').html('0%');

                var tpl = $('<tr></tr>');
                tpl.append('<td>' + data.files[0].name + '</td>');
                tpl.append('<td>' + self.formatFileSize(data.files[0].size) + '</td>');

                var td = $('<td>');
                data.context = $('<button/>').appendTo(td).append($('<i/>').addClass('glyphicon glyphicon-upload')).addClass('btn btn-primary btn-xs upload').click(function () {
                    $('#progress .progress-bar').css('width', 0 + '%').html(0 + '%');
                    data.context = td.html('').append($('<img class="img-responsive" style="max-width:18px;" src="/Resources/img/loading.gif" title="Đang xử lý..."/>'));

                    var jqXHR = data.submit()
                            .error(function (jqXHR, textStatus, errorThrown) {
                                data.context = td.html('').append($('<span/>').text('Lỗi xử lý'));
                            })
                            .complete(function (result, textStatus, jqXHR) {
                                data.context = td.html('');
                                console.log(result);
                                try {
                                    var text = result.success > 0 ? "Thành công" : "Có lỗi";
                                    var error = result.message.replace("\n", " &#13; ");

                                    if (result.success > 0) {
                                        // set trang thai
                                        $('#resultStatus').val(result.success);

                                        // chuyen kieu import cua file thứ 2 trở đi thành append
                                        if ($('#upload-data_import_type').val() === '0')
                                            $('#upload-data_import_type').val("1");

                                        // refresh lại dữ liệu
                                        if (self.callback)
                                            self.callback();
                                    }

                                    // Hiển thị trạng thái trên table
                                    if (result.success > 0)
                                        data.context += td.append($('<span/>').text(text).attr("title", error)).css('font-weight', 'bold').css('color', '#515151');
                                    else
                                        data.context += td.append($('<span class="text-danger mg0"/>').text(text).attr("title", error)).css('font-weight', 'bold').css('color', '#d43f3a');

                                } catch (e) {
                                    data.context += td.append($('<span/>').text('Lỗi đọc kết quả trả về.'));
                                }
                            });
                });

                data.context = $('<a/>').appendTo(td).append($('<i/>').addClass('glyphicon glyphicon-trash')).addClass('btn btn-default btn-xs delete').click(function () {
                    data.abort();
                    $(".fileupload-buttonbar .fileinput-button").show();
                });
                tpl.append(td);

                data.context = tpl.prependTo(ul);

                tpl.find('.delete').click(function () {
                    tpl.fadeOut(function () {
                        tpl.remove();

                    });
                });

                $(".fileupload-buttonbar .fileinput-button").hide();
            },

            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css('width', progress + '%').html('Tải tệp dữ liệu lên ' + progress + '%');
            },
        });
    }

    self.formatFileSize = function (bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }
        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }
        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }
        return (bytes / 1000).toFixed(2) + ' KB';
    }
}