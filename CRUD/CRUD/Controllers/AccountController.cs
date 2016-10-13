using CRUD.Common;
using CRUD.Core;
using CRUD.Models;
using FX.Core;
using Oauth2Login.Service;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace CRUD.Controllers
{
    public class AccountController : BaseController
    {
        private readonly CustomAuthentication _authenticationService;

        public AccountController()
        {
            _authenticationService = IoC.Resolve<CustomAuthentication>();
        }
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

        public ActionResult LoginExternal(string id)
        {
            var service = BaseOauth2Service.GetService(id);

            if (service != null)
            {
                var url = service.BeginAuthentication();
                return Redirect(url);
            }
            else
            {
                return RedirectToAction("LoginFail");
            }
        }
        public ActionResult Callback(string id)
        {
            var service = BaseOauth2Service.GetService(id);

            if (service != null)
            {
                try
                {
                    var redirectUrl = service.ValidateLogin(Request);

                    ThongTin thongTinChung = new ThongTin();
                    thongTinChung.TaiKhoan = service.UserData.Email;
                    thongTinChung.TenDangNhap = service.UserData.FullName;

                    _authenticationService.LogOn(service.UserData.Email, thongTinChung.ToJson());
                    Session[SessionCore.ID] = Guid.NewGuid().ToString();
                    HttpContext.Application[SessionCore.ID] = Session[SessionCore.ID];

                    string returnUrl = "/Product/Index";
                    return Redirect(returnUrl);
                    
                }
                catch (Exception ex)
                {
                    throw ex;
                    //RedirectToAction("Error");
                    
                }
            }
            return RedirectToAction("Login");
        }
	}
}