using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Domain
{
    public class dmPhuongXa : dmBase
    {
        public virtual string ma_tinh_thanh { get; set; }
        public virtual string ma_quan_huyen { get; set; }
        public virtual string ma_hanh_chinh { get; set; }
        public virtual string khu_vuc { get; set; }
        public virtual string he_so_khu_vuc { get; set; }
    }
}
