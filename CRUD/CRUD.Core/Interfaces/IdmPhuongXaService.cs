using CRUD.Core.Domain;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Interfaces
{
    public interface IdmPhuongXaService : FX.Data.IBaseService<dmPhuongXa, string>
    {
        List<dmPhuongXa> LayTheoTen(string ten);
        dmPhuongXa LayTheoMa(string maTinhThanh, string maQuanHuyen, string maPhuongXa);
        List<dmPhuongXa> LayTheoMaTinhHuyen(string maTinhThanh, string maQuanHuyen);
    }
}
