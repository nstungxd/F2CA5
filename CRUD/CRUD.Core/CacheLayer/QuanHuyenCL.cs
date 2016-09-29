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
    public class QuanHuyenCL
    {
        const double CacheDuration = double.MaxValue;
        public static List<dmQuanHuyen> LayDmQuanHuyen(string maTinh)
        {
            var _service = IoC.Resolve<IdmQuanHuyenService>();
            string rawKey = "dmQuanHuyen-" + maTinh;
            // See if the item is in the cache
            List<dmQuanHuyen> dmuc = CacheProvider.GetCacheItem(rawKey) as List<dmQuanHuyen>;
            if (dmuc == null)
            {
                // Item not found in cache - retrieve it and insert it into the cache
                dmuc = _service.LayTheoMaTinhThanh(maTinh);
                // chi cache neu count >0
                if (dmuc.Count > 0)
                    CacheProvider.AddCacheItem(rawKey, dmuc);
            }
            return dmuc;
        }

        public static dmQuanHuyen LayQuanHuyen(string maTinh, string maQuanHuyen)
        {
            var dsQuanHuyen = LayDmQuanHuyen(maTinh);
            if (dsQuanHuyen != null)
                return dsQuanHuyen.FirstOrDefault(x => x.ma == maQuanHuyen);
            else
                return null;
        }
        public static dmQuanHuyen LayTheoTen(string maTinhThanh, string tenQuanHuyen, bool UnsignString = true)
        {
            tenQuanHuyen = string.IsNullOrEmpty(tenQuanHuyen) ? "" : (UnsignString ? StringUtil.UnsignString(tenQuanHuyen) : tenQuanHuyen);
            var dsTinhThanh = LayDmQuanHuyen(maTinhThanh);
            if (dsTinhThanh != null)
            {
                if (UnsignString)
                    return dsTinhThanh.FirstOrDefault(x => StringUtil.UnsignString(x.ten.Trim().ToLower()).Contains(tenQuanHuyen.Trim().ToLower()) || tenQuanHuyen.Trim().ToLower().Contains(StringUtil.UnsignString(x.ten.Trim().ToLower())));
                return dsTinhThanh.FirstOrDefault(x => x.ten.Trim().ToLower().Contains(tenQuanHuyen.Trim().ToLower()) || tenQuanHuyen.Trim().ToLower().Contains(x.ten.Trim().ToLower()));
            }
            else
                return null;
        }
        public static dmQuanHuyen LayTheoTen(string maTinhThanh, string tenQuanHuyen)
        {
            tenQuanHuyen = string.IsNullOrEmpty(tenQuanHuyen) ? "" : StringUtil.UnsignString(tenQuanHuyen);
            var dsTinhThanh = LayDmQuanHuyen(maTinhThanh);
            if (dsTinhThanh != null)
                return dsTinhThanh.FirstOrDefault(x => StringUtil.UnsignString(x.ten).Contains(tenQuanHuyen) || tenQuanHuyen.Contains(StringUtil.UnsignString(x.ten)));
            else
                return null;
        }

    }
}
