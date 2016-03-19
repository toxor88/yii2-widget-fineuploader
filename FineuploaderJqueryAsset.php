<?php
/**
 * @author: Steven Cash (toxor88@gmail.com)
 * @copyright: Cash Design
 */

namespace toxor88\fineuploader;

/**
 * Class FineuploaderJqueryAsset
 *
 * @package toxor88\fineuploader
 */
class FineuploaderJqueryAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@toxor88/fineuploader/assets';
    public $js = [
        'jquery.fine-uploader/jquery.fine-uploader.min.js'
    ];
    public $css = [
        'jquery.fine-uploader/fine-uploader.min.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
