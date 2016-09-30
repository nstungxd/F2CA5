using System;
using System.Collections.Generic;
using System.Text;
using FluentNHibernate.Mapping;
using CRUD.Core.Domain;

namespace CRUD.Core.Mapping
{
    public class dmQuanHuyenMap : ClassMap<dmQuanHuyen>
    {
        public dmQuanHuyenMap()
        {
            Table("dmQuanHuyen");
            Id(x => x.ID).GeneratedBy.Assigned().Column("ID");
            //Map(x => x.ma).Column("Ma").Not.Nullable();
            //Map(x => x.ten).Column("Ten").Not.Nullable();
            //Map(x => x.ma_tinh_thanh).Column("MaTinhThanh").Not.Nullable();
            //Map(x => x.ma_hanh_chinh).Column("MaHanhChinh");
            Map(x => x.ma);
            Map(x => x.ten);
            Map(x => x.ma_tinh_thanh);  
            Map(x => x.ma_hanh_chinh);
        }
    }
}
