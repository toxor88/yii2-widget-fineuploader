<?php

/* @var $this yii\web\View */
/* @var $widget toxor88\fineuploader\Fineuploader */

$widget = $this->context;

?>

<script type="text/template" id="<?= $widget->clientOptions['template'] ?>">
    <div class="qq-uploader-selector qq-uploader">
        <div class="qq-upload-drop-area-selector qq-upload-drop-area " qq-hide-dropzone>
            <span><?= $widget->dropLabel ?></span>
        </div>

        <div class="qq-upload-button-selector qq-upload-button btn btn-info" style="width: auto;">
            <?= $widget->buttonIcon ?> <?= $widget->buttonLabel ?>
        </div>

            <span class="qq-drop-processing-selector qq-drop-processing">
                <span><?= $widget->dropProcessingLabel ?></span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>

        <ul class="qq-upload-list-selector qq-upload-list margin-top-md">
            <li class="alert alert-info margin-bottom-lg">
                <div class="qq-progress-bar-container-selector">
                    <div class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>

                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <span class="qq-edit-filename-icon-selector qq-edit-filename-icon"></span>
                <span class="qq-upload-file-selector qq-upload-file"></span>
                <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text"/>
                <span class="qq-upload-size-selector qq-upload-size"></span>

                <a class="qq-upload-cancel-selector qq-upload-cancel" href="#"><?= $widget->cancelLabel ?></a>
                <a class="qq-upload-retry-selector qq-upload-retry" href="#"><?= $widget->retryLabel ?></a>
                <a class="qq-upload-delete-selector qq-upload-delete" href="#"><?= $widget->deleteLabel ?></a>

                <span class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
        </ul>
    </div>
</script>
