using CRUD.Core.Domain;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Interfaces
{
    public interface IdmTinhThanhService : FX.Data.IBaseService<dmTinhThanh, string>
    {
        List<dmTinhThanh> LayTheoTen(string ten);
        dmTinhThanh LayTheoMa(string maTinhThanh);
    }
}
