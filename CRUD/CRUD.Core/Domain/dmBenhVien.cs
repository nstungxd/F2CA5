using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Domain
{
    public class dmBenhVien : dmBase
    {
        public virtual string ma_tinh_thanh { get; set; }
        public virtual string ma_cap_tren { get; set; }
        public virtual string tuyen { get; set; }
        public virtual string loai { get; set; }
    }
}
