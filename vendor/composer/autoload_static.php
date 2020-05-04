<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb459dece0c12acdbb6f1d6ab632fed47
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Source\\' => 7,
        ),
        'C' => 
        array (
            'CoffeeCode\\DataLayer\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
        'CoffeeCode\\DataLayer\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/datalayer/src',
        ),
    );

    public static $classMap = array (
        'CoffeeCode\\DataLayer\\Connect' => __DIR__ . '/..' . '/coffeecode/datalayer/src/Connect.php',
        'CoffeeCode\\DataLayer\\CrudTrait' => __DIR__ . '/..' . '/coffeecode/datalayer/src/CrudTrait.php',
        'CoffeeCode\\DataLayer\\DataLayer' => __DIR__ . '/..' . '/coffeecode/datalayer/src/DataLayer.php',
        'Source\\Models\\App\\ApiUser' => __DIR__ . '/../..' . '/source/Models/App/ApiUser.php',
        'Source\\Models\\App\\User' => __DIR__ . '/../..' . '/source/Models/App/User.php',
        'Source\\Models\\Validations\\Validate' => __DIR__ . '/../..' . '/source/Models/Validations/Validate.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb459dece0c12acdbb6f1d6ab632fed47::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb459dece0c12acdbb6f1d6ab632fed47::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb459dece0c12acdbb6f1d6ab632fed47::$classMap;

        }, null, ClassLoader::class);
    }
}