<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2a5a54131878577c5b232dfb0c5a590b
{
    public static $files = array (
        '9e05116ddaa5b1d244b68c3993908acd' => __DIR__ . '/..' . '/topthink/think-queue/src/config.php',
    );

    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'think\\queue\\' => 12,
            'think\\composer\\' => 15,
            'think\\angular\\' => 14,
            'think\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'think\\queue\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-queue/src',
        ),
        'think\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-installer/src',
        ),
        'think\\angular\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-angular/src',
        ),
        'think\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-image/src',
        ),
    );

    public static $classMap = array (
        'think\\view\\driver\\Angular' => __DIR__ . '/..' . '/topthink/think-angular/drivers/thinkphp5/Angular.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2a5a54131878577c5b232dfb0c5a590b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2a5a54131878577c5b232dfb0c5a590b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2a5a54131878577c5b232dfb0c5a590b::$classMap;

        }, null, ClassLoader::class);
    }
}
