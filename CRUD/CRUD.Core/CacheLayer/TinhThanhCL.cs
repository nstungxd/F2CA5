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
    public class TinhThanhCL
    {
        const double CacheDuration = double.MaxValue;
        public static List<dmTinhThanh> LayDmTinhThanh()
        {
            var _service = IoC.Resolve<IdmTinhThanhService>();
            string rawKey = "dmTinhThanh";
            // See if the item is in the cache
            List<dmTinhThanh> dmuc = CacheProvider.GetCacheItem(rawKey) as List<dmTinhThanh>;
            if (dmuc == null)
            {
                // Item not found in cache - retrieve it and insert it into the cache
                dmuc = _service.GetAll();
                // chi cache neu count >0
                if (dmuc.Count > 0)
                    CacheProvider.AddCacheItem(rawKey, dmuc);
            }
            return dmuc;
        }

        public static dmTinhThanh LayTheoMa(string maTinh)
        {
            var dsTinhThanh = LayDmTinhThanh();
            if (dsTinhThanh != null)
                return dsTinhThanh.FirstOrDefault(x => x.ma == maTinh);
            else
                return null;
        }

        public static dmTinhThanh LayTheoTen(string tenTinhThanh)
        {
            tenTinhThanh = string.IsNullOrEmpty(tenTinhThanh) ? "" : StringUtil.UnsignString(tenTinhThanh);
            var dsTinhThanh = LayDmTinhThanh();
            if (dsTinhThanh != null)
                return dsTinhThanh.FirstOrDefault(x => StringUtil.UnsignString(x.ten).Contains(tenTinhThanh) || tenTinhThanh.Contains(StringUtil.UnsignString(x.ten)));
            else
                return null;
        }

        public static dmTinhThanh LayTheoTen(string tenTinhThanh, bool UnsignString = true)
        {
            if (string.IsNullOrEmpty(tenTinhThanh))
                tenTinhThanh = "";

            tenTinhThanh = tenTinhThanh.Trim().ToLower();
            tenTinhThanh = tenTinhThanh.Replace("thành phố", "").Replace("tp", "").Replace("tp.", "");
            tenTinhThanh = UnsignString ? StringUtil.UnsignString(tenTinhThanh) : tenTinhThanh;
            var dsTinhThanh = LayDmTinhThanh();
            if (dsTinhThanh != null)
            {
                if (UnsignString)
                    return dsTinhThanh.FirstOrDefault(x => StringUtil.UnsignString(x.ten.Trim().ToLower()).Contains(tenTinhThanh)
                        || tenTinhThanh.Trim().ToLower().Contains(StringUtil.UnsignString(x.ten.Trim().ToLower())));

                return dsTinhThanh.FirstOrDefault(x => x.ten.Trim().ToLower().Contains(tenTinhThanh)
                                                       || tenTinhThanh.Contains(x.ten.Trim().ToLower()));
            }
            else
                return null;
        }

        public static dmTinhThanh LayTheoMaBHXH(string maBHXH)
        {
            var dsTinhThanh = LayDmTinhThanh();
            if (dsTinhThanh != null)
                return dsTinhThanh.FirstOrDefault(x => x.ma_cq_bhxh == maBHXH);
            else
                return null;
        }
    }
}
