﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Domain
{
    public class dmQuanHuyen : dmBase
    {
        public virtual string ma_tinh_thanh { get; set; }
        public virtual string ma_hanh_chinh { get; set; }
    }
}
