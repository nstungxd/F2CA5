using IdentityManagement.Authorization;
using IdentityManagement.Domain;
using IdentityManagement.WebProviders;
using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Web;

namespace CRUD.Models
{
    public class AccountModel : BaseModel
    {
        public bool Login(string username, string password, out string message)
        {
            message = "";
            using(var conn = new SqlConnection(ConnectString))
            {
                string query = string.Format("select * from Account where Username = '{0}' and Password = '{1}'", username, password);
                SqlCommand cmd = new SqlCommand(query, conn);
                cmd.CommandType = CommandType.Text;
                if (conn.State != ConnectionState.Open)
                    conn.Open();
                SqlDataReader dr = cmd.ExecuteReader();
                var dt = new DataTable();
                dt.Load(dr);

                if(dt.Rows.Count > 0)
                {
                    return true;
                }
            }
            message = "Sai tên đăng nhập hoặc mật khẩu";
            return true;
        }
    }
    public class CustomAuthentication : FanxiAuthentication
    {
        public CustomAuthentication(IRBACMembershipProvider mMembershipProvider) : base(mMembershipProvider) { }
        public CustomAuthentication(string mApplicationName, string mSessionFactoryConfigPath) : base(mApplicationName, mSessionFactoryConfigPath) { }

        /// <summary>
        /// custom authenticate menthod (dung de luu thong tin xac thuc)
        /// </summary>
        /// <param name="mUserName">username</param>
        /// <param name="mPassword">thong tin</param>
        /// <returns></returns>
        public override UserIdentity Authenticate(string mUserName, string mPassword)
        {
            HttpRuntime.Cache.Insert(mUserName + "_data", mPassword);
            return new UserIdentity(mUserName, new List<FanxiPermission>(), new string[0]);
        }
    }
}