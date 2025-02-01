<?php

class Session
{
    public static function isSetSession(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public static function set( $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        if (self::isSetSession($key)) {
            return $_SESSION[$key];
        }
    }

    public static function unset($key)
    {
        if (self::isSetSession($key)) {
        unset($_SESSION[$key]);
        }
    }
}