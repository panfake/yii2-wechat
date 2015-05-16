<?php
use \Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use callmez\wechat\models\ReplyRule;
use callmez\wechat\modules\admin\widgets\AdminPanel;

$this->title = '回复管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php AdminPanel::begin(['options' => ['class' => 'reply-index']]) ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加回复规则', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => [
                    'width' => 75
                ]
            ],
            'name',
            [
                'attribute' => 'mid',
                'value' => function($model) {
                    $module = Yii::$app->getModule('wechat');
                    return (($module = $module->getModule($model->mid)) ? $module->name: '') . '(' . $model->mid . ')';
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model) {
                    return Html::tag('span', ReplyRule::$statuses[$model->status], [
                        'class' => 'label label-' . ($model->status == ReplyRule::STATUS_ACTIVE ? 'success' : 'info')
                    ]);
                },
                'filter' => ReplyRule::$statuses,
                'options' => [
                    'width' => 80
                ]
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'priority',
                'options' => [
                    'width' => 60
                ]
            ],
            [
                'class' => 'callmez\wechat\modules\admin\widgets\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

<?php AdminPanel::end() ?>