<?php

class Database
{
    private static $instance = null;

    public static function getPdo(): PDO
    {

        if (self::$instance === null)
        {
            require('env.php');
            self::$instance = new PDO('mysql:host='.$host_bdd.';dbname='.$name_bdd.';charset=utf8', $user_bdd, $password_bdd, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }

        return self::$instance;
    }
}