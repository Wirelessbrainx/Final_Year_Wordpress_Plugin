<?php
/*
    @package Reviewdoo
 * @author Oliver Grimes <og55@kent.ac.uk>
 * @author Aaron Manning <am985@kent.ac.uk>
 */


namespace Inc;

final class Init{
    
    public static function get_services(){
        return [
        Pages\Admin::class,
        Pages\User::class,
        Base\Enqueue::class,
        Base\SettingsLinks::class,
        Database\DBCreation::class,
        Database\DatabaseAPI::class,
        Database\JsonCreation::class,
        Js\JsCore::class
        ];
    }


    public static function register_services() {
        foreach (self::get_services() as $class){
            $service = self::instantiate($class);
            if(method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
    
    private static function instantiate($class){
        $service = new $class();
        
        return $service;
    }
          
}


