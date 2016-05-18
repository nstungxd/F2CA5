using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Web;

namespace CRUD.Models
{
    public class BaseModel
    {
        public string ConnectString { get { return ConfigurationManager.AppSettings["Connect"]; } } 
    }
}