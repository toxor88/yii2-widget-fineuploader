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
class FineuploaderJqueryAsset extends FineuploaderAsset
{
    public $js = [
        'jquery.fine-uploader.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
