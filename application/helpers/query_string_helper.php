<?php

/**
 * 返回当前 query string.
 *
 * @return string
 */
function query_string()
{
    return $_SERVER['QUERY_STRING'];
}

/**
 * 把当前 QUERY_STRING分解成数组
 *
 * @return array
 */
function query_string_to_array()
{
    $params = array();
    $query_string = explode('&', query_string());
    foreach ($query_string as $string){
        if (strpos($string, '=')){
            list($key, $value) = explode('=', $string);
            $params[$key] = $value;
        }
    }
    return $params;
}

/**
 * 信息提示方式：2
 * 带自动跳转
 *
 * @param string $message
 * @param string $goto
 */
function show_message($message, $goto)
{
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    $CI = get_instance();
    $data['goto']    = (string)$goto;
    $data['message'] = (string)$message;
    $CI->load->view('public/message', $data);
}

?>