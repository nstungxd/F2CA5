using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using NHibernate.Linq;
using CRUD.Core.Domain;

namespace BHXH.Services.Implements
{
    public class dmPhuongXaService : FX.Data.BaseService<dmPhuongXa, string>, CRUD.Core.Interfaces.IdmPhuongXaService
    {
        public dmPhuongXaService(string sessionFactoryConfigPath)
            : base(sessionFactoryConfigPath)
        { }


        public List<dmPhuongXa> LayTheoTen(string ten)
        {
            return Query.Where(x => x.ten.Contains(ten) == true).ToList();
        }

        public dmPhuongXa LayTheoMa(string maTinhThanh, string maQuanHuyen, string maPhuongXa)
        {
            return Query.Where(x => x.ma_tinh_thanh == maTinhThanh && x.ma_quan_huyen == maQuanHuyen && x.ma == maPhuongXa).FirstOrDefault();
        }

        public List<dmPhuongXa> LayTheoMaTinhHuyen(string maTinhThanh, string maQuanHuyen)
        {
            return Query.Where(x => x.ma_tinh_thanh == maTinhThanh && x.ma_quan_huyen == maQuanHuyen).ToList();
        }
    }
}
