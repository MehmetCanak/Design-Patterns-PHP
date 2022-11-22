<?php

final class  Singleton
{
    private static ?Singleton $instance = null;

    public function __construct()
    {
        if (self::$instance !== null) {
            throw new Exception('Cannot create new instance of singleton');
        }
    }

    public static function  getInstance(): Singleton
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

}

$instance = Singleton::getInstance();
// $instance = new Singleton(); // Error: __construct() is private

var_dump($instance);
