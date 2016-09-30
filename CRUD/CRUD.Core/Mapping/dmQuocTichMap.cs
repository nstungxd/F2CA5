using System;
using System.Collections.Generic;
using System.Text;
using FluentNHibernate.Mapping;
using CRUD.Core.Domain;

namespace CRUD.Core.Mapping
{
    public class dmQuocTichMap : ClassMap<dmQuocTich>
    {
        public dmQuocTichMap()
        {
            Table("dmQuocTich");
            Id(x => x.ID).GeneratedBy.Assigned().Column("ID");
            Map(x => x.ma);
            Map(x => x.ten);
        }
    }
}
