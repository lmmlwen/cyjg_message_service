<?php

if (!function_exists('convertMemory')) {
    /**
     * 获取当前耗费内存
     * @param memory_get_usage(true | false)
     * @return string
     */
    function convertMemory($size) {
        $unit = ['b','kb','mb','gb','tb','pb'];
        echo @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
}

if (!function_exists('get_total_millisecond')) {
    /**
     * 返回字符串的毫秒数时间戳
     * @return string
     */
    function get_total_millisecond()
    {
        $time = explode(' ', microtime ());
        $time = $time[1] . ($time[0] * 1000);
        $time2 = explode('.', $time);
        $time = $time2[0];
        return $time;
    }
}

if (!function_exists('langParse')) {
    /**
     * 判断浏览器语言
     * @param $lang string | 无参数则通过浏览器判断
     * @return array
     */
    function langParse($lang = '') {
        if (!isset($lang)) {
            $browserlangs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
            $lang = array_shift($browserlangs);
        }
        if (preg_match('/^cn/i', $lang)) {
            $lang_arr = ['language' => 'zh', 'i18n' => 'zh_CN'];
        } else if (preg_match('/^hk/i', $lang)) {
            $lang_arr = ['language' => 'zh', 'i18n' => 'zh_HK'];
        } else if (preg_match('/^zh/i', $lang)) {
            $lang_arr = ['language' => 'zh', 'i18n' => 'zh_CN'];
        } else if (preg_match('/^en/i', $lang)) {
            $lang_arr = ['language' => 'en', 'i18n' => 'en_US'];
        } else if (preg_match('/^ja/i', $lang)) {
            $lang_arr = ['language' => 'ja', 'i18n' => 'ja'];
        } else if (preg_match('/^ko/i', $lang)) {
            $lang_arr = ['language' => 'ko', 'i18n' => 'ko'];
        } else if (preg_match('/^fr/i', $lang)) {
            $lang_arr = ['language' => 'fr', 'i18n' => 'fr'];
        } else if (preg_match('/^de/i', $lang)) {
            $lang_arr = ['language' => 'de', 'i18n' => 'de'];
        } else if (preg_match('/^es/i', $lang)) {
            $lang_arr = ['language' => 'es', 'i18n' => 'es'];
        } else {
            $lang_arr = ['language' => 'zh', 'i18n' => 'zh_CN'];
        }
        return $lang_arr;
    }
}

if (!function_exists('fileType')) {
    /**
     * 获取文件类型
     */
    function fileType($file) {
        $map = [
            'docx' => 'DOCUMENT',
            'doc' => 'DOCUMENT',
            'xlsx' => 'DOCUMENT',
            'xls' => 'DOCUMENT',
            'jpg' => 'IMG',
            'jpeg' => 'IMG',
            'gif' => 'IMG',
            'png' => 'IMG',
            'svg' => 'IMG',
            'bmp' => 'IMG',
            'pdf' => 'ADOBE',
            'psd' => 'ADOBE',
            'rar' => 'ARCHIVES',
            'zip' => 'ARCHIVES',
        ];
        $ext = strtolower(pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION));
        return array_key_exists($ext, $map) ? $map[$ext] : 'UNABLE';
    }
}