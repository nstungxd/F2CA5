using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using NHibernate.Linq;
using CRUD.Core.Domain;

namespace CRUD.Core.Implements
{
    public class dmQuocTichService : FX.Data.BaseService<dmQuocTich, string>, CRUD.Core.Interfaces.IdmQuocTichService
    {
        public dmQuocTichService(string sessionFactoryConfigPath)
            : base(sessionFactoryConfigPath)
        { }

        public dmQuocTich LayTheoMa(string ma)
        {
            return Query.Where(x => x.ma == ma).FirstOrDefault();
        }
    }
}
