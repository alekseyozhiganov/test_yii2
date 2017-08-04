<?php
/**
 * @var \app\models\Calculation $model
 */
$form = \yii\bootstrap\ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['/calculation/item','id' => $model->id])]);

?>

<?=$form->field($model, 'title')->textInput();?>
<?=$form->field($model, 'calculation')->textarea();?>
<?php if($codes){?>
    <div class="row">

        <div class="col-sm-12">
            <h5>Codes</h5>
        <?php  foreach ($codes as $code){
            echo "$code->code ";
        }?>
        </div>
    </div>
<?php }?>
<?=\yii\bootstrap\Html::button('Save', ['type'=>'submit', 'class' => 'btn btn-success'])?>

<?php
\yii\bootstrap\ActiveForm::end();
?>
