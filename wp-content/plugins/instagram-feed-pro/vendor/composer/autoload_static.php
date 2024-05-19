<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4e34082fb013bad63334b182d1cf5455
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'InstagramFeed\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'InstagramFeed\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4e34082fb013bad63334b182d1cf5455::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4e34082fb013bad63334b182d1cf5455::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
