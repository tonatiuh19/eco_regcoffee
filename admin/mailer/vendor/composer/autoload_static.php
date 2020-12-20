<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit474d24c0b4a2d2750f28505a661c1536
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit474d24c0b4a2d2750f28505a661c1536::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit474d24c0b4a2d2750f28505a661c1536::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}