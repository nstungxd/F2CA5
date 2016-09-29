using CRUD.Core.Domain;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Interfaces
{
    public interface IdmQuocTichService : FX.Data.IBaseService<dmQuocTich, string>
    {
        dmQuocTich LayTheoMa(string ma);
    }
}
