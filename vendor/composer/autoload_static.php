<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit012bf5a23e0cddaafd2fda083e398b0f
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hybridauth\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hybridauth\\' => 
        array (
            0 => __DIR__ . '/..' . '/hybridauth/hybridauth/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit012bf5a23e0cddaafd2fda083e398b0f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit012bf5a23e0cddaafd2fda083e398b0f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit012bf5a23e0cddaafd2fda083e398b0f::$classMap;

        }, null, ClassLoader::class);
    }
}
