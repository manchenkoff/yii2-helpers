<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Proxy for Yii::$app
 * @return \yii\console\Application|\yii\web\Application
 */
function app()
{
    return Yii::$app;
}

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

/**
 * Proxy for app user object
 * @return mixed|\yii\web\User
 */
function user()
{
    return app()->user;
}

/**
 * Proxy for app request object
 * @return \yii\console\Request|\yii\web\Request
 */
function request()
{
    return app()->request;
}

/**
 * Proxy for app response object
 * @return \yii\console\Response|\yii\web\Response
 */
function response()
{
    return app()->response;
}

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

/**
 * Returns app config value by $key of false
 *
 * @param string $key
 *
 * @return bool|mixed
 */
function config(string $key)
{
    return app()->params[$key] ?? false;
}

/**
 * Proxy for app session object
 * @return mixed|\yii\web\Session
 */
function session()
{
    return app()->session;
}

/**
 * Cookies helper function
 *
 * @param string|null $name
 * @param string|null $value
 * @param int $expire
 *
 * @return mixed|\yii\web\CookieCollection
 */
function cookies(string $name = null, string $value = null, int $expire = -1)
{
    if (!is_null($name)) {
        if (is_null($value)) {
            return request()->cookies[$name];
        } else {
            return response()->cookies->add(
                new \yii\web\Cookie([
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

/**
 * Sets or returns value from cache
 * Returns Yii::$app->cache if $key is empty
 *
 * @param string $key
 * @param mixed $value
 *
 * @return bool|mixed|\yii\caching\CacheInterface
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