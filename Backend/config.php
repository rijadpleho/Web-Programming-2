<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config
{
    public static function DB_NAME()
    {
        return 'icehawks_shop';
    }

    public static function DB_PORT()
    {
        return 3306;
    }

    public static function DB_USER()
    {
        return 'root';
    }

    public static function DB_PASSWORD()
    {
        return '';
    }

    public static function DB_HOST()
    {
        return '127.0.0.1';
    }


    public static function JWT_SECRET()
    {
        return 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWUsImlhdCI6MTUxNjIzOTAyMn0.KMUFsIDTnFmyG3nMiGM6H9FNFUROf3wh7SmqJp-QV30';
    }
}
?>