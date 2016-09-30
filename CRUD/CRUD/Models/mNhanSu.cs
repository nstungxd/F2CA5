using AutoMapper;
using CRUD.Core;
using CRUD.Core.CacheLayer;
using CRUD.Core.Domain;
using CRUD.Core.Interfaces;
using CRUD.Utils;
using FX.Core;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Web;

namespace CRUD.Models
{
    public class NhanSuModel : nsNhanSu
    {
        public static void CreateMapping()
        {
            Mapper.Reset();
            Mapper.CreateMap<NhanSuModel, nsNhanSu>()
                .ForMember(x => x.amnd_date, opt => opt.Ignore())
                .ForMember(x => x.amnd_officer, opt => opt.Ignore())
                .ForMember(x => x.amnd_state, opt => opt.Ignore())
                .ForMember(x => x.amnd_type, opt => opt.Ignore())
                .ForMember(x => x.to_chuc_id, opt => opt.Ignore());
            Mapper.CreateMap<nsNhanSu, NhanSuModel>();

        }
        public static bool NapDuLieu(string path,
            string resultStatus, 
            out string message)
        {
            message = "";
            try
            {
                // var result = DocExcel(path, phongBanId, importType, resultStatus, out message);
                var result = Import(path, resultStatus, out message);
                if (result)
                {
                    message = "Thêm mới dữ liệu thành công!";
                    return true;
                }
                return false;
            }
            catch (Exception ex)
            {
                message = "Lỗi cập nhật." + ex.ShowException();
                return false;
            }
        }

        private static bool Import(string path, 
            string resultStatus, 
            out string message)
        {
            message = "";
            try
            {
                var templateName = IndicateTemplaceExcel(path);
                var excel = new ExcelProcess(path);
                string mappingFilePath = "";
                // string selectedTemplate = (string)GetSelectedTemplate();
                switch (templateName)
                {
                    case "SMS6":
                        excel.IsTCVN3 = true;
                        mappingFilePath = HttpContext.Current.Server.MapPath("~/Resources/NhanSuConfig/sms6mapproperty.json");
                        break;
                    case "SMS":
                        excel.IsTCVN3 = true;
                        mappingFilePath = HttpContext.Current.Server.MapPath("~/Resources/NhanSuConfig/smsmapproperty.json");
                        break;
                    case "SMSBD":
                        excel.IsTCVN3 = true;
                        mappingFilePath = HttpContext.Current.Server.MapPath("~/Resources/NhanSuConfig/smsBDmapproperty.json");
                        break;
                    case "VNPT":
                        excel.IsTCVN3 = false;
                        mappingFilePath = HttpContext.Current.Server.MapPath("~/Resources/NhanSuConfig/sms6mapproperty.json");
                        break;
                    default:
                        message = "Mẫu excel của bạn chưa được hỗ trợ!";
                        return false;
                }

                if (!System.IO.File.Exists(mappingFilePath))
                {
                    message = "Không tìm thấy file mapping thuộc tính";
                    return false;
                }
                var ImportMapping = MappingUtil.GetMappingFromFile(mappingFilePath);

                var table = excel.ExcelToDataTable(path, 0, excel.IsTCVN3);
                if (table == null)
                {
                    message = "Không có dữ liệu!";
                    return false;
                }

                var service = IoC.Resolve<InsNhanSuService>();
                var serviceQuaTrinhDong = IoC.Resolve<InsQuaTrinhDongService>();
                var tran = service.BeginTran();
                try
                {
                    //if (importType == data_import_type.REPLACE && resultStatus == "0")
                    //    // xoa du lieu trong dot dich, nếu chưa có lần nào xóa thành công trong cùng 1 lúc Nạp dữ liệu                        
                    //    service.InActiveTheoPhongBan(phongbanId, CurrentContext.ThongTinChung.IdDonVi, CurrentContext.ThongTinChung.TenDangNhap);

                    // convert data
                    var dsConverted = ConvertFromDataTable(ImportMapping, table);
                    foreach (var ns in dsConverted.Keys)
                    {
                        // save
                        service.CreateNew(ns);

                        var quaTrinhDong = dsConverted[ns];
                        if (quaTrinhDong.muc_luong != null || quaTrinhDong.he_so_luong != null)
                            serviceQuaTrinhDong.CreateNew(quaTrinhDong);
                    }

                    service.CommitTran(tran);
                    return true;
                }
                catch (Exception)
                {
                    service.RolbackTran(tran);
                    throw;
                }
            }
            catch (NPOI.HSSF.OldExcelFormatException oefex)
            {
                message = "Định dạng file quá cũ!";
                return false;
            }
            catch (Exception ex)
            {
                message = ex.ShowException();
                return false;
            }

        }

