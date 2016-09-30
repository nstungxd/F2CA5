using System;
using System.Collections.Generic;
using System.Text;
using FluentNHibernate.Mapping;
using CRUD.Core.Domain;

namespace CRUD.Core.Mapping
{
    public class dmPhuongXaMap : ClassMap<dmPhuongXa>
    {
        public dmPhuongXaMap()
        {
            Table("dmPhuongXa");
            Id(x => x.ID).GeneratedBy.Assigned().Column("ID");
            //Map(x => x.ma).Column("Ma").Not.Nullable();
            //Map(x => x.ten).Column("Ten").Not.Nullable();
            //Map(x => x.ma_tinh_thanh).Column("MaTinhThanh").Not.Nullable();
            //Map(x => x.ma_quan_huyen).Column("MaQuanHuyen").Not.Nullable();
            //Map(x => x.ma_hanh_chinh).Column("MaHanhChinh");
            //Map(x => x.khu_vuc).Column("KhuVuc");
            //Map(x => x.he_so_khu_vuc).Column("HeSoKhuVuc");
            Map(x => x.ma);
            Map(x => x.ten);
            Map(x => x.ma_tinh_thanh);
            Map(x => x.ma_quan_huyen);
            Map(x => x.ma_hanh_chinh);
            Map(x => x.khu_vuc);
            Map(x => x.he_so_khu_vuc);
        }
    }
}
