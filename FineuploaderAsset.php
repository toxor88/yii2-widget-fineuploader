<?php
/**
 * @author: Steven Cash (toxor88@gmail.com)
 * @copyright: Cash Design
 */

namespace toxor88\fineuploader;

/**
 * Class FineuploaderAsset
 *
 * @package toxor88\fineuploader
 */
class FineuploaderAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/fine-uploader/dist';
    public $js = [
        'fine-uploader.min.js'
    ];
    public $css = [
        'fine-uploader.min.css',
    ];
}
