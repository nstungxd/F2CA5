using CRUD.Models;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace CRUD.Controllers
{
    public class ProductController : Controller
    {
        //
        // GET: /Product/
        public ActionResult Index()
        {
            return View();
        }
        public ActionResult GetList(int pageIndex = 1, int pageSize = 0)
        {
            ResultModel model = new ResultModel();
            string message = "";
            try
            {
                model.data = new ProductModel().GetList(pageIndex, pageSize, out message);
            }
            catch (Exception ex)
            {
                model.success = 0;
                model.message = ex.Message;
            }
            return Json(model);
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
                            message = "okie";
                            var success = true;// mNhanSu.NapDuLieu(path, phongbanId, resultStatus, out message);
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