<?php


namespace frontend\models;

use Yii;
use common\models\PaymentMethod;
use yii\base\Model;

class TransferForm extends Model
{
    public $id;
    public $name;
    public $title;
    public $date;
    public $sum = 0;
    public $recipient;
    public $possibleRecipients;
    
    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->id = $paymentMethod->id;
        $this->name = $paymentMethod->name;
        $this->title = 'Перевод';
        $this->date = date('Y-m-d');
        $this->possibleRecipients = $paymentMethod->getOtherPayments();
        $this->recipient = $this->possibleRecipients[0];
        //parent::__construct();
    }
    
    public function rules()
    {
        return [
            [['title', 'date', 'recipient', 'sum'], 'required'],
            [['sum'], 'integer', 'min' => 0],
            [['title'], 'string', 'max' => 255],
            [['date'], 'date', 'format' =>'php:Y-m-d'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'date' => 'Дата',
            'sum' => 'Сумма',
            'name' => 'Отправитель',
            'recipient' => 'Получатель',
        ];
    }
    
}
