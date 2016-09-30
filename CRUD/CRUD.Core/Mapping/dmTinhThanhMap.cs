using System;
using System.Collections.Generic;
using System.Text;
using FluentNHibernate.Mapping;
using CRUD.Core.Domain;

namespace CRUD.Core.Mapping
{
    public class dmTinhThanhMap : ClassMap<dmTinhThanh>
    {
        public dmTinhThanhMap()
        {
            Table("dmTinhThanh");
            Id(x => x.ID).GeneratedBy.Assigned().Column("ID");
            //Map(x => x.ma).Column("Ma").Not.Nullable();
            //Map(x => x.ten).Column("Ten");
            //Map(x => x.ma_cq_bhxh).Column("MaCQBHXH");

            Map(x => x.ma);
            Map(x => x.ten);
            Map(x => x.ma_cq_bhxh);

        }
    }
}
