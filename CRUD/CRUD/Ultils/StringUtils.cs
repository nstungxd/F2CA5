using ConvertDB;
using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;

namespace CRUD.Utils
{

    /// <summary>
    /// linhpn: util to convert utf-8
    /// </summary>
    public class UnicodeConverter
    {
        public static string TCVN3ToUnicode(string value)
        {
            if (string.IsNullOrEmpty(value))
                return value;
            ConvertFont convert = new ConvertFont();
            FontIndex manguon = FontIndex.iTCV;
            FontIndex madich = FontIndex.iUNI;
            var stringValue = value;
            var success = convert.Convert(ref stringValue, manguon, madich);
            return stringValue;
        }

        public static string UnicodeToTCVN(string value)
        {
            if (string.IsNullOrEmpty(value))
                return value;
            ConvertFont convert = new ConvertFont();
            FontIndex manguon = FontIndex.iUNI;
            FontIndex madich = FontIndex.iTCV;
            var stringValue = value;
            var success = convert.Convert(ref stringValue, manguon, madich);
            return stringValue;
        }

        public static string EncodeToUTF8(string source)
        {
            // copy the string as UTF-8 bytes.
            byte[] utf8Bytes = new byte[source.Length];
            for (int i = 0; i < source.Length; ++i)
            {
                //Debug.Assert( 0 <= utf8String[i] && utf8String[i] <= 255, "the char must be in byte's range");
                utf8Bytes[i] = (byte)source[i];
            }

            return Encoding.UTF8.GetString(utf8Bytes, 0, utf8Bytes.Length);
        }
    }


    public static class StringUtil
    {
        public static string MultiSpaceToOneSpace(string source)
        {
            RegexOptions options = RegexOptions.None;
            Regex regex = new Regex(@"[ ]{2,}", options);
            return regex.Replace(source, @" ");
        }

        public static string UnsignString(string source, string replaceSpace = " ")
        {
            if (string.IsNullOrEmpty(source))
                return source;

            Regex regex = new Regex("\\p{IsCombiningDiacriticalMarks}+");
            string temp = source.Normalize(NormalizationForm.FormD);
            temp = regex.Replace(temp, String.Empty)
                        .ToLower()
                        .Replace(" ", replaceSpace)
                        .Replace('\u0111', 'd');
            return Regex.Replace(temp, "[^a-zA-Z0-9_.-]+", "", RegexOptions.Compiled);
        }
    }    

}
