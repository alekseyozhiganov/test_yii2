<?php
/**

 * @var \yii\data\ActiveDataProvider $provider
 * @var \app\models\CalculationList $model
 */

use yii\bootstrap\Html;
use yii\widgets\Pjax;

Pjax::begin(['linkSelector' => '.pagination a', 'timeout' => 1500]);

?>
<div class="text-right">
    <?= Html::a('Add', '/calculation/item', ['class' => 'btn btn-success calculation-add'])?>
</div>
<?php
	$form = \yii\widgets\ActiveForm::begin(['method' => 'get']);
?>
	<div class="row">
		<div class="col-md-4">
			<?=$form->field($model, 'operation')->dropDownList(\app\models\CalculationList::$operations_labels)?>
		</div>
		<div class="col-md-4">
            <?=$form->field($model, 'value')->textInput()?>
		</div>
		<div class="col-md-4">
			<?=Html::button('Find', ['class' => 'btn btn-success calculation-list-btn-find', 'type' => 'submit'])?>
		</div>
	</div>
<?
\yii\widgets\ActiveForm::end();
echo \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'id',
        'title',
        [
            'class' => 'yii\grid\ActionColumn',
			'template' => '{view} {delete}',
			'buttons' => [
					'view' => function($url, $model, $key){
                        return Html::a('', Yii::$app->urlManager->createUrl(['/calculation/item', 'id' => $model['id']]), ['class' => 'glyphicon glyphicon-eye-open', "aria-hidden"=> "true"]);
					},
					'delete' => function($url, $model, $key){
                        return Html::a('', Yii::$app->urlManager->createUrl(['/calculation/delete', 'id' => $model['id']]), ['class' => 'glyphicon glyphicon-trash calculation-delete', "aria-hidden"=> "true"]);
					}
			]
        ]
    ]
 ]);


 Pjax::end();

