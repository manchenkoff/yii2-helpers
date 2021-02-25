# Yii2 Helpers

Useful short helper functions to work with default Yii 2 components.

## Installation

You have to run the following command to add a dependency to your project

```bash
composer require manchenkov/yii2-helpers
```

or you can add this line to `require` section of `composer.json`

```
"manchenkov/yii2-helpers": "^1.1.0"
```

## Usage

After installation, you may use it in existing code like this:

```php
use yii\web\Controller;

class SiteController extends Controller 
{
    public function actionIndex(): string
    {
        if (app()->user->isGuest) {
            return view('guests');
        }
        
        return view('main');
    }
    
    // ...
    
    public function actionAjaxGetData(): string
    {
        if (request()->isAjax) {
            $number = request()->get('number');
            
            // ...
        }
        
        return view('main');
    }
}
```

## Functions

| Function      | Description |
| ------------- | ----------- |
| `app()`       | returns `Yii::$app` object |
| `url()`       | instead of `yii\helpers\Url::to()` |
| `request()`   | returns `Yii::$app->request` object |
| `response()`  | returns `Yii::$app->response` object |
| `debug()`     | instead of `Yii::debug()` |
| `e()`         | instead of `yii\helpers\Html::encode()` |
| `t()`         | instead of `Yii::t()` |
| `formatter()` | instead of `Yii::$app->formatter` |
| `config()`    | returns some parameter from `Yii::$app->params` by key or set if value passed |
| `cookies()`   | returns a cookie from request or set new value to response |
| `view()`      | calls `render()` method of current controller (example: `return view('index', ['list' => $list])` instead of `return $this->render('index', ['list' => $list])`) |
| `alias()`     | get or set alias value (instead of `Yii::getAlias()` and `Yii::setAlias()`) |