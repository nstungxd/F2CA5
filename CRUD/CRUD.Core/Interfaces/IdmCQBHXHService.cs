using CRUD.Core.Domain;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace CRUD.Core.Interfaces
{
    public interface IdmCQBHXHService : FX.Data.IBaseService<dmCQBHXH, string>
    {
        List<dmCQBHXH> TimTheoMaTen(string tuKhoa);
        List<dmCQBHXH> LayTheoTen(string ten);
        dmCQBHXH LayTheoMa(string ma);
    }
}
