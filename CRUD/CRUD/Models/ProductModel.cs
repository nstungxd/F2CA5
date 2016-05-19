using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Web;

namespace CRUD.Models
{
    public class ProductModel : BaseModel
    {
        public List<ProductViewModel> GetList(int pageIndex, int pageSize,out string message)
        {
            List<ProductViewModel> list = new List<ProductViewModel>();
            using (var conn = new SqlConnection(ConnectString))
            {
                string query = string.Format("select * from Products");
                SqlCommand cmd = new SqlCommand(query, conn);
                cmd.CommandType = CommandType.Text;
                if (conn.State != ConnectionState.Open)
                    conn.Open();
                using (SqlDataReader dr = cmd.ExecuteReader())
                {
                    while (dr.Read())
                    {
                        ProductViewModel item = new ProductViewModel();
                        item.ProductName = dr["ProductName"].ToString();
                        item.Price = dr["Price"].ToString();
                        item.Description = dr["ProductName"].ToString();
                        list.Add(item);
                    }
                }
            }
            message = "";
            return list.Skip((pageIndex - 1) * pageSize).Take(pageSize).ToList();
        }
    }
}
