<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CalcForm extends Model
{
    public $number1;
    public $number2;
    public $myOperation;

    public $operation = [
        'plus' => '+',
        'minus' => '-',
        'times' => '*',
        'divided by' => '/'
    ];

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['number1', 'number2', 'myOperation'], 'required'],
            [['number1', 'number2'], 'integer'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'number1' => 'Число 1',
            'number2' => 'Число 2',
            'myOperation' => 'Действие'
        ];
    }

}
