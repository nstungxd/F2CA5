using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using NHibernate.Linq;
using CRUD.Core.Domain;

namespace CRUD.Core.Implements
{
    public class dmTinhThanhService : FX.Data.BaseService<dmTinhThanh, string>, CRUD.Core.Interfaces.IdmTinhThanhService
    {
        public dmTinhThanhService(string sessionFactoryConfigPath)
            : base(sessionFactoryConfigPath)
        { }


        public List<dmTinhThanh> LayTheoTen(string ten)
        {
            return Query.Where(x => x.ten.Contains(ten) == true).ToList();
        }

        public dmTinhThanh LayTheoMa(string maTinhThanh)
        {
            return Query.Where(x => x.ma == maTinhThanh).FirstOrDefault();
        }
    }
}
