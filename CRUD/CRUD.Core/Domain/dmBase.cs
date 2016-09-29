using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Domain
{
    public class dmBase
    {
        public virtual string ID { get; set; }
        public virtual string ma { get; set; }
        public virtual string ten { get; set; }
        public virtual string sten
        {
            get
            {
                if (ten != null)
                    return CRUD.Utils.Utils.StringUtil.UnsignString(ten);
                else
                    return "";
            }
        }
    }
}
