<?php

if (!function_exists('createRandomPassword')) {

  /**
   * Summary of createRandomPassword
   * @param mixed $lenght
   * @return string
   */
  function createRandomPassword($lenght = 10)
  {

    $alphabet    = "abcdefghijkmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass        = [];
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $lenght; $i++) {
      $n      = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }

    return implode($pass);
  }

  if (!function_exists('get_gravatar')) {

    function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array())
    {
      $url = 'https://www.gravatar.com/avatar/';
      $url .= md5(strtolower(trim($email)));
      $url .= "?s=$s&d=$d&r=$r";
      if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
          $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
      }
      return $url;
    }
  }

}

/**
 * check the array key and return the value 
 * 
 * @param array $array
 * @return extract array value safely
 */
if (!function_exists('get_array_value')) {

  function get_array_value($array, $key) {
      if (is_array($array) && array_key_exists($key, $array)) {
          return $array[$key];
      }
  }

}

function slug($string)
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}