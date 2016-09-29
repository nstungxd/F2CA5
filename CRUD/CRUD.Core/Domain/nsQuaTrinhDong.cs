using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Text;

namespace CRUD.Core.Domain
{
    [Serializable]
    public class nsQuaTrinhDong : domain
    {
        public virtual string nhan_su_id { get; set; }
        public virtual DateTime ngay_bat_dau { get; set; }
        public virtual double? muc_luong { get; set; }
        public virtual double? he_so_luong { get; set; }
        public virtual double? phu_cap_chuc_vu { get; set; }
        public virtual double? phu_cap_vuot_khung { get; set; }
        public virtual double? phu_cap_thu_nhap_nghe { get; set; }
        public virtual double? phu_cap_khac { get; set; }
        public virtual double? cac_khoan_bo_sung { get; set; }

        public virtual double? phu_cap_luong { get; set; }

        //public virtual string add_info_2 { get; set; }
        //public virtual string add_info_3 { get; set; }
        //public virtual string add_info_4 { get; set; }
        //public virtual string add_info_5 { get; set; }
        //public virtual string add_info_6 { get; set; }
        //public virtual string add_info_7 { get; set; }
        //public virtual string add_info_8 { get; set; }
        //public virtual string add_info_9 { get; set; }
        //public virtual string add_info_10 { get; set; }
    }
}
