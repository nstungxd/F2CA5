using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace CRUD.Core.Domain
{
    public class nsNhanSu : domain
    {
        public virtual string so_so_bhxh { get; set; }
        public virtual string so_the_bhyt { get; set; }
        public virtual string ho_ten { get; set; }
        public virtual string ho { get; set; }
        public virtual string ten { get; set; }
        public virtual string ngay_sinh { get; set; }
        public virtual int gioi_tinh { get; set; }
        public virtual string gioi_tinh_ { get; set; } // linhpn dung de convert khi import
        public virtual string dan_toc { get; set; }
        public virtual string quoc_tich { get; set; }
        public virtual string ma_nhan_vien { get; set; }
        public virtual string phong_ban_id { get; set; }
        public virtual string chuc_vu { get; set; }
        public virtual string dien_thoai { get; set; }
        public virtual string email { get; set; }
        public virtual string que_quan_ma_tinh_thanh { get; set; }
        public virtual string que_quan_ten_tinh_thanh { get; set; }
        public virtual string que_quan_ma_quan_huyen { get; set; }
        public virtual string que_quan_ten_quan_huyen { get; set; }
        public virtual string que_quan_ma_phuong_xa { get; set; }
        public virtual string que_quan_ten_phuong_xa { get; set; }
        public virtual string cha_me_nguoi_giam_ho { get; set; }
        public virtual string ten_cha { get; set; }
        public virtual string ten_me { get; set; }
        public virtual string than_nhan_khac { get; set; }
        public virtual string cmnd_so { get; set; }
        public virtual string cmnd_ngay_cap { get; set; }
        public virtual string cmnd_ma_noi_cap { get; set; }
        public virtual string cmnd_ten_noi_cap { get; set; }
        public virtual string ho_khau_ma_tinh_thanh { get; set; }
        public virtual string ho_khau_ten_tinh_thanh { get; set; }
        public virtual string ho_khau_ma_quan_huyen { get; set; }
        public virtual string ho_khau_ten_quan_huyen { get; set; }
        public virtual string ho_khau_ma_phuong_xa { get; set; }
        public virtual string ho_khau_ten_phuong_xa { get; set; }
        public virtual string ho_khau_chi_tiet { get; set; }
        public virtual string dia_chi_ma_tinh_thanh { get; set; }
        public virtual string dia_chi_ten_tinh_thanh { get; set; }
        public virtual string dia_chi_ma_quan_huyen { get; set; }
        public virtual string dia_chi_ten_quan_huyen { get; set; }
        public virtual string dia_chi_ma_phuong_xa { get; set; }
        public virtual string dia_chi_ten_phuong_xa { get; set; }
        public virtual string dia_chi_chi_tiet { get; set; }
        public virtual string kcb_ma_tinh_thanh { get; set; }
        public virtual string kcb_ten_tinh_thanh { get; set; }
        public virtual string kcb_ma_benh_vien { get; set; }
        public virtual string kcb_ten_benh_vien { get; set; }
        public virtual string hop_dong_so { get; set; }
        public virtual string hop_dong_ngay { get; set; }
        public virtual string hop_dong_ngay_hieu_luc { get; set; }
        public virtual string hop_dong_loai { get; set; }

        public virtual string ma_don_vi { get; set; }
        public virtual string ma_quy_trinh { get; set; }
        public virtual string loai_dt { get; set; }
        public virtual string phuong_an { get; set; }
        public virtual float? muc_dong_bhyt { get; set; }
        public virtual string noi_cap_so { get; set; }
       
        public virtual string ma_pb { get; set; }
        public virtual string ma_vung { get; set; }
        public virtual bool chi_co_nam_sinh { get; set; }
        public virtual string ngay_cap_so_bhxh { get; set; } // Ngày cấp sổ BHXH
        public virtual int the_bhyt_so_thang { get; set; }
        public virtual string the_bhyt_phuong_thuc_dong { get; set; }
        public virtual string the_bhyt_ngay_cap { get; set; } // Ngày cấp thẻ BHYT
        public virtual string trang_thai_nghi { get; set; } // trạng thái nghỉ (nếu có). sử dụng BHXH.Core.trang_thai_nghi_viec
        public virtual string muc_luong_y_te { get; set; }
        public virtual string muc_luong_dong_bhyt { get; set; }
        public virtual string muc_luong_phu_cap { get; set; }
        public virtual string muc_luong_bo_sung { get; set; }

        public virtual IList<nsQuaTrinhDong> qua_trinh_dong { get; set; }
        //public virtual string add_info_4 { get; set; }
        //public virtual string add_info_5 { get; set; }
        //public virtual string add_info_6 { get; set; }
        //public virtual string add_info_7 { get; set; }
        //public virtual string add_info_8 { get; set; }
        //public virtual string add_info_9 { get; set; }
        //public virtual string add_info_10 { get; set; }
        //public virtual string add_info_11 { get; set; }
        //public virtual string add_info_12 { get; set; }
        //public virtual string add_info_13 { get; set; }
        //public virtual string add_info_14 { get; set; }
        //public virtual string add_info_15 { get; set; }
    }
}
