<?php
use yii\helpers\Html;
use callmez\wechat\models\Message;
use callmez\wechat\widgets\FileApi;
use callmez\wechat\widgets\ActiveForm;
use callmez\wechat\assets\MessageAsset;

MessageAsset::register($this);
?>
<?php $form = ActiveForm::begin([
    'id' => 'messageForm',
    'layout' => 'horizontal'
]); ?>
    <?= Html::activeHiddenInput($model, 'toUser') ?>

    <?= $form->field($model, 'msgType')->inline()->radioList(Message::$types) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'musicUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hqMusicUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea() ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'thumbMediaId')->widget(FileApi::className(), [
        'jsOptions' => [
            'url' => $uploadUrl
        ]
    ]) ?>

    <?= $form->field($model, 'mediaId')->widget(FileApi::className(), [
        'jsOptions' => [
            'url' => $uploadUrl
        ]
    ]) ?>

    <?= $form->field($model, 'musicUrl')->widget(FileApi::className(), [
        'jsOptions' => [
            'url' => $uploadUrl
        ]
    ]) ?>

    <div class="form-group submit-button">
        <div class="col-sm-offset-3 col-sm-6">
            <?= Html::submitButton('发送', ['class' => 'btn btn-block btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
<?php
$this->registerJs(<<<EOF
    $('#messageForm').message();
EOF
);