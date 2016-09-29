using CRUD.Core.Domain;
using NHibernate;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace CRUD.Core.Interfaces
{
    public interface InsNhanSuService : FX.Data.IBaseService<nsNhanSu, string>
    {
        /// <summary>
        /// lấy nhân sự theo phòng ban
        /// </summary>
        /// <param name="phongban">id phòng ban (để trống là tìm theo tất cả)</param>
        /// <param name="keyword">từ khóa tìm kiếm</param>
        /// <param name="pageIndex"></param>
        /// <param name="pageSize"></param>
        /// <param name="total"></param>
        /// <returns></returns>
        List<nsNhanSu> LayTheoPhongBan(string toChucId, string phongBanId, string keyword, int pageIndex, int pageSize, out int total);

        /// <summary>
        /// lay danh sach nhan su theo trang thai nghi BHXH.Core.trang_thai_nghi_viec
        /// </summary>
        /// <param name="toChucId"></param>
        /// <param name="trangThaiNghi"></param>
        /// <param name="pageIndex"></param>
        /// <param name="pageSize"></param>
        /// <param name="total"></param>
        /// <returns></returns>
        List<nsNhanSu> LayDanhSachTheoTrangThaiNghi(string toChucId, string trangThaiNghi, string keyword, int pageIndex, int pageSize, out int total);

        /// <summary>
        /// lay danh sach nhan su theo trang thai nghi (BHXH.Core.trang_thai_nghi_viec)s
        /// </summary>
        /// <param name="toChucId"></param>
        /// <param name="skipDsTrangThaiNghi">ds trang thai nghi duoc bo qua</param>
        /// <param name="pageIndex"></param>
        /// <param name="pageSize"></param>
        /// <param name="total"></param>
        /// <returns></returns>
        List<nsNhanSu> LayDanhSachTheoTrangThaiNghi(string toChucId, string keyword, List<string> skipDsTrangThaiNghi, int pageIndex, int pageSize, out int total);

        /// <summary>
        /// kiểm tra nhân sự theo phòng ban
        /// </summary>
        /// <param name="phongban">id phòng ban (để trống là tìm theo tất cả)</param>
        /// <returns></returns>
        int LayTheoPhongBan(string toChucId, string phongBanId);

        /// <summary>
        /// lấy tất cả nhân sự
        /// </summary>
        /// <param name="pageIndex"></param>
        /// <param name="pageSize"></param>
        /// <param name="total"></param>
        /// <returns></returns>
        List<nsNhanSu> LayTatCaNhanSu(string toChucId, int pageIndex, int pageSize, out int total);

        /// <summary>
        /// lay du lieu theo id (trang thai A)
        /// </summary>
        /// <param name="id"></param>
        /// <returns></returns>
        nsNhanSu LayTheoId(string id, string toChucId);

        /// <summary>
        /// inactive du lieu theo id
        /// </summary>
        /// <param name="id"></param>
        /// <returns></returns>
        nsNhanSu InActive(string id, string toChucId, string taiKhoan);

        /// <summary>
        /// inactive du lieu theo phong ban id
        /// </summary>
        /// <param name="id"></param>
        /// <returns></returns>
        void InActiveTheoPhongBan(string id, string toChucId, string taiKhoan);


        /// <summary>
        /// lay nhan su theo so the bhyt (trang thai A)
        /// </summary>
        /// <param name="soTheBHYT"></param>
        /// <returns></returns>
        nsNhanSu LayTheoSoTheBHYT(string soTheBHYT, string toChucId);

        /// <summary>
        /// lay nhan su theo so so bhxh (trang thai A)
        /// </summary>
        /// <param name="soTheBHYT"></param>
        /// <returns></returns>
        nsNhanSu LayTheoSoSoBHXH(string soSoBHXH, string toChucId);

        /// <summary>
        /// lay theo ma nhan vien
        /// </summary>
        /// <param name="maNhanVien"></param>
        /// <param name="toChucId"></param>
        /// <returns></returns>
        nsNhanSu LayTheoMaNhanVien(string maNhanVien, string toChucId);

        /// <summary>
        /// 
        /// </summary>
        /// <param name="phongBanId"></param>
        void XoaTheoPhongBan(string phongBanId, string toChucId);

        int Count(string toChucId);
    }
}
