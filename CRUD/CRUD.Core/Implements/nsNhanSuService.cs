using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using NHibernate.Linq;
using CRUD.Core.Domain;
using CRUD.Core;
using FX.Data;
using CRUD.Core.Interfaces;
using NHibernate;
using NHibernate.Criterion;
using CRUD.Utils;

namespace CRUD.Core.Implements
{
    public class nsNhanSuService : FX.Data.BaseService<nsNhanSu, string>, CRUD.Core.Interfaces.InsNhanSuService
    {
        public nsNhanSuService(string sessionFactoryConfigPath)
            : base(sessionFactoryConfigPath)
        { }

        public List<nsNhanSu> LayTheoPhongBan(string toChucId, string phongBanId, string keyword, int pageIndex, int pageSize, out int total)
        {
            if (string.IsNullOrEmpty(keyword) || keyword.Length < 2) // chỉ tìm kiếm nếu keyword có 2 từ trở lên
                keyword = "";

            // for sqlite
            keyword = keyword.Replace("đ", "%").Replace("Đ", "%").Replace("Á", "%").Replace("á", "%");

            var query = this.Query.Where(x => x.to_chuc_id == toChucId && x.amnd_state == amnd_state_type.A
                                              && (x.ho_ten.Contains(keyword) ||
                                                  x.so_so_bhxh.Contains(keyword) ||
                                                  x.so_the_bhyt.Contains(keyword))
                                         );

            if (phongBanId != "-1")
                query = query.Where(e => e.phong_ban_id == phongBanId);

            total = query.Count();
            return query.Skip((pageIndex - 1) * pageSize).Take(pageSize).ToList();

            //var criteria = CreateCriteria();
            //criteria.Add(Expression.Like("to_chuc_id", toChucId));
            //criteria.Add(Expression.Like("amnd_state", amnd_state_type.A));
            //if (phongBanId != "-1")
            //    // query = query.Where(e => e.phong_ban_id == phongBanId);
            //    criteria.Add(Expression.Like("phong_ban_id", phongBanId));

            //criteria.Add(Expression.Disjunction()
            //    //.Add(Expression.Like(Projections.SqlFunction(
            //    //              "upper", NHibernateUtil.String,
            //    //               Projections.Property<nsNhanSu>(x => x.ho_ten)), keyword.ToUpper()))
            //    .Add(Expression.InsensitiveLike("ho_ten", "%" + keyword + "%"))
            //    .Add(Expression.InsensitiveLike("so_so_bhxh", "%" + keyword + "%"))
            //    .Add(Expression.InsensitiveLike("so_the_bhyt", "%" + keyword + "%")));

            ////total = query.Count();
            //total = ((ICriteria)criteria.Clone()).SetProjection(Projections.Count(Projections.Id())).UniqueResult<int>();
            //if (total == 0)
            //    return new List<nsNhanSu>();
            //else
            //{
            //    //return query.Skip((pageIndex - 1) * pageSize).Take(pageSize).ToList();
            //    var lst = criteria.SetFirstResult((pageIndex - 1) * pageSize).SetMaxResults(pageSize).List();
            //    return lst.Cast<nsNhanSu>().ToList();
            //}
        }

        public List<nsNhanSu> LayDanhSachTheoTrangThaiNghi(string toChucId, string trangThaiNghi, string keyword, int pageIndex, int pageSize, out int total)
        {
            // for sqlite
            //  keyword = keyword.Replace("đ", "%").Replace("Đ", "%").Replace("Á", "%").Replace("á", "%");

            var query = this.Query.Where(x => x.to_chuc_id == toChucId && x.amnd_state == amnd_state_type.A
                                              && (x.ho_ten.Contains(keyword) ||
                                                  x.so_so_bhxh.Contains(keyword) ||
                                                  x.so_the_bhyt.Contains(keyword))
                                         );

            if (string.IsNullOrEmpty(trangThaiNghi))
                query = query.Where(e => e.trang_thai_nghi == null || e.trang_thai_nghi == string.Empty);
            else
                query = query.Where(e => e.trang_thai_nghi.Equals(trangThaiNghi));

            total = query.Count();
            return query.OrderBy(x => x.ho_ten).Skip((pageIndex - 1) * pageSize).Take(pageSize).ToList();
        }

