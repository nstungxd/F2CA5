using AutoMapper;
using CRUD.Core.Domain;
using CRUD.Core.Interfaces;
using FX.Core;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace CRUD.Models
{
    public class NhanSuListViewModel
    {
        public const int _DefaultPageSize = 15;
        public string phongBanId { get; set; }
        public string keyword { get; set; }
        public int pageIndex { get; set; }
        public int pageSize { get; set; }
        public int total { get; set; }
        public IEnumerable<NhanSuModel> Items { get; set; }

        public static NhanSuListViewModel LayDuLieuTheoTrangThai(string tt, string keyword, int pageIndex, int pageSize = _DefaultPageSize)
        {
            NhanSuListViewModel viewModel = new NhanSuListViewModel();
            //viewModel.phongBanId = phongBanId;
            viewModel.keyword = keyword;
            viewModel.pageIndex = pageIndex;
            viewModel.pageSize = pageSize;

            if (keyword == null)
                keyword = "";
            else
                keyword = keyword.Trim();
            var serviceInfo = IoC.Resolve<InsNhanSuService>();
            int total = 0;
            var items = serviceInfo.LayDanhSachTheoTrangThaiNghi(string.Empty, tt, keyword, pageIndex, pageSize, out total);

            NhanSuModel.CreateMapping();
            viewModel.Items = (IEnumerable<NhanSuModel>)Mapper.Map<List<nsNhanSu>, List<NhanSuModel>>(items);
            viewModel.total = total;

            return viewModel;
        }
    }
}