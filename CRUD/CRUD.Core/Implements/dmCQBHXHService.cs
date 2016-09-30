using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using NHibernate.Linq;
using CRUD.Core.Domain;

namespace CRUD.Core.Implements
{
    public class dmCQBHXHService : FX.Data.BaseService<dmCQBHXH, string>, CRUD.Core.Interfaces.IdmCQBHXHService
    {
        public dmCQBHXHService(string sessionFactoryConfigPath)
            : base(sessionFactoryConfigPath)
        { }

        public List<dmCQBHXH> LayTheoTen(string ten)
        {
            return Query.Where(x => x.ten.Contains(ten) == true).ToList();
        }

        public dmCQBHXH LayTheoMa(string ma)
        {
            return Query.Where(x => x.ma == ma).FirstOrDefault();
        }

        public List<dmCQBHXH> TimTheoMaTen(string tuKhoa)
        {
            return Query.Where(x => x.ma.Contains(tuKhoa) || x.ten.Contains(tuKhoa)).ToList();
        }
    }
}
