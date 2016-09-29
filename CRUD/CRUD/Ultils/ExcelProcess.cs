using CRUD.Models.Excel;
using NPOI.SS.UserModel;
using System;
using System.Collections.Generic;
using System.Data;
using System.IO;

namespace CRUD.Utils
{
    public class ReadExcelEventArgs : EventArgs
    {
        public int Percent
        {
            get { return (RowIndex / MaxRow) * 100; }
        }

        public string Message { get; set; }
        public int ValueLoading { get; set; }
        public const int MaxProsess = 100;
        public int MaxRow { get; set; }
        public int RowIndex { get; set; }
        public void TinhToan(int maxRow)
        {

        }
    }

    public delegate object ParseValue(string value);

    public class ExcelProcess
    {
        public event Action<object, ReadExcelEventArgs> Reading = null;

        public string FileName { get; set; }
        // linhpn add
        public bool IsTCVN3 = false;

        public ExcelProcess()
        {           
        }

        public ExcelProcess(string fileName)
        {
            FileName = fileName;
        }

        #region

        /// <summary>
        /// read excel to datatable
        /// </summary>
        /// <param name="filePath"></param>
        /// <param name="startRowIndexHeader">Số dòng bắt đầu lấy dữ liệu (bắt đầu từ 0)</param>
        /// <returns></returns>
        public DataTable ExcelToDataTable(string filePath, int startRowIndexHeader = 0, bool tcvnToUnicode = false)
        {
            DataTable dt = new DataTable();
            IWorkbook workbook = null;
            using (FileStream file = new FileStream(filePath, FileMode.Open, FileAccess.Read))
            {
                workbook = WorkbookFactory.Create(file);
            }

            ISheet sheet = workbook.GetSheetAt(0);
            System.Collections.IEnumerator rows = sheet.GetRowEnumerator();

            var lastRowNum = sheet.LastRowNum;

            IRow headerRow = sheet.GetRow(startRowIndexHeader);
            int cellCount = headerRow.LastCellNum;

            if (Reading != null)
                Reading(this, new ReadExcelEventArgs
                {
                    Message = "Đang đọc file EXCEL dòng thứ [" + startRowIndexHeader + "/" + lastRowNum + "]",
                    MaxRow = lastRowNum,
                    RowIndex = startRowIndexHeader
                });
            for (int j = 0; j < cellCount; j++)
            {
                try
                {
                    ICell cell = headerRow.GetCell(j);
                    dt.Columns.Add(cell.ToString(), typeof(string));
                }
                catch (Exception ex)
                {
                    throw new Exception(string.Format("Lỗi ở dòng thứ {0} cột thứ {1}", startRowIndexHeader, (CellExcel)j), ex);
                }
            }

            int indexRowFirt = 0;

            if (sheet.FirstRowNum == startRowIndexHeader)
            {
                indexRowFirt = startRowIndexHeader + 1;
            }
            else
            {
                indexRowFirt = (sheet.FirstRowNum + 1 + startRowIndexHeader);
            }
            for (int i = indexRowFirt; i <= lastRowNum; i++)
            {
                if (Reading != null)
                    Reading(this, new ReadExcelEventArgs
                    {
                        Message = "Đang đọc file EXCEL dòng thứ [" + i + "/" + lastRowNum + "]",
                        MaxRow = lastRowNum,
                        RowIndex = i,
                    });
                IRow row = sheet.GetRow(i);
                DataRow dataRow = dt.NewRow();
                if (row == null)
                {
                    break;
                }
                for (int j = row.FirstCellNum; j < cellCount; j++)
                {
                    try
                    {
                        if (row.GetCell(j) != null)
                        {
                            var value = row.GetCell(j).ToString().Trim();
                            if (tcvnToUnicode)
                            {
                                value = UnicodeConverter.TCVN3ToUnicode(value);
                            }
                            dataRow[j] = value;
                        }
                    }
                    catch (Exception ex)
                    {
                        throw new Exception(string.Format("Lỗi ở dòng thứ {0} cột thứ {1}", indexRowFirt, (CellExcel)j), ex);
                    }

                }
                dt.Rows.Add(dataRow);
            }
            return dt;
        }

        public static int CheckExcelColumn(string filePath, Dictionary<string, bool> columnToCheckExist)
        {
            DataTable dt = new DataTable();
            IWorkbook workbook = null;
            using (FileStream file = new FileStream(filePath, FileMode.Open, FileAccess.Read))
            {
                workbook = WorkbookFactory.Create(file);
            }
            ISheet sheet = workbook.GetSheetAt(0);
            IRow headerRow = sheet.GetRow(0);
            var columnCount = headerRow.LastCellNum;

            for (int j = 0; j < columnCount; j++)
            {
                ICell cell = headerRow.GetCell(j);
                if (cell != null && columnToCheckExist.ContainsKey(cell.ToString()))
                {
                    columnToCheckExist[cell.ToString()] = true;
                }

            }

            return columnCount;
        }
        #endregion

    }
}
