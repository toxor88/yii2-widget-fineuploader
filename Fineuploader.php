<?php
/**
 * @author: Steven Cash (toxor88@gmail.com)
 * @copyright: Cash Design
 */

namespace toxor88\fineuploader;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Widget for Fineuploader JS
 *
 * @package toxor88\fineuploader
 */
class Fineuploader extends Widget
{
    /**
     * @var bool Whether to load as a jquery plugin
     */
    public $jQuery = true;
    /**
     * @var int Script position to load
     */
    public $scriptPosition = View::POS_READY;
    /**
     * @var string View file path
     */
    public $template = '';
    /**
     * @var string DOM selector
     */
    public $selector = '.uploader';
    /**
     * @var string Drop zone label
     */
    public $dropLabel = 'Drop here.';
    /**
     * @var string Drop zone processing message
     */
    public $dropProcessingLabel = 'Processing dropped file(s)...';
    /**
     * @var string Button icon html
     */
    public $buttonIcon = '';
    /**
     * @var string Button icon class name
     */
    public $buttonIconName = 'glyphicon glyphicon-open';
    /**
     * @var string Button label
     */
    public $buttonLabel = 'Add File(s)';
    /**
     * @var string Cancel button label
     */
    public $cancelLabel = 'Cancel';
    /**
     * @var string Delete button label
     */
    public $retryLabel = 'Retry';
    /**
     * @var string Delete button label
     */
    public $deleteLabel = 'Delete';
    /**
     * @var array Html options
     */
    public $options = [];
    /**
     * @var array Client options
     */
    public $clientOptions = [];
    /**
     * @var array Client events
     */
    public $clientEvents = [];

    /**
     * @var array Default client events
     */
    protected $defaultClientOptions = [
        'template' => 'qq-template',
    ];
    /**
     * @var array Default client events
     */
    protected $defaultClientEvents = [
        'autoRetry' => '',
        'cancel' => '',
        'complete' => '',
        'allComplete' => '',
        'delete' => '',
        'deleteComplete' => '',
        'error' => '',
        'manualRetry' => '',
        'pasteReceived' => '',
        'progress' => '',
        'resume' => '',
        'sessionRequestComplete' => '',
        'statusChange' => '',
        'submit' => '',
        'submitDelete' => '',
        'submitted' => '',
        'totalProgress' => '',
        'upload' => '',
        'uploadChunk' => '',
        'uploadChunkSuccess' => '',
        'validate' => '',
        'validateBatch' => '',
    ];
    /**
     * @var array Client events function params
     */
    protected $clientEventParams = [
        'autoRetry' => 'id, name, attemptNumber',
        'cancel' => 'id, name',
        'complete' => 'id, name, responseJSON, xhrOrXdr',
        'allComplete' => 'succeeded, failed',
        'delete' => 'id',
        'deleteComplete' => 'id, xhr, isError',
        'error' => 'id, name, errorReason, xhrOrXdr',
        'manualRetry' => 'id, name',
        'pasteReceived' => 'blob',
        'progress' => 'id, name, uploadedBytes, totalBytes',
        'resume' => 'id, name, chunkData',
        'sessionRequestComplete' => 'response, success, xhrOrXdr',
        'statusChange' => 'id, oldStatus, newStatus',
        'submit' => 'id, name',
        'submitDelete' => 'id',
        'submitted' => 'id, name',
        'totalProgress' => 'totalUploadedBytes, totalBytes',
        'upload' => 'id, name',
        'uploadChunk' => 'id, name, chunkData',
        'uploadChunkSuccess' => 'id, chunkData, responseJSON, xhrOrXdr',
        'validate' => 'data, buttonContainer',
        'validateBatch' => 'fileOrBlobDataArray, buttonContainer',
    ];


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->clientEvents = ArrayHelper::merge($this->defaultClientEvents, $this->clientEvents);
        $this->clientOptions = ArrayHelper::merge($this->defaultClientOptions, $this->clientOptions);

        if (empty($this->buttonIcon)) {
            if (strpos($this->buttonIconName, 'fa fa-') !== false) {
                $this->buttonIcon = Html::tag('i', '', ['class' => $this->buttonIconName]);
            } else {
                $this->buttonIcon = Html::tag('span', '', ['class' => $this->buttonIconName, 'aria-hidden' => 'true']);
            }
        }

        if (strpos($this->selector, '#') !== false) {
            $this->options['id'] = ltrim($this->selector, '#');
        } else {
            Html::addCssClass($this->options, ltrim($this->selector, '.'));
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerAssets();

        echo $this->renderTemplate();
    }

    /**
     * Registers assets
     */
    protected function registerAssets()
    {
        if ($this->jQuery) {
            FineuploaderJqueryAsset::register($this->getView());
        } else {
            FineuploaderAsset::register($this->getView());
        }

        $this->getView()->registerJs($this->compileScript(), $this->scriptPosition, 'fineUploader__' . $this->selector);
    }

    /**
     * Compiles and returns script
     *
     * @return string
     */
    protected function compileScript()
    {
        $events = array_filter($this->clientEvents);

        if ($this->jQuery) {
            $json = Json::encode($this->clientOptions);
            $script = sprintf('$("%s").fineUploader(%s)', $this->selector, $json);

            foreach ($events as $name => $callback) {
                $script .= "\n" . sprintf('.on("%s", function(%s){ %s })', $name, $this->clientEventParams[$name], $callback);
            }
        } else {
            $options = $this->clientOptions;

            if (strpos($this->selector, '#') !== false) {
                $element = "document.getElementById('{$this->options['id']}')";
            } else {
                $className = ltrim($this->selector, ".");
                $element = "document.getElementsByClassName('{$className}')[0]";
            }

            $options['element'] = new JsExpression($element);

            foreach ($events as $name => $callback) {
                $onName = 'on' . Inflector::camelize($name);
                $options['callbacks'][$onName] = new JsExpression("function({$this->clientEventParams[$name]}) {
                    {$callback}
                }");
            }

            $json = Json::encode($options);
            $script = sprintf('var fineUploader_%s = new qq.FineUploader(%s)', $this->getId(), $json);
        }

        $script .= ';';

        return $script;
    }

    /**
     * Renders template
     *
     * @return string
     */
    protected function renderTemplate()
    {
        $view = __DIR__ . '/views/default-template.php';

        if (!is_null($this->template)) {
            $view = $this->template;
        }

        $template = Html::tag('div', '', $this->options);
        $template.= $this->render($view);

        return $template;
    }
}
