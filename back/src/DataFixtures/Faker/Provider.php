<?php

// src/DataFixtures\Faker

namespace App\DataFixtures\Faker;

use \Faker\Provider\Base as BaseProvider;

class Provider extends BaseProvider
{

    protected static $games = [
        'League of Legends',
        'Fortnite',
        'Dota',
        'COD',
        'Overwatch',
        'CS:GO',
        'PUBG',
        'Apex Legends',
        'Rainbow Six Siege',
        'World of Warcraft',
        'Diablo'
    ];

    protected static $ranks = [

        'Iron',
        'Bronze',
        'Silver',
        'Gold',
        'Platinum',
        'Diamond',
        'Master',
        'Grandmaster',
        'Challenger',

    ];

    protected static $roles = [
        ['ROLE_USER'],
        ['ROLE_ADMIN'],
        ['ROLE_ANONYMOUS']
    ];

    protected static $platform = [

        'pc',
        'playstation',
        'xbox'
    ];

    protected static $frequency = [

        'elite',
        'pro',
        'dur à cuire',
        'combatif',
        'novice',
        'amateur',
        'débutant'
    ];




    public static function games(){
        return static::randomElement(static::$games);
    }


    public static function ranks(){
        return static::randomElement(static::$ranks);
    }

    public static function roles(){
        return static::randomElement(static::$roles);
    }


    public static function platform(){
        return static::randomElement(static::$platform);
    }

    public static function frequency(){
        return static::randomElement(static::$frequency);
    }


}