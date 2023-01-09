<?php
/**
* Plugin Name: OneMessage
* Plugin URI: https://www.OneMessage.chat/
* Description: First Test.
* Version: 1.0
* Author: OneMessage
* Author URI: https://www.OneMessage.chat/
* Licence: GPLv2 or later
**/



/*
{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {URI to Plugin License}.
*/
require 'vendor/autoload.php';
require 'vendor/pear/http_request2/HTTP/Request2.php';



if(! defined('ABSPATH')){
    die;
}

define('plugin_basename',plugin_basename( __FILE__ ));

if(class_exists('inc\\Init')){
    session_start();
    inc\Init::register_services();
}