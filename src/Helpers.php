<?php

use JYmusic\Utils\Util;
use JYmusic\Utils\Active;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

if (!function_exists('active_class')) {
    /**
     * Get the active class if the condition is not falsy
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function active_class($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return app('active')->getClassIf($condition, $activeClass, $inactiveClass);
    }
}
if (!function_exists('if_uri')) {
    /**
     * Check if the URI of the current request matches one of the specific URIs
     *
     * @param array|string $uris
     *
     * @return bool
     */
    function if_uri($uris)
    {
        return app('active')->checkUri($uris);
    }
}
if (!function_exists('if_uri_pattern')) {
    /**
     * Check if the current URI matches one of specific patterns (using `str_is`)
     *
     * @param array|string $patterns
     *
     * @return bool
     */
    function if_uri_pattern($patterns)
    {
        return app('active')->checkUriPattern($patterns);
    }
}
if (!function_exists('if_query')) {
    /**
     * Check if one of the following condition is true:
     * + the value of $value is `false` and the current querystring contain the key $key
     * + the value of $value is not `false` and the current value of the $key key in the querystring equals to $value
     * + the value of $value is not `false` and the current value of the $key key in the querystring is an array that
     * contains the $value
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    function if_query($key, $value)
    {
        return app('active')->checkQuery($key, $value);
    }
}
if (!function_exists('if_route')) {
    /**
     * Check if the name of the current route matches one of specific values
     *
     * @param array|string $routeNames
     *
     * @return bool
     */
    function if_route($routeNames)
    {
        return app('active')->checkRoute($routeNames);
    }
}
if (!function_exists('if_route_pattern')) {
    /**
     * Check the current route name with one or some patterns
     *
     * @param array|string $patterns
     *
     * @return bool
     */
    function if_route_pattern($patterns)
    {
        return app('active')->checkRoutePattern($patterns);
    }
}
if (!function_exists('if_route_param')) {
    /**
     * Check if the parameter of the current route has the correct value
     *
     * @param $param
     * @param $value
     *
     * @return bool
     */
    function if_route_param($param, $value)
    {
        return app('active')->checkRouteParam($param, $value);
    }
}
if (!function_exists('if_action')) {
    /**
     * Return 'active' class if current route action match one of provided action names
     *
     * @param array|string $actions
     *
     * @return bool
     */
    function if_action($actions)
    {
        return app('active')->checkAction($actions);
    }
}
if (!function_exists('if_controller')) {
    /**
     * Check if the current controller class matches one of specific values
     *
     * @param array|string $controllers
     *
     * @return bool
     */
    function if_controller($controllers)
    {
        return app('active')->checkController($controllers);
    }
}
if (!function_exists('current_controller')) {
    /**
     * Get the current controller class
     *
     * @return string
     */
    function current_controller()
    {
        return app('active')->getController();
    }
}
if (!function_exists('current_method')) {
    /**
     * Get the current controller method
     *
     * @return string
     */
    function current_method()
    {
        return app('active')->getMethod();
    }
}
if (!function_exists('current_action')) {
    /**
     * Get the current action string
     *
     * @return string
     */
    function current_action()
    {
        return app('active')->getAction();
    }
}

if (!function_exists('text_filter')) {
    /**
     * 过滤标签，输出没有html的干净的文本
     *
     * @return string
     */
    function text_filter($str)
    {
        return Util::textFilter($str);
    }
}

if (!function_exists('rules_to_messages')) {
    /**
     * 验证规则转换对应语言提示
     *
     * @return string
     */
    function rules_messages($rules)
    {
        return Util::rulesToMessages($rules);
    }
}

if (!function_exists('number_chinese')) {
    /**
     * 数字转中文大写
     *
     * @return string
     */
    function number_chinese($number, $isRmb = false)
    {
        return Util::numberToChinese($number, $isRmb = false);
    }
}

if (!function_exists('str_part_hide')) {
    /**
     * 隐藏部分字符串
     *
     * @param string $str           
     * @param int    $start         开始位置
     * @param int    $length        隐藏字符长度 
     * @param string $replacement   要替换的字符串
     * @return string
     */
    function str_part_hide($str = '', $start = 1, $length = 3, $replacement = '*')
    {
        return Util::strPartHide($str, $start, $length, $replacement);
    }
}

if (!function_exists('str_highlight')) {
    /**
     * 高亮字符 根据指定字符截取前后字符
     *
     * @param string|array $strings
     * @param string       $content
     * @param int          $limit
     * @return string
     */
    function str_highlight($strings, $content, $limit = 0)
    {
        return Util::strHighlight($strings, $content, $limit);
    }
}

if (!function_exists('url_b64encode')) {
    /**
     * URL安全的字符串编码
     * 
     * @param  string  $string
     * @return string
     */
    function url_b64encode($string)
    {
        return Util::urlB64encode($string);
    }
}

if (!function_exists('url_b64decode')) {
    /**
     * URL安全的字符串解码：
     * 
     * @param  string  $string
     * @return string
     */
    function url_b64decode($string)
    {
        return Util::urlB64decode($string);
    }
}

if (!function_exists('jy_encrypt')) {
    /**
     * 系统加密方法
     * 
     * @param string   $data 要加密的字符串
     * @param int      $expire 过期时间 单位 秒
     * @param string   $authKey 加密盐
     * @return string
     */
    function jy_encrypt($data, $expire = 0, $authKey = null)
    {
        return Util::jyEncrypt($data, $expire, $authKey);
    }
}

if (!function_exists('jy_decrypt')) {
    /**
     * 系统解密方法
     * 
     * @param  string  $data 要解密的字符串 （必须是jyEncrypt方法加密的字符串）
     * @param  string  $authKey 加密盐
     * @return string
     */
    function jy_decrypt($string)
    {
        return Util::jyDecrypt($string);
    }
}
