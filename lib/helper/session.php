<?php

namespace SMSModule;

class SessionHelper
{
    public static function init_session()
    {
        if (empty($_SESSION)) {
            session_start();
        }
    }

    // sets session key, val
    public static function set_session_key($key, $val)
    {
        try {
            SessionHelper::init_session();

            $_SESSION[$key] = $val;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // get session key
    public static function get_session_key($key)
    {
        try {
            SessionHelper::init_session();

            return (!empty($_SESSION[$key]) ? $_SESSION[$key] : array());
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // remove session key
    public static function remove_session_key($key)
    {
        try {
            SessionHelper::init_session();

            unset($_SESSION[$key]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
