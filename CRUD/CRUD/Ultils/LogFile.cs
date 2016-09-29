using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;
using System.Diagnostics;

namespace CRUD.Utils
{
    public enum LogFileType
    {
        TRACE = 0,
        MESSAGE = 1,
        EXCEPTION = 2,
        PROCESS = 3,
        KYSO = 4,
    }

    public static class LogFile
    {
        public static string ShowException(this Exception ex, bool showMessageException = false, string strMessage = "")
        {
            try
            {
                //Write to file
                LogFile.LogExceptionToFile(ex);

                string logMessage = ex.Message;
                #if DEBUG
                logMessage = string.Concat(new object[] { ex.Message, Environment.NewLine, 
                                                        ex.Source, Environment.NewLine, 
                                                        ex.StackTrace , Environment.NewLine+"   \t\t",
                                                        ex.TargetSite,   Environment.NewLine+"   \t\t", 
                                                        ex.InnerException });
                #endif
                return logMessage;
            }
            catch (Exception exception)
            {
                return exception.Message;
            }

        }

        public static void Log(Exception ex)
        {
            //EventLog log = new EventLog
            //{
            //    Source = "BHXH/BizService"
            //};
            //log.WriteEntry(string.Concat(new object[] { ex.Message, Environment.NewLine, 
            //                                            ex.Source, Environment.NewLine, 
            //                                            ex.StackTrace, 
            //                                            ex.TargetSite, 
            //                                            ex.InnerException }), EventLogEntryType.Error, 100);
            //log.Close();
        }
        public static string LogExceptionToFile(this Exception ex)
        {
            string logDirectory = DateTime.Now.Year.ToString() + DateTime.Now.Month.ToString("00") + DateTime.Now.Day.ToString("00");

            
            //string logPath = Path.GetDirectoryName(Environment.GetCommandLineArgs()[0]);//@"C:\VNPT-BHXH";
            //string logDirectory = logPath + @"\" + DateTime.Today.ToString("yyyyMMdd");
            string filePath;
            if (!Directory.Exists(logDirectory))
            {
                Directory.CreateDirectory(logDirectory);
                filePath = logDirectory + @"\EXCEPTION.0.log";
            }
            else
            {
                string[] filePaths = Directory.GetFiles(logDirectory, "*.log");
                if (filePaths.Length == 0)
                {
                    filePath = logDirectory + @"\EXCEPTION.0.log";
                }
                else
                {
                    List<string> fileList = (from fPath in filePaths let file = new FileInfo(fPath) let parts = file.Name.Split('.') where parts[0].ToUpper() == LogFileType.EXCEPTION.ToString() select fPath).ToList();
                    int lastestIndex = int.MinValue;
                    string lastestFilePath = "";
                    if (fileList.Count <= 0)
                    {
                        filePath = logDirectory + @"\EXCEPTION.0.log";
                    }
                    else
                    {
                        foreach (string fPath in fileList)
                        {
                            FileInfo file = new FileInfo(fPath);
                            string[] parts = file.Name.Split('.'); //fPath.Split('.');
                            int i = 0;
                            if (int.TryParse(parts[1], out i) && i >= lastestIndex)
                            {
                                lastestIndex = Convert.ToInt32(parts[1]);
                                lastestFilePath = fPath;
                            }
                        }
                        filePath = lastestFilePath;
                    }

                    if (File.Exists(filePath))
                    {
                        FileInfo lastestFile = new FileInfo(filePath);
                        // check if file size be larger than 5MB then create new one
                        if (((lastestFile.Length / 1024f) / 1024f) > 5)
                        {
                            lastestIndex++;
                            filePath = logDirectory + @"\" + LogFileType.EXCEPTION + "." + lastestIndex + ".log";

                        }
                    }
                }
            }

            string logMessage = string.Concat(new object[] { ex.Message, Environment.NewLine, 
                                                        ex.Source, Environment.NewLine, 
                                                        ex.StackTrace , Environment.NewLine+"   \t\t",
                                                        ex.TargetSite,   Environment.NewLine+"   \t\t", 
                                                        ex.InnerException });
            logMessage = DateTime.Now.ToString("HH:mm:ss") + " " + logMessage;
            if (filePath.IsNull()) return "";
            TextWriterTraceListener listener = new TextWriterTraceListener(filePath);
            listener.WriteLine(logMessage);
            listener.Flush();
            listener.Close();
            return filePath;
        }

