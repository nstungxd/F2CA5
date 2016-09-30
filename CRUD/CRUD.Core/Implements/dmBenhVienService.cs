using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using NHibernate.Linq;
using CRUD.Core.Domain;

namespace CRUD.Core.Implements
{
    public class dmBenhVienService : FX.Data.BaseService<dmBenhVien, string>, CRUD.Core.Interfaces.IdmBenhVienService
    {
        public dmBenhVienService(string sessionFactoryConfigPath)
            : base(sessionFactoryConfigPath)
        { }


        public List<dmBenhVien> LayTheoTen(string ten)
        {
            return Query.Where(x => x.ten.Contains(ten) == true).ToList();
        }

        public dmBenhVien LayTheoMa(string maTinhThanh, string maBenhVien)
        {
            return Query.Where(x => x.ma_tinh_thanh == maTinhThanh && x.ma == maBenhVien).FirstOrDefault();
        }

        public List<dmBenhVien> LayTheoMaTinhThanh(string maTinhThanh)
        {
            return Query.Where(x => x.ma_tinh_thanh == maTinhThanh).ToList();
        }
    }
}