        public List<nsNhanSu> LayDanhSachTheoTrangThaiNghi(string toChucId, string keyword, List<string> skipDsTrangThaiNghi, int pageIndex, int pageSize, out int total)
        {
            if (string.IsNullOrEmpty(keyword))
                keyword = "";
            if (skipDsTrangThaiNghi == null)
                skipDsTrangThaiNghi = new List<string>();

            // for sqlite
            keyword = keyword.Replace("đ", "%").Replace("Đ", "%").Replace("Á", "%").Replace("á", "%");

            var query = this.Query.Where(x => x.to_chuc_id == toChucId && x.amnd_state == amnd_state_type.A
                                          && (!skipDsTrangThaiNghi.Contains(x.trang_thai_nghi) || x.trang_thai_nghi == null)
                                          && (x.ho_ten.Contains(keyword) ||
                                              x.so_so_bhxh.Contains(keyword) ||
                                              x.so_the_bhyt.Contains(keyword))
                                     );

            total = query.Count();
            return query.Skip((pageIndex - 1) * pageSize).Take(pageSize).ToList();
        }
        public nsNhanSu LayTheoId(string id, string toChucId)
        {
            var query = this.Query.Where(x => x.ID == Convert.ToInt32(id) && x.amnd_state == amnd_state_type.A && x.to_chuc_id == toChucId);
            return query.FirstOrDefault();
        }

        public nsNhanSu InActive(string id, string toChucId, string taiKhoan)
        {
            var t = LayTheoId(id, toChucId);
            if (t != null)
            {
                t.amnd_officer = taiKhoan;
                t.amnd_date = DateTime.Now;
                t.amnd_state = amnd_state_type.I;
                t.amnd_type = amnd_type.Delete;
                return Update(t);
            }
            else
            {
                return null;
            }
        }

        public void InActiveTheoPhongBan(string id, string toChucId, string taiKhoan)
        {
            var tableName = typeof(nsNhanSu).Name;
            var sql = "UPDATE {0} ";
            sql += "SET amnd_state=:amnd_state, amnd_officer= :amnd_officer, amnd_type=:amnd_type ";
            sql += "WHERE to_chuc_id= :to_chuc_id ";

            sql = string.Format(sql, tableName);
            this.ExcuteNonQuery(sql, false,
                                            new SQLParam("amnd_state", amnd_state_type.I),
                                            new SQLParam("amnd_officer", taiKhoan),
                                            new SQLParam("amnd_type", amnd_type.Delete),
                                            new SQLParam("to_chuc_id", toChucId));
        }

        public nsNhanSu LayTheoSoTheBHYT(string soTheBHYT, string toChucId)
        {
            var query = this.Query.Where(x => x.to_chuc_id == toChucId && x.amnd_state == amnd_state_type.A
                                             && x.so_the_bhyt == soTheBHYT
                                        );
            return query.FirstOrDefault();
        }

        public nsNhanSu LayTheoSoSoBHXH(string soSoBHXH, string toChucId)
        {
            var query = this.Query.Where(x => x.to_chuc_id == toChucId && x.amnd_state == amnd_state_type.A
                                              && x.so_so_bhxh == soSoBHXH
                                         );
            return query.FirstOrDefault();
        }

        /// <summary>
        /// lay theo ma nhan vien
        /// </summary>
        /// <param name="maNhanVien"></param>
        /// <param name="toChucId"></param>
        /// <returns></returns>
        public nsNhanSu LayTheoMaNhanVien(string maNhanVien, string toChucId)
        {
            var query = this.Query.Where(x => x.to_chuc_id == toChucId && x.amnd_state == amnd_state_type.A
                                              && x.ma_nhan_vien == maNhanVien
                                         );
            return query.FirstOrDefault();
        }

        public List<nsNhanSu> LayTatCaNhanSu(string toChucId, int pageIndex, int pageSize, out int total)
        {
            var query = this.Query.Where(x => x.to_chuc_id == toChucId && x.amnd_state == amnd_state_type.A && x.phong_ban_id != null && x.phong_ban_id != "");
            total = query.Count();
            if (total == 0)
                return new List<nsNhanSu>();
            else
                return query.Skip((pageIndex - 1) * pageSize).Take(pageSize).ToList();
        }

        public void XoaTheoPhongBan(string phongBanId, string toChucId)
        {
            var tableName = typeof(nsNhanSu).Name;
            var sql = "Delete from {0} ";
            sql += "WHERE phong_ban_id= :phong_ban_id AND to_chuc_id= :to_chuc_id";

            sql = string.Format(sql, tableName);
            this.ExcuteNonQuery(sql, false, new SQLParam("phong_ban_id", phongBanId), new SQLParam("to_chuc_id", toChucId));
        }


        public int LayTheoPhongBan(string toChucId, string phongBanId)
        {
            var query = this.Query.Where(x => x.to_chuc_id == toChucId && x.phong_ban_id == phongBanId
                                         );
            return query.Count();
        }


        public int Count(string toChucId)
        {
            return Query.Count(c => c.to_chuc_id == toChucId && c.phong_ban_id != null);
        }

    }
}
