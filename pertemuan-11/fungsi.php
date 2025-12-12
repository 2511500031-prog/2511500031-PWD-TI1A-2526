<?php
function redirect_ke($url)
{
  header("location: " . $url);
  exit();
}