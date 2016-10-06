using System;
using System.Collections.Generic;
using System.Text;
using FluentNHibernate.Mapping;
using CRUD.Core.Domain;

namespace CRUD.Core.Mapping
{
    public class nsNhanSuMap : ClassMap<nsNhanSu>
    {
        public nsNhanSuMap()
        {
            Table(typeof(nsNhanSu).Name);
            Id(x => x.ID).GeneratedBy.Identity();
            Map(x => x.amnd_date);
            Map(x => x.amnd_state);
            Map(x => x.amnd_officer);
            Map(x => x.amnd_type);
            Map(x => x.to_chuc_id);
            Map(x => x.ma_nhan_vien);
            Map(x => x.ho_ten);
            Map(x => x.than_nhan_khac);
            Map(x => x.ten_me);
            Map(x => x.ten_cha);
            Map(x => x.so_the_bhyt);
            Map(x => x.so_so_bhxh);
            Map(x => x.quoc_tich);

            Map(e => e.que_quan_ma_tinh_thanh);
            Map(e => e.que_quan_ma_quan_huyen);
            Map(e => e.que_quan_ma_phuong_xa);
            Map(e => e.que_quan_ten_tinh_thanh);
            Map(e => e.que_quan_ten_quan_huyen);
            Map(e => e.que_quan_ten_phuong_xa);

            Map(x => x.ngay_sinh);
            Map(x => x.phong_ban_id);

            Map(x => x.kcb_ma_tinh_thanh);
            Map(x => x.kcb_ten_tinh_thanh);
            Map(x => x.kcb_ma_benh_vien);
            Map(x => x.kcb_ten_benh_vien);

            Map(x => x.hop_dong_so);
            Map(x => x.hop_dong_ngay_hieu_luc);
            Map(x => x.hop_dong_loai);
            Map(x => x.gioi_tinh);
            Map(x => x.email);
            Map(x => x.dien_thoai);

            Map(e => e.ho_khau_ma_tinh_thanh);
            Map(e => e.ho_khau_ma_quan_huyen);
            Map(e => e.ho_khau_ma_phuong_xa);
            Map(e => e.ho_khau_ten_tinh_thanh);
            Map(e => e.ho_khau_ten_quan_huyen);
            Map(e => e.ho_khau_ten_phuong_xa);
            Map(e => e.ho_khau_chi_tiet);

            Map(e => e.dia_chi_ma_tinh_thanh);
            Map(e => e.dia_chi_ma_quan_huyen);
            Map(e => e.dia_chi_ma_phuong_xa);
            Map(e => e.dia_chi_ten_tinh_thanh);
            Map(e => e.dia_chi_ten_quan_huyen);
            Map(e => e.dia_chi_ten_phuong_xa);
            Map(e => e.dia_chi_chi_tiet);

            Map(x => x.hop_dong_ngay);
            Map(x => x.dan_toc);
            Map(x => x.cmnd_ten_noi_cap);
            Map(x => x.cmnd_so);
            Map(x => x.cmnd_ngay_cap);
            Map(x => x.cmnd_ma_noi_cap);
            Map(x => x.chuc_vu);
            Map(x => x.cha_me_nguoi_giam_ho);
            Map(x => x.ngay_cap_so_bhxh);
            Map(x => x.the_bhyt_ngay_cap);
            Map(x => x.the_bhyt_phuong_thuc_dong);
            Map(x => x.trang_thai_nghi);
            Map(x => x.ma_don_vi);
            Map(x => x.ma_quy_trinh);
            Map(x => x.loai_dt);
            Map(x => x.phuong_an);
            Map(x => x.muc_dong_bhyt);
            Map(x => x.noi_cap_so);
            Map(x => x.ma_pb);
            Map(x => x.ma_vung);
            Map(x => x.the_bhyt_so_thang);
            Map(x => x.chi_co_nam_sinh);

            HasMany(x => x.qua_trinh_dong)
                .Inverse()
                .Cascade.All()
                .KeyColumn("nhan_su_id");
        }
    }
}
