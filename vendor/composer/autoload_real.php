<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitce85dba9a98e852e4f5d4be7554ceeff
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitce85dba9a98e852e4f5d4be7554ceeff', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitce85dba9a98e852e4f5d4be7554ceeff', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitce85dba9a98e852e4f5d4be7554ceeff::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
