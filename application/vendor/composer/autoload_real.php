<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit318b28dea3c4973a2a2f3614ddfb0aea
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

        spl_autoload_register(array('ComposerAutoloaderInit318b28dea3c4973a2a2f3614ddfb0aea', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit318b28dea3c4973a2a2f3614ddfb0aea', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit318b28dea3c4973a2a2f3614ddfb0aea::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
