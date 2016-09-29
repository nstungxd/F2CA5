using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using NHibernate.Linq;
using CRUD.Core.Domain;

namespace BHXH.Services.Implements
{
    public class dmQuanHuyenService : FX.Data.BaseService<dmQuanHuyen, string>, CRUD.Core.Interfaces.IdmQuanHuyenService
    {
        public dmQuanHuyenService(string sessionFactoryConfigPath)
            : base(sessionFactoryConfigPath)
        { }


        public List<dmQuanHuyen> LayTheoTen(string ten)
        {
            return Query.Where(x => x.ten.Contains(ten) == true).ToList();
        }

        public dmQuanHuyen LayTheoMa(string maTinhThanh, string maQuanHuyen)
        {
            return Query.Where(x => x.ma_tinh_thanh == maTinhThanh && x.ma == maQuanHuyen).FirstOrDefault();
        }

        public List<dmQuanHuyen> LayTheoMaTinhThanh(string maTinhThanh)
        {
            return Query.Where(x => x.ma_tinh_thanh == maTinhThanh).ToList();
        }
    }
}
