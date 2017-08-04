<?php


namespace app\models;
use yii\db\ActiveRecord;

/**
 * Class CalculationCodes
 * @package app\models
 * @property int $id [int(11)]
 * @property int $calculation_id [int(11)]
 * @property int $code [int(20)]
 * @property Calculation $calculation
 */
class CalculationCodes extends ActiveRecord
{

    public function getCalculation(){
        return $this->hasOne(Calculation::className(), ['id' => 'calculation_id']);
    }


}