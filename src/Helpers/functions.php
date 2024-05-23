<?php

if (!function_exists('convert_memory')) {
    /**
     * 获取当前耗费内存
     * @param memory_get_usage(true | false)
     * @return string
     */
    function convert_memory($size) {
        $unit = ['b','kb','mb','gb','tb','pb'];
        echo @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
}

if (!function_exists('unique_id')) {
    /**
     * 通过session_id创建唯一标识
     */
    function unique_id() {
        return session_create_id();
    }
}

if (!function_exists('is_json')) {
    /**
     * 检测是否为josn
     * @param string $jsonStr
     * @return bool
     */
    function is_json($jsonStr) {
        json_decode($jsonStr);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