        private static string IndicateTemplaceExcel(string filePath)
        {
            var hoten = "hoten";
            var ho = "ho";
            var ten = "ten";
            var vnpt = "vnpt";
            var SMS = "SMS";
            var SMS6 = "SMS6";
            var SMSBD = "SMSBD";
            var VNPT = "VNPT";
            var dicCol = new Dictionary<string, bool>() { 
                                                            { hoten, false }, 
                                                            { ho, false },
                                                            { ten, false },
                                                            { vnpt, false },
                                                         };
            var columnCount = ExcelProcess.CheckExcelColumn(filePath, dicCol);

            if (dicCol[hoten] == true)
            {
                if (dicCol[vnpt] == true)
                    return VNPT;
                else
                    return SMS6;
            }

            if (dicCol[ho] == true && dicCol[ten] == true)
            {
                if (columnCount == 40)
                {
                    return SMSBD;
                }
                else
                {
                    return SMS;
                }
            }

            return "";
        }

        private static Dictionary<nsNhanSu, nsQuaTrinhDong> ConvertFromDataTable(Dictionary<string, MappingItem> colMap, DataTable table)
        {
            Dictionary<nsNhanSu, nsQuaTrinhDong> dic = new Dictionary<nsNhanSu, nsQuaTrinhDong>();
            int index = 0;

            try
            {
                Dictionary<string, string> mappings = colMap.ToDictionary(x => x.Value.destination, y => y.Key);
                foreach (DataRow row in table.Rows)
                {
                    // convert to nhan su
                    var nhanSu = row.CreateItemFromRow<nsNhanSu>(mappings, (item) =>
                    {
                        item.amnd_date = DateTime.Now;
                        item.amnd_officer = string.Empty;
                        item.amnd_state = amnd_state_type.A;
                        item.amnd_type = CRUD.Core.amnd_type.Insert;
                        item.to_chuc_id = string.Empty;
                        item.ID = Guid.NewGuid().ToString();
                        item.phong_ban_id = string.Empty;
                    });

                    // bo qua dong ko có họ tên
                    if (string.IsNullOrEmpty(nhanSu.ho_ten) && string.IsNullOrEmpty(nhanSu.ho) && string.IsNullOrEmpty(nhanSu.ten))
                    {
                        continue;
                    }

                    // xu ly du lieu nhan su
                    XuLyDuLieu(ref nhanSu);

                    // convert to qua trinh dong
                    var qtDong = row.CreateItemFromRow<nsQuaTrinhDong>(mappings, (item) =>
                    {
                        item.amnd_date = DateTime.Now;
                        item.amnd_officer = string.Empty;
                        item.amnd_state = amnd_state_type.A;
                        item.amnd_type = CRUD.Core.amnd_type.Insert;
                        item.to_chuc_id = string.Empty;
                        item.ID = Guid.NewGuid().ToString();
                        item.nhan_su_id = nhanSu.ID;
                        item.ngay_bat_dau = DateTime.Now;
                    });

                    dic.Add(nhanSu, qtDong);

                    index++;
                }
            }
            catch (Exception ex)
            {
                throw new Exception("loi o dong: " + (index + 1), ex);
            }

            return dic;
        }


