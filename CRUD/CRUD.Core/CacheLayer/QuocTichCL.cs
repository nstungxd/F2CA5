using CRUD.Core.Domain;
using CRUD.Core.Interfaces;
using CRUD.Utils.Utils;
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
    public class QuocTichCL
    {
        public static List<dmQuocTich> LayDmQuocTich()
        {
            string rawKey = "dmQuocTich";
            // See if the item is in the cache
            List<dmQuocTich> dmuc = CacheProvider.GetCacheItem(rawKey) as List<dmQuocTich>;
            if (dmuc == null)
            {
                var service = IoC.Resolve<IdmQuocTichService>();
                // Item not found in cache - retrieve it and insert it into the cache
                dmuc = service.GetAll();

                // chi cache neu count >0
                if (dmuc.Count > 0)
                    CacheProvider.AddCacheItem(rawKey, dmuc);
            }
            return dmuc;
        }

        public static dmQuocTich LayTheoMa(string ma)
        {
            var dsBenhVien = LayDmQuocTich();
            if (dsBenhVien != null)
                return dsBenhVien.FirstOrDefault(x => x.ma == ma);
            else
                return null;
        }
        public static dmQuocTich LayTheoTen(string ten, bool UnsignString = true)
        {
            ten = string.IsNullOrEmpty(ten) ? "" : (UnsignString ? StringUtil.UnsignString(ten) : ten);
            var dmquoctich = LayDmQuocTich();
            if (dmquoctich != null)
            {
                if (UnsignString)
                    return dmquoctich.FirstOrDefault(x => StringUtil.UnsignString(x.ten.Trim().ToLower()).Contains(ten.Trim().ToLower()) || ten.Trim().ToLower().Contains(StringUtil.UnsignString(x.ten.Trim().ToLower())));
                return dmquoctich.FirstOrDefault(x => x.ten.Trim().ToLower().Contains(ten.Trim().Trim().ToLower()) || ten.Trim().ToLower().Contains(x.ten.Trim().ToLower()));
            }
            else
                return null;
        }
    }
}
