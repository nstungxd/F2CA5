using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using NHibernate.Linq;
using CRUD.Core.Domain;

namespace BHXH.Services.Implements
{
    public class dmDanTocService : FX.Data.BaseService<dmDanToc, string>, CRUD.Core.Interfaces.IdmDanTocService
    {
        public dmDanTocService(string sessionFactoryConfigPath)
            : base(sessionFactoryConfigPath)
        { }

        public dmDanToc LayTheoMa(string ma)
        {
            return Query.Where(x => x.ma == ma).FirstOrDefault();
        }
    }
}
