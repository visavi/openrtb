<?php

namespace OpenRtb\Tools\Traits;


trait Cache
{
    /**
     * @param string $key
     * @return bool
     */
    protected static function cacheHas($key)
    {
        if (self::apcuExists()) {
            return apcu_exists($key);
        }
        return false;
    }

    /**
     * @return bool
     */
    protected static function apcuExists()
    {
        return extension_loaded("apcu");
    }

    /**
     * @param string $key
     * @param mixed $item
     * @return bool
     */
    protected static function cacheStore($key, $item)
    {
        if (self::apcuExists()) {
            return apcu_store($key, $item);
        }
        return false;
    }
}