        public static void LogService(object[] retObj101)
        {
            //string s = "retObj trả về null ";
            //if (retObj101 != null && retObj101.ToList().Count > 0)
            //{
            //    s = "";
            //    foreach (var t in retObj101)
            //    {
            //        s += t.ToString();
            //    }
            //    LogFile.LogToFile(LogFileType.TRACE, s);
            //}
            //else
            //    LogFile.LogToFile(LogFileType.TRACE, s);
        }
        /// <summary>
        /// Không tìm thấy tập tin hoặc thư mục
        /// </summary>
        /// <param name="logMessage"></param>
        public static void LogPath(string logMessage)
        {
            LogFile.LogToFile(LogFileType.MESSAGE, "Không tìm thấy tập tin hoặc thư mục " + logMessage);
        }
        public static void LogToFile(LogFileType logType, string logMessage, string pathLog = "")
        {
            //string logPath = Path.GetDirectoryName(Environment.GetCommandLineArgs()[0]);//@"C:\VNPT-BHXH";
            //string logDirectory = "";
            //if (string.IsNullOrEmpty(pathLog))
            //    logDirectory = logPath + @"\" + DateTime.Today.ToString("yyyyMMdd");
            //else
            //{
            //    logDirectory = pathLog;
            //}
            //string filePath;
            //if (!Directory.Exists(logDirectory))
            //{
            //    Directory.CreateDirectory(logDirectory);
            //    switch (logType)
            //    {
            //        case LogFileType.TRACE:
            //            filePath = logDirectory + @"\TRACE.0.log";
            //            break;
            //        case LogFileType.MESSAGE:
            //            filePath = logDirectory + @"\MESSAGE.0.log";
            //            break;
            //        case LogFileType.EXCEPTION:
            //            filePath = logDirectory + @"\EXCEPTION.0.log";
            //            break;
            //        case LogFileType.PROCESS:
            //            filePath = logDirectory + @"\" + LogFileType.EXCEPTION.ToString() + ".log";
            //            break;
            //        default:
            //            filePath = logDirectory + @"\TRACE.0.log";
            //            break;
            //    }
            //}
            //else
            //{
            //    string[] filePaths = Directory.GetFiles(logDirectory, "*.log");
            //    if (filePaths.Length == 0)
            //    {
            //        switch (logType)
            //        {
            //            case LogFileType.TRACE:
            //                filePath = logDirectory + @"\TRACE.0.log";
            //                break;
            //            case LogFileType.MESSAGE:
            //                filePath = logDirectory + @"\MESSAGE.0.log";
            //                break;
            //            case LogFileType.EXCEPTION:
            //                filePath = logDirectory + @"\EXCEPTION.0.log";
            //                break;
            //            case LogFileType.PROCESS:
            //                filePath = logDirectory + @"\" + LogFileType.EXCEPTION.ToString() + ".log";
            //                break;
            //            default:
            //                filePath = logDirectory + @"\TRACE.0.log";
            //                break;
            //        }
            //    }
            //    else
            //    {
            //        List<string> fileList = (from fPath in filePaths let file = new FileInfo(fPath) let parts = file.Name.Split('.') where parts[0].ToUpper() == logType.ToString().ToUpper() select fPath).ToList();
            //        int lastestIndex = int.MinValue;
            //        string lastestFilePath = "";
            //        if (fileList.Count <= 0)
            //        {
            //            filePath = logDirectory + @"\" + logType.ToString().ToUpper() + ".0.log";
            //        }
            //        else
            //        {
            //            foreach (string fPath in fileList)
            //            {
            //                FileInfo file = new FileInfo(fPath);
            //                string[] parts = file.Name.Split('.'); //fPath.Split('.');
            //                if (Convert.ToInt32(parts[1]) < lastestIndex) continue;
            //                lastestIndex = Convert.ToInt32(parts[1]);
            //                lastestFilePath = fPath;
            //            }

            //            filePath = lastestFilePath;
            //        }

            //        if (File.Exists(filePath))
            //        {
            //            FileInfo lastestFile = new FileInfo(filePath);
            //            // check if file size be larger than 5MB then create new one
            //            if (((lastestFile.Length / 1024f) / 1024f) > 5)
            //            {
            //                lastestIndex++;
            //                filePath = logDirectory + @"\" + logType.ToString().ToUpper() + "." + lastestIndex + ".log";
            //            }
            //        }
            //    }
            //}

            //logMessage = DateTime.Now.ToString("HH:mm:ss") + " " + logMessage;
            //TextWriterTraceListener listener = new TextWriterTraceListener(filePath);
            //listener.WriteLine(logMessage);
            //listener.Flush();
            //listener.Close();
        }

        public static bool IsNull(this string input)
        {
            return string.IsNullOrEmpty(input);
        }
        public static bool IsNotNull(this string input)
        {
            return !string.IsNullOrEmpty(input);
        }
    }


}
