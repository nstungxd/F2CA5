using CRUD.Core.Domain;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.Interfaces
{
    public interface IdmQuanHuyenService : FX.Data.IBaseService<dmQuanHuyen, string>
    {
        List<dmQuanHuyen> LayTheoTen(string ten);
        dmQuanHuyen LayTheoMa(string maTinhThanh, string maQuanHuyen);
        List<dmQuanHuyen> LayTheoMaTinhThanh(string maTinhThanh);
    }
}
