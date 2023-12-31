<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit92e6b6af84ad0e83b29dba3ba82edb42
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

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit92e6b6af84ad0e83b29dba3ba82edb42::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit92e6b6af84ad0e83b29dba3ba82edb42::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit92e6b6af84ad0e83b29dba3ba82edb42::$classMap;

        }, null, ClassLoader::class);
    }
}
