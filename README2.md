Enhanced Yii2 wrapper for the Fineuploader.js plugin
====================================================
See <https://github.com/FineUploader/fine-uploader>.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist toxor88/yii2-widget-fineuploader "*"
```

or add

```
"toxor88/yii2-widget-fineuploader": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \toxor88\fineuploader\Fineuploader::widget([
        // by default it uses the jQuery wrapper for the library, if you want the native one, use this:
        'jQuery' => false,
        'clientOptions' => [
            'request' => [
                'endpoint' => Yii::$app->urlManager->createUrl(['/your-handler']),
                'params' => [Yii::$app->request->csrfParam => Yii::$app->request->csrfToken]
            ],
            'validation' => [
                'allowedExtensions' => ['jpeg', 'jpg', 'png', 'bmp', 'gif'],
            ],
            'classes' => [
                'success' => 'alert alert-success hidden',
                'fail' => 'alert alert-error'
            ],
        ],
        'clientEvents' => [
            'autoRetry' => '',
            'cancel' => '',
            'complete' => '',
            ...
        ]
    ])
?>
```
