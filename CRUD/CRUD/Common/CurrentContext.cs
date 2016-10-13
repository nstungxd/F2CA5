using FX.Core;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Script.Serialization;
using System.Web.Security;
using System.Configuration;
using CRUD.Models;

namespace CRUD.Common
{
    public class CurrentContext
    {
        public static string FileStoreDirectory
        {
            get
            {
                var root = HttpContext.Current.Server.MapPath(@"~/Exports/");
                var configRoot = ConfigurationManager.AppSettings["ExportDataDirectory"];
                if (!string.IsNullOrEmpty(configRoot))
                {
                    if (configRoot.IndexOf(":", StringComparison.Ordinal) == 1) // absolute path vd: c:/exports
                        root = configRoot;
                    else // relative path
                        root = HttpContext.Current.Server.MapPath(configRoot);
                }

                return root;
            }
        }
        public static string ExceptionDirectory
        {
            get
            {
                var root = HttpContext.Current.Server.MapPath(@"~/");
                var configRoot = ConfigurationManager.AppSettings["ExceptionDirectory"];
                if (!string.IsNullOrEmpty(configRoot))
                {
                    if (configRoot.IndexOf(":", StringComparison.Ordinal) == 1) // absolute path vd: c:/exports
                        root = configRoot;
                    else // relative path
                        root = HttpContext.Current.Server.MapPath(configRoot);
                }

                return root;
            }
        }

        
        public static ThongTin ThongTinChung
        {
            get
            {
                var userData = (string)HttpRuntime.Cache[HttpContext.Current.User.Identity.Name + "_data"];
                try
                {
                    return ThongTin.FromJson(userData);
                }
                catch (Exception)
                {
                    return null;
                }
            }
            set
            {
                var userData = (ThongTin)value;
                CustomAuthentication _authenticationService = IoC.Resolve<CustomAuthentication>();
                // call login để ghi authen cookie
                _authenticationService.LogOn(userData.TaiKhoan, userData.ToJson());
            }
        }

        private static Dictionary<string, string> dsToKhai = new Dictionary<string, string>();
    }

    public class ThongTin
    {
        public string SessionId = Guid.NewGuid().ToString();
        public string TaiKhoan { get; set; }
        public string TenDangNhap { get; set; }





        public string ToJson()
        {
            return new JavaScriptSerializer().Serialize(this);
        }

        public static ThongTin FromJson(string thongTin)
        {
            return new JavaScriptSerializer().Deserialize<ThongTin>(thongTin);
        }



    }
}