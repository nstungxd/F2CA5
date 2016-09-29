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
    public class BenhVienCL
    {

        public static List<dmBenhVien> LayDmBenhVien(string maTinh)
        {
            var service = IoC.Resolve<IdmBenhVienService>();
            string rawKey = "dmBenhVien-" + maTinh;
            // See if the item is in the cache
            List<dmBenhVien> dmuc = CacheProvider.GetCacheItem(rawKey) as List<dmBenhVien>;
            if (dmuc == null)
            {
                // Item not found in cache - retrieve it and insert it into the cache
                dmuc = service.LayTheoMaTinhThanh(maTinh);
                // chi cache neu count >0
                if (dmuc.Count > 0)
                    CacheProvider.AddCacheItem(rawKey, dmuc);
            }
            return dmuc;
        }

        public static dmBenhVien LayBenhVien(string maTinh, string maBenhVien)
        {
            var dsBenhVien = LayDmBenhVien(maTinh);
            if (dsBenhVien != null)
                return dsBenhVien.FirstOrDefault(x => x.ma == maBenhVien);
            else
                return null;
        }

        public static dmBenhVien LayBenhVienTheoTenBenhVien(string maTinh, string tenBenhVien, bool UnsignString = true)
        {
            maTinh = string.IsNullOrEmpty(maTinh) ? "" : maTinh;
            var dsBenhVien = LayDmBenhVien(maTinh);
            if (dsBenhVien != null)
            {
                if (UnsignString)
                {
                    dmBenhVien benhvien =
                    dsBenhVien.FirstOrDefault(
                        x =>
                            StringUtil.UnsignString(x.ten.Trim().ToLower()).Contains(StringUtil.UnsignString(tenBenhVien.Trim().ToLower())) ||
                            StringUtil.UnsignString(tenBenhVien.Trim().ToLower()).Contains(StringUtil.UnsignString(x.ten.Trim().ToLower())));
                    if (benhvien != null)
                    {
                        return benhvien;
                    }
                    return null;
                }
                else
                {
                    dmBenhVien benhvien = dsBenhVien.FirstOrDefault(x => x.ten.Trim().ToLower().Contains(tenBenhVien.Trim().ToLower()) || (tenBenhVien.Trim().ToLower()).Contains(x.ten.Trim().ToLower()));
                    if (benhvien != null)
                    {
                        return benhvien;
                    }
                    return null;
                }
            }
            return null;
        }
        public static dmBenhVien LayBenhVienTheoTenBenhVien(string maTinh, string tenBenhVien)
        {
            maTinh = string.IsNullOrEmpty(maTinh) ? "" : maTinh;
            var dsBenhVien = LayDmBenhVien(maTinh);
            if (dsBenhVien != null)
            {
                dmBenhVien benhvien = dsBenhVien.FirstOrDefault(x => StringUtil.UnsignString(x.ten).Contains(StringUtil.UnsignString(tenBenhVien)) || StringUtil.UnsignString(tenBenhVien).Contains(StringUtil.UnsignString(x.ten)));
                if (benhvien != null)
                {
                    return benhvien;
                }
                else
                    return null;
            }
            else
                return null;
        }
    }
}
