<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite10d329554736dd3b83fa3495d612011
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TesteAux\\Testphp\\' => 17,
        ),
        'P' => 
        array (
            'PHPJasper\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TesteAux\\Testphp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'PHPJasper\\' => 
        array (
            0 => __DIR__ . '/..' . '/geekcom/phpjasper/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite10d329554736dd3b83fa3495d612011::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite10d329554736dd3b83fa3495d612011::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite10d329554736dd3b83fa3495d612011::$classMap;

        }, null, ClassLoader::class);
    }
}