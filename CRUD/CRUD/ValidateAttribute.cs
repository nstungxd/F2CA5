using System.Web.Mvc;
using System.Web;
using System;
using System.Web.Security;
using System.Security.Principal;
using System.Data;
using System.Linq;

namespace CRUD
{
    public class ValidateAttribute : AuthorizeAttribute
    {

        public override void OnAuthorization(AuthorizationContext filterContext)
        {

            if (filterContext != null && !AuthorizeCore(filterContext.HttpContext))
            {
                this.HandleUnauthorizedRequest(filterContext);
            }
        }

        protected override bool AuthorizeCore(HttpContextBase httpContext)
        {
            if (httpContext == null)
                throw new ArgumentNullException("httpContext");

            return httpContext.User.Identity.IsAuthenticated && HttpContext.Current.Cache[HttpContext.Current.User.Identity.Name + "_data"] != null;
        }

        protected override void HandleUnauthorizedRequest(AuthorizationContext filterContext)
        {
            if (filterContext.HttpContext.Request.IsAjaxRequest())
            {
                filterContext.HttpContext.Response.StatusCode = 401;
                filterContext.Result = new ContentResult()
                {
                    Content = "Unauthorized"
                };
            }
            else
            {
                var returnUrl = filterContext.HttpContext.Request.RawUrl;
                filterContext.Result = new RedirectResult("/Account/Login" + "?ReturnUrl=" + HttpUtility.UrlEncode(returnUrl));
            }
        }
    }
}