<?php

// autoload_real.php generated by Composer

class ComposerAutoloaderInited5226a34ded3ab53f863cdcf89295ea
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInited5226a34ded3ab53f863cdcf89295ea', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInited5226a34ded3ab53f863cdcf89295ea', 'loadClassLoader'));

        $vendorDir = dirname(__DIR__);
        $baseDir = dirname($vendorDir);

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        require $vendorDir . '/minfraud/http/src/CreditCardFraudDetection.php';
        require $vendorDir . '/titon/utility/src/Titon/bootstrap.php';
       // require $vendorDir . '/minfraud/http/src/HTTPBase.php';
        require $vendorDir . '/minfraud/http/src/TelephoneVerification.php';

        return $loader;
    }
}
