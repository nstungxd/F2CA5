using System;
using System.Collections;
using System.Collections.Generic;
using System.ComponentModel;
using System.Globalization;
using System.Linq;
using System.Reflection;
using System.Text;

namespace CRUD.Core
{
    public class amnd_state_type
    {
        /// <summary>
        /// Active
        /// </summary>
        public const string A = "A";

        /// <summary>
        /// Inactive
        /// </summary>
        public const string I = "I";
    }


    public class amnd_type
    {
        public const string Insert = "1";

        public const string Update = "3";

        public const string Delete = "5";
    }

    public class gioi_tinh_type
    {
        public const int NAM = 1;
        public const int NU = 0;

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name: "Nam", value :gioi_tinh_type.NAM.ToString() ),
            new KeyValue(name:"Nữ", value :gioi_tinh_type.NU.ToString() )
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }

        public static KeyValue[] GetEnumsInt()
        {
            return new KeyValue[]
            {
                new KeyValue(name: "Nam", value :gioi_tinh_type.NAM ),
                new KeyValue(name:"Nữ", value :gioi_tinh_type.NU )
            };
        }
    }

    public class ma_vung_ss_type
    {
        public const string K1 = "K1";
        public const string K2 = "K2";
        public const string K3 = "K3";
        public const string Null = "";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"K1", value :ma_vung_ss_type.K1 ),
            new KeyValue(name:"K2", value :ma_vung_ss_type.K2 ),
            new KeyValue(name:"K3", value :ma_vung_ss_type.K3 ),
            new KeyValue(name:"", value :ma_vung_ss_type.Null )
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }

    public class phuong_an_DK05
    {
        public const string TC = "TC";
        public const string TD = "TD";
        public const string TM = "TM";
        public const string GC = "GC";
        public const string GD = "GD";
        public const string GH = "GH";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"TC - Tăng do chuyển tỉnh", value :phuong_an_DK05.TC ),
            new KeyValue(name:"TD - Tăng do chuyển đơn vị", value :phuong_an_DK05.TD ),
            new KeyValue(name:"TM - Tăng mới", value :phuong_an_DK05.TM ),
            new KeyValue(name:"GC - Giảm do chuyển tỉnh", value :phuong_an_DK05.GC ),
            new KeyValue(name:"GD - Giảm do chuyển đơn vị", value :phuong_an_DK05.GD ),
            new KeyValue(name:"GH - Giảm hẳn", value :phuong_an_DK05.GH ),
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }


    public class phuong_an_D05TS
    {
        public const string DC = "DC";
        public const string DL = "DL";
        public const string DT = "DT";
        public const string GB = "GB";
        public const string GC = "GC";
        public const string GD = "GD";
        public const string GH = "GH";
        public const string TM = "TM";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"DC - Điều chỉnh", value :phuong_an_D05TS.DC ),
            new KeyValue(name:"DL - Đóng lại", value :phuong_an_D05TS.DL ),
            new KeyValue(name:"DT - Đóng tiếp", value :phuong_an_D05TS.DT ),
            new KeyValue(name:"GB - Chuyển sang đóng BHXH bắt buộc", value :phuong_an_D05TS.GB ),
            new KeyValue(name:"GC - Đến hạn nhưng không đóng", value :phuong_an_D05TS.GC ),
            new KeyValue(name:"GD - Chuyển đi", value :phuong_an_D05TS.GD ),
            new KeyValue(name:"GH - Nghỉ hưởng chế độ", value :phuong_an_D05TS.GH ),
            new KeyValue(name:"TM - Tăng mới", value :phuong_an_D05TS.TM ),
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }


    public class ma_vung_ltt_type
    {
        public const string V1 = "01";
        public const string V2 = "02";
        public const string V3 = "03";
        public const string V4 = "04";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"Vùng I", value :ma_vung_ltt_type.V1 ),
            new KeyValue(name:"Vùng II", value :ma_vung_ltt_type.V2 ),
            new KeyValue(name:"Vùng III", value :ma_vung_ltt_type.V3 ),
            new KeyValue(name:"Vùng IV", value :ma_vung_ltt_type.V4 )
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }

    public class tinh_luong_type
    {
        public const string HESO = "HESO";
        public const string MUCLUONG = "MUCLUONG";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name: "Hệ số", value :tinh_luong_type.HESO ),
            new KeyValue(name:"Mức lương", value :tinh_luong_type.MUCLUONG )
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }

    /// <summary>
    /// kiểu import dữ liệu
    /// </summary>
    public enum data_import_type
    {
        [Description("Xóa dữ liệu cũ")]
        REPLACE = 0,

        [Description("Thêm vào dữ liệu cũ")]
        APPEND = 1
    }

    public class trang_thai_nghi_viec
    {
        [Description("Nghỉ hẳn")]
        public const string NGHI_HAN = "nghi_han";

        [Description("Hưu trí")]
        public const string HUU_TRI = "huu_tri";

        [Description("Thai sản")]
        public const string THAI_SAN = "thai_san";

        [Description("Ốm đau")]
        public const string OM_DAU = "om_dau";

        [Description("Không lương")]
        public const string KHONG_LUONG = "khong_luong";

        public static List<KeyValue> GetList()
        {
            return new List<KeyValue>() { 
                new KeyValue("",""),
                new KeyValue(HUU_TRI,"Hưu trí"),
                new KeyValue(THAI_SAN,"Thai sản"),
                new KeyValue(OM_DAU,"Ốm đau"),
                new KeyValue(KHONG_LUONG,"Không lương"),
            };
        }
    }

    public class KeyValue
    {
        public string name { get; set; }
        public object value { get; set; }

        public KeyValue() { }
        public KeyValue(string name, object value)
        {
            this.name = name;
            this.value = value;
        }

    }

    public sealed class DinhDangTien
    {
        public const string HeSo_SMS = "##0,###";
        public const string Tien_SMS = "###.###.###.###.##0";
        public const string HeSo_VN = "###,###,###,###,##0";
        public const string Tien_VN = "#0.###";
    }

    public enum CachTinhLuong
    {
        [Description("Cả hai")]
        CaHai = 0,
        [Description("Mức lương")]
        MucLuong = 1,
        [Description("Hệ số lương")]
        HeSo = 2
    }

    public enum PhuongThucNhap
    {
        [Description("Hệ số")]
        HeSo = 0,
        [Description("Phần trăm")]
        PhanTram = 1,
        TuDong = -1,
    }
    public class muc_huong_bhyt
    {
        public const string MH1 = "1";
        public const string MH2 = "2";
        public const string MH3 = "3";
        public const string MH4 = "4";
        public const string MH5 = "5";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"Mức 1 - 100% không giới hạn tỷ lệ thanh toán", value :muc_huong_bhyt.MH1 ),
            new KeyValue(name:"Mức 2 - 100% có giới hạn tỷ lệ thanh toán", value :muc_huong_bhyt.MH2 ),
            new KeyValue(name:"Mức 3 - 95% có giới hạn tỷ lệ thanh toán", value :muc_huong_bhyt.MH3 ),
            new KeyValue(name:"Mức 4 - 80% có giới hạn tỷ lệ thanh toán", value :muc_huong_bhyt.MH4 ),
            new KeyValue(name:"Mức 5 - 100% kể cả chi phí KCB ngoài phạm vi", value :muc_huong_bhyt.MH5)
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }
    public class phuong_thuc_dong_bhxh
    {
        public const string _1Thang = "1";
        public const string _1Quy = "3";
        public const string _6Thang = "6";
        public const string _1Nam = "12";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"1 Tháng", value :phuong_thuc_dong_bhxh._1Thang ),
            new KeyValue(name:"3 Tháng", value :phuong_thuc_dong_bhxh._1Quy ),
            new KeyValue(name:"6 Tháng", value :phuong_thuc_dong_bhxh._6Thang ),
            new KeyValue(name:"1 Năm", value :phuong_thuc_dong_bhxh._1Nam ),            
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }

    public class phuong_thuc_dong_bhxh_tk3
    {
        public const string _1Thang = "1";
        public const string _1Quy = "3";
        public const string _6Thang = "6";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"1 Tháng 1 lần", value :phuong_thuc_dong_bhxh._1Thang ),
            new KeyValue(name:"3 Tháng 1 lần", value :phuong_thuc_dong_bhxh._1Quy ),
            new KeyValue(name:"6 Tháng 1 lần", value :phuong_thuc_dong_bhxh._6Thang ),
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }

    public class ty_le_dong
    {
        public const string _01 = "30,5";
        public const string _02 = "2";
        public const string _03 = "4,5";
        public const string _04 = "6";
        public const string _05 = "22";
        public const string _06 = "20";
        public const string _07 = "18";
        public const string _08 = "16";
        public const string _09 = "32,5";
        public const string _10 = "30,5";
        public const string _11 = "28,5";
        public const string _12 = "25";
        public const string _13 = "23";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"Tỷ lệ khi chỉ tham gia BHXH,BHYT: 30,5% từ 01/01/2014", value :ty_le_dong._01),
            new KeyValue(name:"Tỉ lệ đóng BHTN: 2% từ 01/01/2014", value :ty_le_dong._02 ),
            new KeyValue(name:"Truy thu tiền thẻ BHYT không trả thẻ khi nghỉ việc: 4,5% từ 01/01/2014", value :ty_le_dong._03 ),
            new KeyValue(name:"Đối tượng chỉ tham gia BHYT (mức tối đa): 6% từ 01/01/2014", value :ty_le_dong._04 ),
            new KeyValue(name:"Đối tượng chỉ tham gia BHXH (tự nguyện): 22 từ 01/01/2014", value :ty_le_dong._05 ),
            new KeyValue(name:"Đối tượng chỉ tham gia BHXH (tự nguyện): 20% từ 01/01/2012 đến 31/12/2013", value :ty_le_dong._06 ),
            new KeyValue(name:"Đối tượng chỉ tham gia BHXH (tự nguyện): 18% từ 01/01/2010 đến 31/12/2011", value :ty_le_dong._07 ),
            new KeyValue(name:"Đối tượng chỉ tham gia BHXH (tự nguyện): 16% từ 01/01/2007 đến 31/12/2009", value :ty_le_dong._08 ),
            new KeyValue(name:"Tỷ lệ tham gia BHXH, BHYT, BHTN: 32,5% từ 01/01/2014", value :ty_le_dong._09 ),
            new KeyValue(name:"Tỷ lệ tham gia BHXH, BHYT, BHTN: 30,5% từ 01/01/2012 đến 31/12/2013", value :ty_le_dong._10 ),
            new KeyValue(name:"Tỷ lệ tham gia BHXH, BHYT, BHTN: 28,5% từ 01/01/2010 đến 31/12/2011", value :ty_le_dong._11 ),
            new KeyValue(name:"Tỷ lệ tham gia BHXH, BHYT, BHTN: 25% từ 01/01/2009 đến 31/12/200", value :ty_le_dong._12 ),
            new KeyValue(name:"Tỷ lệ tham gia BHXH, BHYT, BHT: 23% từ 01/01/2007 đến 31/12/2008", value :ty_le_dong._13 ),
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }

    public enum D02TSEnum
    {
        [Description("Tăng")]
        TangTieuDe = 100,
        [Description("Tăng lao động")]
        TangTieuDeLaoDong = 110,
        [Description("")]
        TangLaoDong = 111,
        [Description("Tăng tiền lương")]
        TangTieuDeTienLuong = 120,
        [Description("")]
        TangLaoDongTienLuong = 121,
        [Description("Cộng Tăng")]
        CongTang = 199,
        [Description("Giảm")]
        GiamTieuDe = 200,
        [Description("Giảm lao động")]
        GiamTieuDeLaoDong = 210,
        [Description("")]
        GiamLaoDong = 211,
        [Description("Giảm tiền lương")]
        GiamTieuDeTienLuong = 220,
        [Description("")]
        GiamLaoDongTienLuong = 221,
        [Description("Cộng giảm")]
        CongGiam = 299
    }

    public enum D05TSEnum
    {
        Tang = 500,
        TangSoNguoi = 501,
        TangSoNguoiList = 508,
        TangMucTienDong = 502,
        TangMucTienDongList = 510,
        CongTang = 503,
        Giam = 504,
        GiamSoNguoi = 505,
        GiamSoNguoiList = 509,
        GiamMucTienDong = 506,
        GiamMucTienDongList = 511,
        CongGiam = 507
    }

    public class DoiTuongThamGia
    {
        public const int DT03 = 3;
        public const int DT04 = 4;
        public const int DT042 = 42;
        public const int DT05 = 5;

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"Do ngân sách nhà nước đóng", value :DoiTuongThamGia.DT03),
            new KeyValue(name:"Được ngân sách nhà nước hỗ trợ mức đóng", value :DoiTuongThamGia.DT04 ),
            new KeyValue(name:"Học sinh/Sinh viên", value :DoiTuongThamGia.DT042 ),
            new KeyValue(name:"Tham gia BHYT theo hộ gia đình", value :DoiTuongThamGia.DT05 ),
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }

    public class luong_co_so
    {
        public const int L1 = 1210000;
        public const int L2 = 1150000;


        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"1.210.000", value :luong_co_so.L1 ),
            new KeyValue(name:"1.150.000", value :luong_co_so.L2 )        
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }

    public enum EDoiTuongThamGia
    {
        [Description("Nhóm do ngân sách nhà nước đóng")]
        DT03 = 3,
        [Description("Nhóm được ngân sách nhà nước hỗ trợ mức đóng")]
        DT04 = 4,
        [Description("Học sinh/Sinh viên")]
        DT042 = 42,
        [Description("Nhóm tham gia BHYT theo hộ gia đình")]
        DT05 = 5
    }
    public class SessionCore
    {
        public const string ID = "ID";
    }
    public class ly_do_ngung_type
    {
        public const string L1 = "1";
        public const string L2 = "2";
        public const string L3 = "3";
        public const string L4 = "4";
        public const string L5 = "5";
        public const string L6 = "6";
        public const string L7 = "7";
        public const string L8 = "8";
        public const string L9 = "9";
        public const string L10 = "10";

        private static KeyValue[] _lst = new KeyValue[]
        {
            new KeyValue(name:"Thay đổi email nhận thông báo", value :ly_do_ngung_type.L1 ),
            new KeyValue(name:"Thay đổi thông tin đơn vị", value :ly_do_ngung_type.L2 ),
            new KeyValue(name:"Thay đổi thông tin chứng thư", value :ly_do_ngung_type.L3 ),
            new KeyValue(name:"Phần mềm không đầy đủ thủ tục hồ sơ", value :ly_do_ngung_type.L4 ),
            new KeyValue(name:"Phần mềm giao dịch không thuận tiện", value :ly_do_ngung_type.L5 ),
            new KeyValue(name:"Hỗ trợ dịch vụ kém", value :ly_do_ngung_type.L6 ),
            new KeyValue(name:"Chuyển sang nhà cung cấp dịch vụ I-VAN khác", value :ly_do_ngung_type.L7 ),
            new KeyValue(name:"Đơn vị giải thể", value :ly_do_ngung_type.L8 ),
            new KeyValue(name:"Lý do khác", value :ly_do_ngung_type.L9 )
        };

        public static KeyValue[] GetEnums()
        {
            return _lst;
        }
    }

    public sealed class  DuongDanFolder
    {
        public const string DinhKem = "DinhKem";
        public const string HoSoKetXuat = "HoSoKetXuat";
        public const string ImportFileFolder = "FileExcelImport";
        public const string DangKyGiaoDichDienTu = "DangKyGiaoDichDienTu";
        public const string Barcode = "BarCode";
        public const string TenDonVi = "TenDonVi";
        public const string ChuKy = "ChuKy";
    }

}
