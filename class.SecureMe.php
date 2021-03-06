<?php
/**
 * SecurePage by Jstar (xgproyect.net)
 * This class implement a security controll against SQL-injection and xss
 * 
 * --Usage-- 
 * in the main page of your application:
 * require('class.SecureMe.php');
 * SecureMe::run(); 
 * 
 * */

class SecureMe
{
   private static $instance = null;

   public function __construct()
   {    
      //apply controller to all
      $_GET = array_map(array($this,'validate'),$_GET);
      $_POST = array_map(array($this,'validate'),$_POST);
      $_REQUEST = array_map(array($this,'validate'),$_REQUEST);
      $_SERVER = array_map(array($this,'validate'),$_SERVER);
      $_COOKIE = array_map(array($this,'validate'),$_COOKIE);
   }
   //recursively function
   private function validate($value)
   {    
      if(!is_array($value))
      {
         $value = str_ireplace("script","blocked",$value);
         $value = (get_magic_quotes_gpc()) ? htmlentities(stripslashes($value), ENT_QUOTES, 'UTF-8',false) : htmlentities($value, ENT_QUOTES, 'UTF-8',false);
         $value = mysql_real_escape_string($value);
      }
      else
      {
         $c = 0;
         foreach($value as $val)
         {
            $value[$c] = $this->validate($val);
            $c++;
         }
      }
      return $value;
   }
   //singleton pattern
   public static function run()
   {
      if(self::$instance == null)
      {
         $c = __CLASS__;
         self::$instance = new $c();
      }
   
   }
} 
 ?>