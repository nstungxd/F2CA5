using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRUD.Core.CacheLayer
{
    public class CacheProvider
    {
        private static Dictionary<string, object> DataCache = new Dictionary<string, object>();
        private static object LockObject = new object();
        public static void AddCacheItem(string rawKey, object value)
        {
            lock (LockObject)
            {
                // Make sure rawKey is in the cache - if not, add it
                if (!DataCache.ContainsKey(rawKey))
                    DataCache.Add(rawKey, null);
                DataCache[rawKey] = value;
            }
        }

        public static object GetCacheItem(string rawKey)
        {
            if (!DataCache.ContainsKey(rawKey))
                DataCache.Add(rawKey, null);
            return DataCache[rawKey];
        }

        public static void ClearCache()
        {
            lock (LockObject)
            {
                DataCache.Clear();
            }
        }

    }
}