        private static void XuLyDuLieu(ref nsNhanSu nhanSu)
        {
            // ho ten
            if (string.IsNullOrEmpty(nhanSu.ho_ten) && string.IsNullOrEmpty(nhanSu.ho) && string.IsNullOrEmpty(nhanSu.ten))
            {
                return;
            }
            else if (string.IsNullOrEmpty(nhanSu.ho_ten))
            {
                var ho = nhanSu.ho == null ? "" : nhanSu.ho;
                var ten = nhanSu.ten == null ? "" : nhanSu.ten;
                nhanSu.ho_ten = ho + " " + ten;
            }

            #region << convert quốc tịch >>
            if (nhanSu.cmnd_ma_noi_cap.IsNotNull() && nhanSu.cmnd_ma_noi_cap.Trim().Length > 2)
            {
                var noi_cap_cmnd = TinhThanhCL.LayTheoTen(nhanSu.cmnd_ma_noi_cap.Trim());
                if (noi_cap_cmnd != null)
                {
                    nhanSu.cmnd_ma_noi_cap = noi_cap_cmnd.ma;
                    nhanSu.cmnd_ten_noi_cap = noi_cap_cmnd.ten;
                }
                else
                {
                    nhanSu.cmnd_ma_noi_cap = "";
                    nhanSu.cmnd_ten_noi_cap = "";
                }
            }
            #endregion

            #region << gioitinh >>
            int gioiTinh = 0;
            if (string.IsNullOrEmpty(nhanSu.gioi_tinh_))
            {
                nhanSu.gioi_tinh = gioi_tinh_type.NAM;
            }
            else
            {
                if (int.TryParse(nhanSu.gioi_tinh_, out gioiTinh))
                {
                    nhanSu.gioi_tinh = gioiTinh > 0 ? gioi_tinh_type.NAM : gioi_tinh_type.NU;
                }
                else
                {
                    nhanSu.gioi_tinh = gioi_tinh_type.NU;
                }
            }
            #endregion << gioitinh >>

            #region << convert nơi sinh - quê quán >>
            // split dia chi  => dia chi tinh quan/huyen xa/phuong
            if (!string.IsNullOrEmpty((string)nhanSu.que_quan_ten_phuong_xa))
            {
                string[] parts = ((string)nhanSu.que_quan_ten_phuong_xa).Split(new string[] { "-", "," }, StringSplitOptions.RemoveEmptyEntries);
                nhanSu.que_quan_ten_phuong_xa = "";
                if (parts.Length >= 3)
                {
                    string tinh = parts[parts.Length - 1].Trim().ToLower();
                    string huyen = parts[parts.Length - 2].Trim().ToLower();
                    string xa = parts[parts.Length - 3].Trim().ToLower();
                    string chitiet = "";
                    if (parts.Length > 3) // lay dia chi chi tiet
                    {
                        var other = new string[parts.Length - 3];
                        Array.Copy(parts, 0, other, 0, parts.Length - 3);
                        chitiet = string.Join(", ", other).Trim();
                    }

                    var Tinh = TinhThanhCL.LayTheoTen(tinh);
                    if (Tinh != null)
                    {
                        nhanSu.que_quan_ma_tinh_thanh = Tinh.ma;
                        nhanSu.que_quan_ten_tinh_thanh = Tinh.ten;

                        var Huyen = QuanHuyenCL.LayTheoTen(Tinh.ma, huyen);
                        if (Huyen != null)
                        {
                            nhanSu.que_quan_ma_quan_huyen = Huyen.ma;
                            nhanSu.que_quan_ten_quan_huyen = Huyen.ten;
                            var Xa = PhuongXaCL.LayTheoTen(Tinh.ma, Huyen.ma, xa);
                            if (Xa != null)
                            {
                                nhanSu.que_quan_ma_phuong_xa = Xa.ma;
                                nhanSu.que_quan_ten_phuong_xa = Xa.ten;
                            }
                        }
                    }

                }
            }
            #endregion

            #region << convert dia chi >>
            // split dia chi  => dia chi tinh quan/huyen xa/phuong
            if (!string.IsNullOrEmpty((string)nhanSu.dia_chi_chi_tiet))
            {
                string[] parts = ((string)nhanSu.dia_chi_chi_tiet).Split(new string[] { "-", "," }, StringSplitOptions.RemoveEmptyEntries);
                if (parts.Length >= 3)
                {
                    string tinh = parts[parts.Length - 1].Trim().ToLower();
                    string huyen = parts[parts.Length - 2].Trim().ToLower();
                    string xa = parts[parts.Length - 3].Trim().ToLower();
                    string chitiet = "";
                    if (parts.Length > 3) // lay dia chi chi tiet
                    {
                        var other = new string[parts.Length - 3];
                        Array.Copy(parts, 0, other, 0, parts.Length - 3);
                        chitiet = string.Join(", ", other).Trim();
                    }

                    var Tinh = TinhThanhCL.LayTheoTen(tinh);
                    if (Tinh != null)
                    {
                        nhanSu.dia_chi_ma_tinh_thanh = Tinh.ma;
                        nhanSu.dia_chi_ten_tinh_thanh = Tinh.ten;

                        var Huyen = QuanHuyenCL.LayTheoTen(Tinh.ma, huyen);
                        if (Huyen != null)
                        {
                            nhanSu.dia_chi_ma_quan_huyen = Huyen.ma;
                            nhanSu.dia_chi_ten_quan_huyen = Huyen.ten;
                            var Xa = PhuongXaCL.LayTheoTen(Tinh.ma, Huyen.ma, xa);
                            if (Xa != null)
                            {
                                nhanSu.dia_chi_ma_phuong_xa = Xa.ma;
                                nhanSu.dia_chi_ten_phuong_xa = Xa.ten;
                                nhanSu.dia_chi_chi_tiet = chitiet;
                            }
                        }
                    }

                }
            }
            #endregion

            #region << convert ho khau >>
            // split ho khau  => ho khau tinh quan/huyen xa/phuong
            if (!string.IsNullOrEmpty((string)nhanSu.ho_khau_chi_tiet))
            {
                string[] parts = ((string)nhanSu.ho_khau_chi_tiet).Split(new string[] { "-", "," }, StringSplitOptions.RemoveEmptyEntries);
                if (parts.Length >= 3)
                {
                    string tinh = StringUtil.UnsignString(parts[parts.Length - 1].Trim().ToLower());
                    string huyen = StringUtil.UnsignString(parts[parts.Length - 2].Trim().ToLower());
                    string xa = StringUtil.UnsignString(parts[parts.Length - 3].Trim().ToLower());
                    string chitiet = "";
                    if (parts.Length > 3) // lay dia chi chi tiet
                    {
                        var other = new string[parts.Length - 3];
                        Array.Copy(parts, 0, other, 0, parts.Length - 3);
                        chitiet = string.Join(", ", other).Trim();
                    }

                    var Tinh = TinhThanhCL.LayTheoTen(tinh);
                    if (Tinh != null)
                    {
                        nhanSu.ho_khau_ma_tinh_thanh = Tinh.ma;
                        nhanSu.ho_khau_ten_tinh_thanh = Tinh.ten;

                        var Huyen = QuanHuyenCL.LayTheoTen(Tinh.ma, huyen);
                        if (Huyen != null)
                        {
                            nhanSu.ho_khau_ma_quan_huyen = Huyen.ma;
                            nhanSu.ho_khau_ten_quan_huyen = Huyen.ten;
                            var Xa = PhuongXaCL.LayTheoTen(Tinh.ma, Huyen.ma, xa);
                            if (Xa != null)
                            {
                                nhanSu.ho_khau_ma_phuong_xa = Xa.ma;
                                nhanSu.ho_khau_ten_phuong_xa = Xa.ten;
                                nhanSu.ho_khau_chi_tiet = chitiet;
                            }
                        }
                    }

                }
            }
            #endregion

            #region << convert noi kham chua benh >>
            //  noi kham chua benh 
            if (!string.IsNullOrEmpty(nhanSu.kcb_ma_tinh_thanh))
            {
                var tinh = TinhThanhCL.LayTheoMa(nhanSu.kcb_ma_tinh_thanh);
                if (tinh != null)
                {
                    nhanSu.kcb_ten_tinh_thanh = tinh.ten;
                    var benhvien = BenhVienCL.LayBenhVien(tinh.ma, nhanSu.kcb_ma_benh_vien);
                    if (benhvien != null)
                    {
                        nhanSu.kcb_ten_benh_vien = benhvien.ten;
                    }
                }

            }
            #endregion
        }
    }
}