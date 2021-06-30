<?php 
ob_start();
include "Controller/Core/Front.php";

 class Ccc  
 {
    public static function init()
    {
        Controller_Core_Front::init();
    }

    public static function loadFile($file)
    {
        require_once getcwd()."/".$file;

    }

    public static function objectManager($className)
    {
        self::loadFileByClassName($className);
        $object = new $className();
        return $object;
    }
    public static function loadFileByClassName($className)
    {
        $file = str_replace("_","/",$className);
        require_once getcwd()."/".$file.".php";
    }
 }
 
 Ccc::init();
ob_flush();