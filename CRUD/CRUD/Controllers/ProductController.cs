﻿using CRUD.Models;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using CRUD.Utils;
using Newtonsoft.Json;

namespace CRUD.Controllers
{
    //[Validate]
    //[Authorize]
    public class ProductController : BaseController
    {
        //
        // GET: /Product/
        public ActionResult Index()
        {
            return View();
        }
        public ActionResult GetList(int pageIndex = 1, int pageSize = 0)
        {
            string tt = string.Empty;
            string keyword = string.Empty;
            ResultModel model = new ResultModel();
            try
            {
                var datas = NhanSuListViewModel.LayDuLieuTheoTrangThai(tt, keyword, pageIndex, pageSize);
                model.data = datas;
                model.success = 1;
            }
            catch (Exception ex)
            {
                model.success = 0;
                model.message = ex.ShowException();
            }

            var list = JsonConvert.SerializeObject(model,
                Formatting.None,
                new JsonSerializerSettings()
                {
                    ReferenceLoopHandling = Newtonsoft.Json.ReferenceLoopHandling.Ignore
                });
            return Content(list, "application/json");
            //return Json(model, JsonRequestBehavior.AllowGet);
        }

        #region Xu ly ImportExcel Nhan su

        [HttpPost]
        public ActionResult NapDuLieu(HttpPostedFileBase files,
            string resultStatus)
        {
            string message;
            ResultModel model = new ResultModel();
            string path = "";
            try
            {
                if (files != null)
                {
                    // thuc hien thao tac tai day
                    if (files.ContentLength > 0)
                    {
                        string fileExtension = Path.GetExtension(files.FileName);
                        if (fileExtension == ".xls" || fileExtension == ".xlsx")
                        {
                            #region Xử lý file

                            string folder = "~/Uploads/Files/" + DateTime.Now.ToString("yyyyMMdd");
                            // Kiểm tra thư mục lưu trữ, nếu chưa có thì tạo                            
                            if (!Directory.Exists(Server.MapPath(folder)))
                                Directory.CreateDirectory(Server.MapPath(folder));

                            path = string.Concat(Server.MapPath(folder + "/" + DateTime.Now.ToString("yyyyMMddHHmmssfff") + files.FileName));
                            // Nếu đã tồn tại file trong thư mục thì xóa
                            if (System.IO.File.Exists(path))
                                System.IO.File.Delete(path);

                            files.SaveAs(path);
                            #endregion
                            var success = NhanSuModel.NapDuLieu(path, resultStatus, out message);
                            if (success == true)
                                model.success = 1;
                            else
                                model.success = 0;

                            model.message = message;
                        }
                        else
                        {
                            model.message = "Tệp tin không đúng định dạng (định dạng .xls, hoặc .xlsx)";
                            model.success = 0;
                        }
                    }
                }
                else
                {
                    model.success = 0;
                    model.message = "Không tìm thấy file";
                }
            }
            catch (Exception ex)
            {
                model.success = 0;
                model.message = "Lỗi cập nhật.";
            }
            return Json(model);
        }

        #endregion
    }
}