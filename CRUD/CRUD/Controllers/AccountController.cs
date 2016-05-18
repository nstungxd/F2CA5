using CRUD.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace CRUD.Controllers
{
    public class AccountController : BaseController
    {
        //
        // GET: /Account/
        public ActionResult Index()
        {
            return View();
        }
        [AllowAnonymous]
        public ActionResult Login(string returnUrl)
        {
            ViewBag.ReturnUrl = returnUrl;
            return View();
        }
        [HttpPost]
        [AllowAnonymous]
        public ActionResult Login(LoginViewModel model, string returnUrl)
        {
            AccountModel models = new AccountModel();
            string message = "";
            if (models.Login(model.UserName,model.Password,out message))
            {
                return Redirect(returnUrl);
            }
            else{
                Messages.AddErrorMessage(message);;
            }
            
            return View(model);
        }
	}
}