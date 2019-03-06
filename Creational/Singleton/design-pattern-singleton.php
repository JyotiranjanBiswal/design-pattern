<?php
class Singleton
{
    private static $instances = array();
    
    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    protected function __construct() 
    {
        
    }
    
    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    protected function __clone()
    {
        
    }
    
    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance()
    {
        $cls = get_called_class(); // late-static-bound class name
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }
        return self::$instances[$cls];
    }
}

class Foo extends Singleton {}
class Bar extends Singleton {}

echo get_class(Foo::getInstance()) . "\n";
echo get_class(Bar::getInstance()) . "\n";


/*
OUTPUT:

Foo
Bar
*/
