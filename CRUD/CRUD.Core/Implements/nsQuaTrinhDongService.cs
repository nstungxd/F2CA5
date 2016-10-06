using CRUD.Core;
using CRUD.Core.Domain;
using FX.Data;
using NHibernate;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Policy;
using System.Text;


namespace CRUD.Core.Implements
{
    class nsQuaTrinhDongService : FX.Data.BaseService<nsQuaTrinhDong, string>, CRUD.Core.Interfaces.InsQuaTrinhDongService
    {
        public nsQuaTrinhDongService(string sessionFactoryConfigPath)
            : base(sessionFactoryConfigPath)
        { }

        public nsQuaTrinhDong InActive(string id, string toChucId, string taiKhoan)
        {
            var t = Getbykey(id);
            if (t != null)
            {
                // inactive phong ban
                t.amnd_officer = taiKhoan;
                t.amnd_date = DateTime.Now;
                t.amnd_state = amnd_state_type.I;
                t.amnd_type = amnd_type.Delete;
                Update(t);
                return t;
            }
            return null;
        }

        public List<nsQuaTrinhDong> LayQuaTrinhDong(string nhan_su_id, string toChucId, int pageIndex, int pageSize, out int total)
        {
            var query = this.Query.Where(x => x.nhan_su_id == nhan_su_id && x.amnd_state == amnd_state_type.A && x.to_chuc_id == toChucId);       
            total = query != null ? query.Count() : 0;
            if (total == 0)
                return new List<nsQuaTrinhDong>();
            else
                return query.OrderByDescending(e => e.ngay_bat_dau).Skip((pageIndex - 1) * pageSize).Take(pageSize).ToList();
        }

        public nsQuaTrinhDong LayQuaTrinhDong(string id, string nhan_su_id, string toChucId)
        {
            return this.Query.Where(x => x.ID == Convert.ToInt32(id) && x.nhan_su_id == nhan_su_id && x.amnd_state == amnd_state_type.A && x.to_chuc_id == toChucId).FirstOrDefault();
        }

        public void Delete_ByNhanSuId(string nhanSuId)
        {
            var query = Query.Where(c => c.nhan_su_id == nhanSuId);
            foreach (var qt in query)
            {
                this.Delete(qt);
            }
        }

    }
}
