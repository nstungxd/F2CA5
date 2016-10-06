using FX.Utils.MVCMessage;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace CRUD.Controllers
{
    [MessagesFilter]
    public class BaseController : Controller
    {
        protected MessageViewData Messages
        {
            get
            {
                if (!ViewData.ContainsKey("Messages"))
                {
                    throw new InvalidOperationException("Bạn cần phải thêm thuộc tính [MessageFilter] cho Controller class muốn sử dụng thông báo!");
                }
                return (MessageViewData)ViewData["Messages"];
            }
        }
        
    }
}