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
    public class PhuongXaCL
    {
        const double CacheDuration = double.MaxValue;
        public static List<dmPhuongXa> LayDmPhuongXa(string maTinh, string maHuyen)
        {
            var _service = IoC.Resolve<IdmPhuongXaService>();
            string rawKey = "dmPhuongXa-" + maTinh + "-" + maHuyen;
            // See if the item is in the cache
            List<dmPhuongXa> dmuc = CacheProvider.GetCacheItem(rawKey) as List<dmPhuongXa>;
            if (dmuc == null)
            {
                // Item not found in cache - retrieve it and insert it into the cache
                dmuc = _service.LayTheoMaTinhHuyen(maTinh, maHuyen);
                // chi cache neu count >0
                if (dmuc.Count > 0)
                    CacheProvider.AddCacheItem(rawKey, dmuc);
            }
            return dmuc;
        }

        public static dmPhuongXa LayPhuongXa(string maTinh, string maQuanHuyen, string maPhuongXa)
        {
            var dsPhuongXa = LayDmPhuongXa(maTinh, maQuanHuyen);
            if (dsPhuongXa != null)
                return dsPhuongXa.FirstOrDefault(x => x.ma == maPhuongXa);
            else
                return null;
        }
        public static dmPhuongXa LayTheoTen(string maTinhThanh, string maQuanHuyen, string tenPhuongXa, bool UnsignString = true)
        {
            tenPhuongXa = string.IsNullOrEmpty(tenPhuongXa) ? "" : (UnsignString ? StringUtil.UnsignString(tenPhuongXa) : tenPhuongXa);
            var dmPhuongXa = LayDmPhuongXa(maTinhThanh, maQuanHuyen);
            if (dmPhuongXa != null)
            {
                if (UnsignString)
                    return dmPhuongXa.FirstOrDefault(x => StringUtil.UnsignString(x.ten.Trim().ToLower()).Contains(tenPhuongXa.Trim().ToLower()) || tenPhuongXa.Trim().ToLower().Contains(StringUtil.UnsignString(x.ten.Trim().ToLower())));
                return dmPhuongXa.FirstOrDefault(x => x.ten.Trim().ToLower().Contains(tenPhuongXa.Trim().ToLower()) || tenPhuongXa.Trim().ToLower().Contains(x.ten.Trim().ToLower()));
            }
            else
                return null;
        }

    }
}
