using CRUD.Core.Domain;
using NHibernate;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace CRUD.Core.Interfaces
{
    public interface InsQuaTrinhDongService : FX.Data.IBaseService<nsQuaTrinhDong, string>
    {
        List<nsQuaTrinhDong> LayQuaTrinhDong(string nhan_su_id, string toChucId, int pageIndex, int pageSize, out int total);

        nsQuaTrinhDong LayQuaTrinhDong(string id, string nhan_su_id, string toChucId);

        /// <summary>
        /// inactive du lieu theo id
        /// </summary>
        /// <param name="id"></param>
        /// <returns></returns>
        nsQuaTrinhDong InActive(string id, string toChucId, string taiKhoan);

        /// <summary>
        /// xoa du lieu theo id
        /// </summary>
        /// <param name="id"></param>
        /// <returns></returns>
        void Delete_ByNhanSuId(string nhan_su_id);
    }
}
