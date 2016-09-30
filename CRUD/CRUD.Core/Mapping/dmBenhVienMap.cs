using System;
using System.Collections.Generic;
using System.Text;
using FluentNHibernate.Mapping;
using CRUD.Core.Domain;

namespace CRUD.Core.Mapping
{
    public class dmBenhVienMap : ClassMap<dmBenhVien>
    {
        public dmBenhVienMap()
        {
            Table("dmBenhVien");
            Id(x => x.ID).GeneratedBy.Assigned().Column("ID");
            //Map(x => x.Ma).Column("Ma").Not.Nullable();
            //Map(x => x.Ten).Column("Ten").Not.Nullable();
            //Map(x => x.MaTinhThanh).Column("MaTinhThanh").Not.Nullable();
            //Map(x => x.MaCapTren).Column("MaCapTren");
            //Map(x => x.Tuyen).Column("Tuyen");
            //Map(x => x.Loai).Column("Loai");
            Map(x => x.ma);
            Map(x => x.ten);
            Map(x => x.ma_tinh_thanh);
            Map(x => x.ma_cap_tren);
            Map(x => x.tuyen);
            Map(x => x.loai);
        }
    }
}
