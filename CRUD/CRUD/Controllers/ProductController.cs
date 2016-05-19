using CRUD.Models;
using System;
using System.Collections.Generic;
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
	}
}