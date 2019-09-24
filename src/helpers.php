<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

use yii\base\InvalidConfigException;
use yii\caching\CacheInterface;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\i18n\Formatter;
use yii\web\Application;
use yii\web\Cookie;
use yii\web\CookieCollection;
use yii\web\Request;
use yii\web\Response;
use yii\web\Session;
use yii\web\User;

if (!function_exists('app')) {
    /**
     * Proxy for Yii::$app
     * @return \yii\console\Application|Application
     */
    function app()
    {
        return Yii::$app;
    }
}

if (!function_exists('invoke')) {
    /**
     * Returns related object from DI container by the passed interface name
     *
     * @param string $class
     * @param array $params
     *
     * @return object
     */
    function invoke(string $class, array $params = [])
    {
        try {
            return Yii::createObject($class, $params);
        } catch (InvalidConfigException $exception) {
            return null;
        }
    }
}

if (!function_exists('url')) {
    /**
     * Generates URL by Yii component
     *
     * @param string|array $url
     * @param bool $absolute
     *
     * @return string
     */
    function url($url = '', bool $absolute = false)
    {
        return Url::to($url, $absolute);
    }
}

if (!function_exists('user')) {
    /**
     * Proxy for app user object
     * @return mixed|User
     */
    function user()
    {
        return app()->user;
    }
}

if (!function_exists('auth')) {
    /**
     * Proxy for RBAC manager object
     * @return mixed|User
     */
    function auth()
    {
        return app()->authManager;
    }
}

if (!function_exists('request')) {
    /**
     * Proxy for app request object
     * @return \yii\console\Request|Request
     */
    function request()
    {
        return app()->request;
    }
}

if (!function_exists('response')) {
    /**
     * Proxy for app response object
     * @return \yii\console\Response|Response
     */
    function response()
    {
        return app()->response;
    }
}

if (!function_exists('debug')) {
    /**
     * Simple debug call
     *
     * @param string|array $message
     * @param string $category
     */
    function debug($message, $category = 'application')
    {
        Yii::debug($message, $category);
    }
}

if (!function_exists('e')) {
    /**
     * Proxy for Html::encode()
     *
     * @param string $value
     *
     * @return string
     */
    function e(string $value)
    {
        return Html::encode($value);
    }
}

if (!function_exists('t')) {
    /**
     * Translates string with params
     *
     * @param string $category
     * @param string $message
     * @param array $params
     *
     * @return string
     */
    function t(string $category, string $message, array $params = [])
    {
        return Yii::t($category, $message, $params);
    }
}

if (!function_exists('formatter')) {
    /**
     * Proxy for Yii::$app->formatter
     * @return Formatter
     */
    function formatter()
    {
        return Yii::$app->formatter;
    }
}

if (!function_exists('config')) {
    /**
     * Returns app config value by $key of false
     *
     * @param string $key
     *
     * @return bool|mixed
     */
    function config(string $key, $value = null)
    {
        if (is_null($value)) {
            return app()->params[$key] ?? false;
        } else {
            app()->params[$key] = $value;

            return true;
        }
    }
}

if (!function_exists('session')) {
    /**
     * Proxy for app session object
     * @return mixed|Session
     */
    function session()
    {
        return app()->session;
    }
}

if (!function_exists('cookies')) {
    /**
     * Cookies helper function
     *
     * @param string|null $name
     * @param string|null $value
     * @param int $expire
     *
     * @return mixed|CookieCollection
     */
    function cookies(string $name = null, string $value = null, int $expire = -1)
    {
        if (!is_null($name)) {
            if (is_null($value)) {
                return request()->cookies[$name];
            } else {
                return response()->cookies->add(
                    new Cookie([
                        'name' => $name,
                        'value' => $value,
                        'secure' => true,
                        'expire' => ($expire == -1) ? strtotime('+1 month') : $expire,
                    ])
                );
            }
        }

        return request()->cookies;
    }
}

if (!function_exists('view')) {
    /**
     * Proxy for app controller 'render' method
     *
     * @param string $view
     * @param array $params
     *
     * @return string
     */
    function view(string $view, array $params = [])
    {
        return app()->controller->render($view, $params);
    }
}

if (!function_exists('alias')) {
    /**
     * Proxy for get or set Yii alias
     *
     * @param string $alias
     * @param string $value
     *
     * @return bool|string
     */
    function alias(string $alias, string $value = null)
    {
        if (is_null($value)) {
            return Yii::getAlias($alias);
        } else {
            Yii::setAlias($alias, $value);
        }

        return true;
    }
}

if (!function_exists('cache')) {
    /**
     * Sets or returns value from cache
     * Returns Yii::$app->cache if $key is empty
     *
     * @param string $key
     * @param mixed $value
     *
     * @return bool|mixed|CacheInterface
     */
    function cache(string $key = null, $value = null)
    {
        if (is_null($key)) {
            return app()->cache;
        }

        if (!is_null($value)) {
            return app()->cache->set($key, $value);
        }

        return app()->cache->get($key);
    }
}