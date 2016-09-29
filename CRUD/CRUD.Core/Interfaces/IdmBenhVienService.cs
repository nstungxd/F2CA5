using CRUD.Core.Domain;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace CRUD.Core.Interfaces
{
    public interface IdmBenhVienService : FX.Data.IBaseService<dmBenhVien, string>
    {
        List<dmBenhVien> LayTheoTen(string ten);
        dmBenhVien LayTheoMa(string maTinhThanh, string maBenhVien);
        List<dmBenhVien> LayTheoMaTinhThanh(string maTinhThanh);
    }
}
