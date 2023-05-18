<?php
define('BASE_URL', '/pw2023_223040018/kuliah/pertemuan11/');

function dd($value)
{
  echo "<pre>";
  var_dump($value);
  die;
  echo "</pre>";
}

function uriIS($uri)
{
  return ($_SERVER["REQUEST_URI"] == $uri) ? 'active' : '';
}
