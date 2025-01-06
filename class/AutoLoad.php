<?php

// Define a class for autoload other classes
class AutoLoad
{
    // Singleton instance variable
    private static $_instance = null;

    // Private constructor to enforce singleton pattern and register the autoload function
    private function __construct()
    {
        spl_autoload_register([$this, 'load']);
    }

    // Singleton instance creation method
    public static function _instance()
    {
        // Create a new instance if it doesn't exist
        if (!self::$_instance)
            self::$_instance = new AutoLoad();

        // Return the instance
        return self::$_instance;
    }

    // Autoload function to include class files when needed
    public function load($class)
    {
        // Define the paths for the class file and base class file
        $classFile = trailingslashit(VIP_PLUGIN_DIR . 'class') . $class . '.php';

        // Check if either class file is readable
        if (is_readable($classFile)) {
            // Include the class file if it exists
            if (file_exists($classFile)) {
                include_once $classFile;
            }
        }
    }
}

// Create a single instance of the AutoLoad class
AutoLoad::_instance();
