using CRUD.Core.Domain;
using CRUD.Core.Interfaces;
using FX.Core;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Web;

namespace CRUD.Core.CacheLayer
{
    public class DanTocCL
    {
        const double CacheDuration = double.MaxValue;

        public static List<dmDanToc> LayDmDanToc()
        {
            string rawKey = "dmDanToc";
            // See if the item is in the cache
            List<dmDanToc> dmuc = CacheProvider.GetCacheItem(rawKey) as List<dmDanToc>;
            if (dmuc == null)
            {
                var service = IoC.Resolve<IdmDanTocService>();
                // Item not found in cache - retrieve it and insert it into the cache
                dmuc = service.GetAll().OrderBy(c => c.ma).ToList();
                // chi cache neu count >0
                if (dmuc.Count > 0)
                    CacheProvider.AddCacheItem(rawKey, dmuc);
            }
            return dmuc;
        }

        public static dmDanToc LayTheoMa(string ma)
        {
            var dsDanToc = LayDmDanToc();
            if (dsDanToc != null)
                return dsDanToc.FirstOrDefault(x => x.ma == ma);
            else
                return null;
        }

    }
}
