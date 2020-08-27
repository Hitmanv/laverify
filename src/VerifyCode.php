<?php

namespace Hitmanv\Laverify;

use Illuminate\Support\Facades\Cache;

class VerifyCode {
    public static function gen($type, $target, $ttl=300){
        $key = self::getKey($type, $target);
        $code = self::genNumericCode();

        Cache::put($key, $code, $ttl);

        return true;
    }

    public static function verify($type, $target, $value){
        if(!$value) return false;

        $key = self::getKey($type, $target);
        $vcode = Cache::get($key);

        if($value == $vcode) {
            Cache::forget($target);
            return true;
        } else {
            return false;
        }
    }

    public static function genNumericCode($len=6) {
        $min = pow(10, $len-1);
        $max = pow(10, $len)-1;

        return rand($min, $max);
    }

    private static function getKey($type, $target) {
        $prefix = config('app.verify_code.prefix', '_verify');

        return "{$prefix}:{$type}:{$target}";
    }
}