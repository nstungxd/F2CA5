using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Web.Script.Serialization;
using System.Data;
using AutoMapper;
using System.Reflection;
using System.Collections;
using System.IO;
using System.Web;
using Newtonsoft.Json;

namespace CRUD.Utils
{
    public class MappingUtil
    {
        /// <summary>
        /// Lấy dữ liệu từ json
        /// </summary>
        /// <typeparam name="T">Một đối tượng hoặc một list đối tượng</typeparam>
        /// <param name="pathJson">đường dẫn file Json</param>
        /// <returns></returns>
        public static T GetObjectJson<T>(string pathJson)
        {
            if (!File.Exists(pathJson))
            {
                throw new Exception("File không tồn tại " + pathJson);
                //return default(T);
            }
            var jsonData = System.IO.File.ReadAllText(pathJson);
            JavaScriptSerializer js = new JavaScriptSerializer();
            T dic = js.Deserialize<T>(jsonData);
            return dic;
        }
        public static Dictionary<string, MappingItem> GetMappingFromFile(string filePath)
        {
            var jsonData = System.IO.File.ReadAllText(filePath);
            JavaScriptSerializer js = new JavaScriptSerializer();
            var dic = js.Deserialize<List<MappingItem>>(jsonData).ToDictionary(x => x.source);
            return dic;
        }

        public static void WriteObject<T>(List<T> lstT, string duongDan)
        {
            string path = Path.GetDirectoryName(duongDan);
            if (path != null && !Directory.Exists(path))
            {
                Directory.CreateDirectory(path);
            }
            if (File.Exists(duongDan))
                File.Create(duongDan);
            JavaScriptSerializer writer = new JavaScriptSerializer();
            string s = writer.Serialize(lstT);
            System.IO.File.WriteAllText(duongDan, s);
        }

        /// <summary>
        /// <param>Lấy cột excel mặc định từ file json</param>
        /// <para>TuPV</para>
        /// </summary>
        /// <param name="nameFile">Tên file json trong thư mục Resources</param>
        /// <returns></returns>
        public static List<MappingItem> getColumnsFromJSON(string filePath)
        {
            try
            {
                using (StreamReader r = new StreamReader(filePath))
                {
                    string json = r.ReadToEnd();
                    List<MappingItem> items = JsonConvert.DeserializeObject<List<MappingItem>>(json);
                    return items;
                }
            }
            catch
            { }
            return null;
        }

        public static Object ConvertValue(Type typeInString, object value)
        {
            var underlyingType = Nullable.GetUnderlyingType(typeInString);
            try
            {
                object instance = Convert.ChangeType(value, underlyingType ?? typeInString);
                return instance;
            }
            catch
            {
                return null;
            }
        }
    }

    public class MappingItem
    {
        public string source { get; set; }
        public string destination { get; set; }
        public string dataType { get; set; }
        public string title { get; set; }
        public bool required { get; set; }
    }



    public class IntNullableResolver : ValueResolver<object, int?>
    {
        protected override int? ResolveCore(object source)
        {
            if (source == null || source == DBNull.Value)
            {
                return default(int?);
            }
            else
            {
                int a = 0;
                if (int.TryParse(source.ToString(), out a))
                    return a;
                else
                {
                    return default(int?);
                }
            }
        }
    }
    public static class MappingExpressionExtensions
    {
        public static IMappingExpression<TSource, TDest> IgnoreAllUnmapped<TSource, TDest>(this IMappingExpression<TSource, TDest> expression)
        {
            expression.ForAllMembers(opt => opt.Ignore());
            return expression;
        }

        public static IMappingExpression<TSource, TDestination> IgnoreAllNonExisting<TSource, TDestination>(this IMappingExpression<TSource, TDestination> expression)
        {
            var sourceType = typeof(TSource); var destinationType = typeof(TDestination);
            var existingMaps = Mapper.GetAllTypeMaps().First(x => x.SourceType.Equals(sourceType) && x.DestinationType.Equals(destinationType));
            foreach (var property in existingMaps.GetUnmappedPropertyNames())
            {
                expression.ForMember(property, opt => opt.Ignore());
            }
            return expression;
        }


        //public static IMappingExpression<TSource, TDestination> IgnoreAllNonExisting<TSource, TDestination>(this IMappingExpression<TSource, TDestination> expression)
        //{
        //    var flags = BindingFlags.Public | BindingFlags.Instance;
        //    var sourceType = typeof(TSource);
        //    var destinationProperties = typeof(TDestination).GetProperties(flags);

        //    foreach (var property in destinationProperties)
        //    {
        //        if (sourceType.GetProperty(property.Name, flags) == null)
        //        {
        //            expression.ForMember(property.Name, opt => opt.Ignore());
        //        }
        //    }
        //    return expression;
        //}
    }


}
