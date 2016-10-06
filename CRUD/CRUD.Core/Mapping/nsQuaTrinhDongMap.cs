using System;
using System.Collections.Generic;
using System.Text;
using FluentNHibernate.Mapping;
using CRUD.Core.Domain;

namespace CRUD.Core.Mapping
{
    public class nsQuaTrinhDongMap : ClassMap<nsQuaTrinhDong>
    {
        public nsQuaTrinhDongMap()
        {
            Table(typeof(nsQuaTrinhDong).Name);
            Id(x => x.ID).GeneratedBy.Identity();
            Map(e => e.amnd_date);
            Map(e => e.amnd_state);
            Map(e => e.amnd_officer);
            
            Map(e => e.amnd_type);
            Map(e => e.to_chuc_id);
            Map(x => x.muc_luong);
            Map(x => x.he_so_luong);
            Map(x => x.phu_cap_chuc_vu);
            Map(x => x.phu_cap_vuot_khung);
            Map(x => x.phu_cap_thu_nhap_nghe);
            Map(x => x.phu_cap_khac);
            Map(x => x.cac_khoan_bo_sung);
            //Map(x => x.nhan_su_id);
            Map(x => x.ngay_bat_dau);
            Map(e => e.phu_cap_luong);

            References(x => x.nhan_su)
                .Column("nhan_su_id")
                .Not.LazyLoad();


            //.Cascade.SaveUpdate();
            //Map(e => e.add_info_2);
            //Map(e => e.add_info_3);
            //Map(e => e.add_info_4);
            //Map(e => e.add_info_5);
            //Map(e => e.add_info_6);
            //Map(e => e.add_info_7);
            //Map(e => e.add_info_8);
            //Map(e => e.add_info_9);
            //Map(e => e.add_info_10);
        }
    }
}
