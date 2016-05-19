using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace CRUD.Models
{
    public class ResultModel
    {
        public string message { get; set; }
        public int success { get; set; }
        public object data { get; set; }
    }
}