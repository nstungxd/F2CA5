using CRUD.Core.Domain;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Interfaces
{
    public interface IdmDanTocService : FX.Data.IBaseService<dmDanToc, string>
    {
        dmDanToc LayTheoMa(string ma);
    }
}
