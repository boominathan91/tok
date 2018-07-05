<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit593ea63714409ec825781a5b43778aed
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\EventDispatcher\\' => 34,
        ),
        'O' => 
        array (
            'OpenTok\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\EventDispatcher\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/event-dispatcher',
        ),
        'OpenTok\\' => 
        array (
            0 => __DIR__ . '/..' . '/opentok/opentok/src/OpenTok',
        ),
    );

    public static $prefixesPsr0 = array (
        'J' => 
        array (
            'JohnStevenson\\JsonWorks' => 
            array (
                0 => __DIR__ . '/..' . '/aoberoi/json-works/src',
            ),
        ),
        'G' => 
        array (
            'Guzzle\\Tests' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/tests',
            ),
            'Guzzle' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit593ea63714409ec825781a5b43778aed::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit593ea63714409ec825781a5b43778aed::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit593ea63714409ec825781a5b43778aed::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
