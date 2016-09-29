using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Domain
{
    [Serializable]
    public abstract class domain
    {
        public virtual string ID { get; set; }
        public virtual DateTime amnd_date { get; set; } //insert ngay thang nam tuong tu nhu modify_date
        public virtual string amnd_state { get; set; } // Active or InActive
        public virtual string amnd_officer { get; set; } //TenTK
        //public virtual string amnd_prev { get; set; }
        public virtual string amnd_type { get; set; } // 1: Them; 3: Sua; 5: Xoa
        public virtual string to_chuc_id { get; set; }
    }
}
