<?php

namespace app\models;


use yii\db\ActiveRecord;
use yii\db\Exception;

/**
 * Class Calculation
 * @package app\models
 * @property int $id [int(11)]
 * @property int $user_id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $calculation
 * @property int $created_at [timestamp]
 * @property int $updated_at [timestamp]
 * @property CalculationCodes[] $codes
 */
class Calculation extends ActiveRecord
{
    public function rules()
    {
        return [
            [['user_id', 'title', 'calculation',], 'required'],
            [['title', 'calculation'], 'safe']
        ];
    }

    public function getCodes(){
        return $this->hasMany(CalculationCodes::className(), ['calculation_id' => 'id']);
    }

    public function beforeValidate()
    {
        $this->user_id = \Yii::$app->user->id;
        return parent::beforeValidate();
    }

    public function afterSave($insert, $changedAttributes)
    {


        if($insert || isset($changedAttributes['calculation'])) {
            $re = '/{[+-]{0,1}\d+}/';
            preg_match_all($re, $this->calculation, $matches);
            $codes = [];
            if(is_array($matches)){
                foreach ($matches as $match){
                    foreach ($match as $code){
                        $code = preg_replace('/[{}+]/', '', $code);
                        $codes[] = intval($code);
                    }
                }
            }

            if($codes){
                CalculationCodes::deleteAll(['calculation_id' => $this->id]);
                try {
                    foreach ($codes as $code) {
                        $model = new CalculationCodes();
                        $model->calculation_id = $this->id;
                        $model->code = $code;
                        $state = $model->save();
                        $state1 = $state;
                    }

                }catch (\Exception $e){

                    throw $e;
                }
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }
}