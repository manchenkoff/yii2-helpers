<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

declare(strict_types=1);

use yii\console\Application as ConsoleApplication;
use yii\console\Request as ConsoleRequest;
use yii\console\Response as ConsoleResponse;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\i18n\Formatter;
use yii\web\Application as HttpApplication;
use yii\web\Cookie;
use yii\web\CookieCollection;
use yii\web\Request as HttpRequest;
use yii\web\Response as HttpResponse;
use yii\web\User;

if (!function_exists('app')) {
    /**
     * Proxy for Yii::$app
     * @return ConsoleApplication|HttpApplication
     */
    function app()
    {
        return Yii::$app;
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
    function url($url = '', bool $absolute = false): string
    {
        return Url::to($url, $absolute);
    }
}

if (!function_exists('auth')) {
    /**
     * Proxy for RBAC manager object
     * @return mixed|User
     */
    function auth(): User
    {
        return app()->authManager;
    }
}

if (!function_exists('request')) {
    /**
     * Proxy for app request object
     * @return ConsoleRequest|HttpRequest
     */
    function request()
    {
        return app()->request;
    }
}

if (!function_exists('response')) {
    /**
     * Proxy for app response object
     * @return ConsoleResponse|HttpResponse
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
    function e(string $value): string
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
    function t(string $category, string $message, array $params = []): string
    {
        return Yii::t($category, $message, $params);
    }
}

if (!function_exists('formatter')) {
    /**
     * Proxy for Yii::$app->formatter
     * @return Formatter
     */
    function formatter(): Formatter
    {
        return Yii::$app->formatter;
    }
}

if (!function_exists('config')) {
    /**
     * Returns app config value by $key of false
     *
     * @param string $key
     * @param mixed|null $value
     *
     * @return bool|string|mixed
     */
    function config(string $key, $value = null)
    {
        if ($value === null) {
            return app()->params[$key] ?? null;
        }

        app()->params[$key] = $value;

        return $value;
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
     * @return CookieCollection|?Cookie
     */
    function cookies(string $name = null, string $value = null, int $expire = -1)
    {
        if ($name === null) {
            return request()->cookies;
        }

        if ($value === null) {
            return request()->cookies->get($name);
        }

        $newCookieToResponse = new Cookie(
            [
                'name' => $name,
                'value' => $value,
                'secure' => true,
                'expire' => $expire === -1 ? strtotime('+1 month') : $expire,
            ]
        );

        response()->cookies->add($newCookieToResponse);

        return $newCookieToResponse;
    }
}

if (!function_exists('view')) {
    /**
     * Proxy for app controller 'render' method
     *
     * @param string $view
     * @param array $context
     *
     * @return string
     */
    function view(string $view, array $context = []): string
    {
        return app()->controller->render($view, $context);
    }
}

if (!function_exists('alias')) {
    /**
     * Proxy for get or set Yii alias (set if $value is not null)
     *
     * @param string $alias
     * @param string|null $value
     *
     * @return null|string
     */
    function alias(string $alias, string $value = null): ?string
    {
        if ($value === null) {
            return Yii::getAlias($alias) ?: null;
        }

        Yii::setAlias($alias, $value);

        return $value;
    }
}