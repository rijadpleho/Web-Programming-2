<?php


$isRailway = getenv('RAILWAY_ENVIRONMENT') !== false;


if ($isRailway) {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));
}

class Config {

   
    public static function DB_NAME() {
       
        return getenv('MYSQLDATABASE') ?: 'icehawks_shop';
    }

    public static function DB_PORT() {
        return getenv('MYSQLPORT') ?: '3306';
    }

    public static function DB_USER() {
        return getenv('MYSQLUSER') ?: 'root';
    }

    public static function DB_PASSWORD() {
        return getenv('MYSQLPASSWORD') ?: '';
    }

    public static function DB_HOST() {
        return getenv('MYSQLHOST') ?: '127.0.0.1';
    }

  
    public static function JWT_SECRET() {
        return getenv('JWT_SECRET') ?: 'ICEHAWKS_DEV_SECRET';
    }
}
