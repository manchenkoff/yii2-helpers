# Yii2 Helpers

Useful short helper functions to work with default Yii 2 components.

## Installation

You have to run following command to add a dependency to your project

```bash
composer require manchenkov/yii2-helpers
```

or you can add this line to `require` section of `composer.json`

```
"manchenkov/yii2-helpers": "*"
```

## Functions

- `app()`: returns `Yii::$app` object
- `url()`: instead of `yii\helpers\Url::to()`
- `user()`: returns `Yii::$app->user` object
- `request()`: returns `Yii::$app->request` object
- `response()`: returns `Yii::$app->response` object
- `debug()`: instead of `Yii::debug()`
- `e()`: instead of `yii\helpers\Html::encode()`
- `t()`: instead of `Yii::t()`
- `config()`: returns some parameter from `Yii::$app->params` by key
- `session()`: returns `Yii::$app->session` object
- `cookies()` returns a cookie from request or set new value to response
- `view()` calls `render()` method of current controller (example: `return view('index', ['list' => $list])` instead of `return $this->render('index', ['list' => $list])`)
- `alias()` get or set alias value (instead of `Yii::getAlias()` and `Yii::setAlias()`)
- `cache()` get or set cached value (instead of `Yii::$app->cache->set()` and `Yii::$app->cache->get()`), also returns `Yii::$app->cache` if no arguments passed