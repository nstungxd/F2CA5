using System;
using System.Collections.Generic;
using System.Text;
using FluentNHibernate.Mapping;
using CRUD.Core.Domain;

namespace CRUD.Core.Mapping
{
    public class dmCQBHXHMap : ClassMap<dmCQBHXH>
    {
        public dmCQBHXHMap()
        {
            Table("dmCQBHXH");
            Id(x => x.ID).GeneratedBy.Assigned().Column("ID");
            //Map(x => x.ma).Column("Ma").Not.Nullable();
            //Map(x => x.ten).Column("Ten").Not.Nullable();
            //Map(x => x.ma_cq_bhxh_tinh_thanh).Column("MaCQBHXHTinhThanh").Not.Nullable();
            //Map(x => x.ma_vung_hn).Column("ma_vung_hn");
            //Map(x => x.ma_sms).Column("MaSMS");
            Map(x => x.ma);
            Map(x => x.ten);
            Map(x => x.ma_cq_bhxh_tinh_thanh);
            Map(x => x.ma_vung_hn);
            Map(x => x.ma_sms);
        }
    }
}
