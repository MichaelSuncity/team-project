<?php


namespace frontend\models;

use Yii;
use common\models\PaymentMethod;
use common\models\CashFlows;
use yii\base\Model;

class OperationForm extends Model
{
    public $id;
    public $operation;
    public $name;
    public $title;
    public $date;
    public $sum = 0;
    public $operations;
    
    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->id = $paymentMethod->id;
        $this->name = $paymentMethod->name;
        $this->title = 'Операция';
        $this->date = date('Y-m-d');
        $this->operations = CashFlows::TYPES_LABELS;
        $this->operation = CashFlows::TYPE_REPLENISH;
        //parent::__construct();
    }
    
    public function rules()
    {
        return [
            [['operation', 'title', 'date', 'sum'], 'required'],
            [['operation'], 'in', 'range' => CashFlows::TYPES],
            [['sum'], 'integer', 'min' => 0],
            [['title'], 'string', 'max' => 255],
            [['date'], 'date', 'format' =>'php:Y-m-d'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'operation' => 'Тип операции',
            'title' => 'Название',
            'date' => 'Дата',
            'sum' => 'Сумма',
        ];
    }
    
}
