<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita5226d0aaaa7729bfb8dbfafe9f9e13f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita5226d0aaaa7729bfb8dbfafe9f9e13f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita5226d0aaaa7729bfb8dbfafe9f9e13f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita5226d0aaaa7729bfb8dbfafe9f9e13f::$classMap;

        }, null, ClassLoader::class);
    }
}
