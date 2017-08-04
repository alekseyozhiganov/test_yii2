<?php

namespace app\models;


use yii\base\Model;
use yii\db\Query;

class CalculationList extends Model
{

    const OPERATION_EQUAL = 1;
    const OPERATION_LESS = 2;
    const OPERATION_MORE = 3;

    public $operation;
    public $value;
    private $op;



    public static $operations_labels = [
        self::OPERATION_EQUAL => 'equals',
        self::OPERATION_LESS => 'less',
        self::OPERATION_MORE => 'more',
    ];


    private static $operations = [
        self::OPERATION_EQUAL => '=',
        self::OPERATION_LESS => '<',
        self::OPERATION_MORE => '>',
    ];


    public function rules()
    {
        return [
            [['operation', 'value'], 'safe']
        ];
    }

    public function query(){
        $this->parseFields();
        return $this->op && $this->value ? $this->searchQuery() : $this->simpleQuery();
    }

    private function simpleQuery(){
        return (new Query())
            ->select('*')
            ->from('calculation');
    }

    private function searchQuery(){


        return (new Query())
            ->select('calculation.*')
            ->from('calculation')
            ->leftJoin('calculation_codes', 'calculation.id = calculation_codes.calculation_id')
            ->where([$this->op, 'calculation_codes.code', $this->value])->groupBy('calculation.id');
    }

    private function parseFields(){
        $this->value = intval($this->value);
        if(isset(self::$operations[$this->operation])){
            $this->op = self::$operations[$this->operation];
        }
    }
}