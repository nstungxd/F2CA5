using System;
using System.Collections.Generic;
using System.Data;
using System.Globalization;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Threading;

namespace CRUD.Utils
{
    public static class DataTableExtensions
    {
        public delegate void ConvertCallback<T>(T item);
        public static IList<T> ToList<T>(this DataTable table, ConvertCallback<T> convertCallback = null) where T : new()
        {
            IList<PropertyInfo> properties = typeof(T).GetProperties().ToList();
            IList<T> result = new List<T>();

            foreach (var row in table.Rows)
            {
                var item = CreateItemFromRow<T>((DataRow)row, properties);
                result.Add(item);
                if (convertCallback != null)
                {
                    convertCallback(item);
                }
            }

            return result;
        }

        public static IList<T> ToList<T>(this DataTable table, Dictionary<string, string> mappings) where T : new()
        {
            IList<PropertyInfo> properties = typeof(T).GetProperties().ToList();
            IList<T> result = new List<T>();

            foreach (var row in table.Rows)
            {
                var item = CreateItemFromRow<T>((DataRow)row, properties, mappings);
                result.Add(item);
            }

            return result;
        }

        public static IList<T> ToList<T>(this DataTable table, Dictionary<string, string> mappings, ConvertCallback<T> convertCallback) where T : new()
        {
            IList<PropertyInfo> properties = typeof(T).GetProperties().ToList();
            IList<T> result = new List<T>();

            foreach (var row in table.Rows)
            {
                var item = CreateItemFromRow<T>((DataRow)row, properties, mappings);
                result.Add(item);
                if (convertCallback != null)
                {
                    convertCallback(item);
                }
            }

            return result;
        }

        public static T CreateItemFromRow<T>(this DataRow row, ConvertCallback<T> convertCallback = null) where T : new()
        {
            IList<PropertyInfo> properties = typeof(T).GetProperties().ToList();
            T item = new T();
            foreach (var property in properties)
            {
                if (row.Table.Columns[property.Name] == null)
                    continue;
                property.SetValue(item, row[property.Name], null);
            }

            if (convertCallback != null)
            {
                convertCallback(item);
            }
            return item;
        }
        public static T CreateItemFromRow<T>(this DataRow row, Dictionary<string, string> mappings, ConvertCallback<T> convertCallback = null) where T : new()
        {
            IList<PropertyInfo> properties = typeof(T).GetProperties().ToList();
            T item = new T();
            foreach (var property in properties)
            {
                try
                {
                    if (mappings.ContainsKey(property.Name) && row.Table.Columns.Contains(mappings[property.Name]))
                    {
                        var stringVal = (row[mappings[property.Name]] != null && row[mappings[property.Name]] != DBNull.Value) ? row[mappings[property.Name]].ToString() : "";
                        object correctVal = stringVal;
                        if (property.PropertyType != typeof(string) && property.PropertyType != typeof(String))
                        {
                            try
                            {
                                var correctType = Nullable.GetUnderlyingType(property.PropertyType);
                                if (correctType != null)
                                {
                                    // It's nullable
                                    correctVal = Convert.ChangeType(stringVal, correctType, Thread.CurrentThread.CurrentCulture);
                                }
                                else
                                {
                                    correctVal = Convert.ChangeType(stringVal, property.PropertyType, Thread.CurrentThread.CurrentCulture);
                                }
                            }
                            catch (Exception ex)
                            {
                                continue;
                            }

                        }
                        property.SetValue(item, correctVal, null);
                    }
                }
                catch (Exception ex)
                {
                    throw new Exception("loi o thuoc tinh: " + property.Name, ex);
                }

            }

            if (convertCallback != null)
            {
                convertCallback(item);
            }
            return item;
        }
        private static T CreateItemFromRow<T>(DataRow row, IList<PropertyInfo> properties) where T : new()
        {
            T item = new T();
            foreach (var property in properties)
            {
                if (row.Table.Columns[property.Name] == null)
                    continue;
                var stringVal = (row[property.Name] != null && row[property.Name] != DBNull.Value) ? row[property.Name].ToString() : "";
                object correctVal = stringVal;
                if (property.PropertyType != typeof(string) && property.PropertyType != typeof(String))
                {
                    try
                    {
                        var correctType = Nullable.GetUnderlyingType(property.PropertyType);
                        if (correctType != null)
                        {
                            // It's nullable
                            correctVal = Convert.ChangeType(stringVal, correctType, Thread.CurrentThread.CurrentCulture);
                        }
                        else
                        {
                            correctVal = Convert.ChangeType(stringVal, property.PropertyType, Thread.CurrentThread.CurrentCulture);
                        }
                    }
                    catch (Exception ex)
                    {
                        continue;
                    }

                }
                property.SetValue(item, correctVal, null);
            }
            return item;
        }
        private static T CreateItemFromRow<T>(DataRow row, IList<PropertyInfo> properties, Dictionary<string, string> mappings) where T : new()
        {
            T item = new T();
            foreach (var property in properties)
            {
                if (mappings.ContainsKey(property.Name))
                {
                    var stringVal = (row[mappings[property.Name]] != null && row[mappings[property.Name]] != DBNull.Value) ? row[mappings[property.Name]].ToString() : "";
                    object correctVal = stringVal;
                    if (property.PropertyType != typeof(string) && property.PropertyType != typeof(String))
                    {
                        try
                        {
                            var correctType = Nullable.GetUnderlyingType(property.PropertyType);
                            if (correctType != null)
                            {
                                // It's nullable
                                correctVal = Convert.ChangeType(stringVal, correctType, Thread.CurrentThread.CurrentCulture);
                            }
                            else
                            {
                                correctVal = Convert.ChangeType(stringVal, property.PropertyType, Thread.CurrentThread.CurrentCulture);
                            }
                        }
                        catch (Exception ex)
                        {
                            continue;
                        }

                    }
                    property.SetValue(item, correctVal, null);
                }
            }
            return item;
        }

        public static void SetValue(object inputObject, string propertyName, object propertyVal, CultureInfo culture = null)
        {
            //find out the type
            Type type = inputObject.GetType();

            //get the property information based on the type
            System.Reflection.PropertyInfo propertyInfo = type.GetProperty(propertyName);

            //find the property type
            Type propertyType = propertyInfo.PropertyType;

            //Convert.ChangeType does not handle conversion to nullable types
            //if the property type is nullable, we need to get the underlying type of the property
            var targetType = IsNullableType(propertyInfo.PropertyType) ? Nullable.GetUnderlyingType(propertyInfo.PropertyType) : propertyInfo.PropertyType;

            //Returns an System.Object with the specified System.Type and whose value is
            //equivalent to the specified object.
            if (culture != null)
                propertyVal = Convert.ChangeType(propertyVal, targetType, culture);
            else
                propertyVal = Convert.ChangeType(propertyVal, targetType);
            //Set the value of the property
            propertyInfo.SetValue(inputObject, propertyVal, null);

        }
        private static bool IsNullableType(Type type)
        {
            return type.IsGenericType && type.GetGenericTypeDefinition().Equals(typeof(Nullable<>));
        }

    }
}
