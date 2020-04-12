<?php

namespace console\controllers;


use common\models\User;
use common\models\PaymentMethod;
use common\models\CashFlows;
use yii\console\Controller;

class DataController extends Controller
{
    /**
    * Create Data
    */
    public function actionRun()
    {
        $this->actionUsers();
        $this->actionPayments();
        $this->actionCashFlows();
    }
    
    /**
    * Create user admin
    */
    public function actionUsers()
    {
        $admin = new User([
            'username' => 'admin',
            'email' => 'admin@gb.ru',
        ]);
        
        $admin->generateAuthKey();
        $admin->password = 'admin';
        $admin->save();
    }
    
    /**
    * Create Payment methods
    */
    public function actionPayments()
    {
        $payment = new PaymentMethod([
            'name' => 'Карта',
            'user_id' => 1,
        ]);
        $payment->save();
        
        $payment = new PaymentMethod([
            'name' => 'Кошелек',
            'user_id' => 1,
        ]);
        $payment->save();
    }
    
    /**
    * Create cash flows
    */
    public function actionCashFlows()
    {
        $cashFlows = new CashFlows([
            'title' => 'Пополнение',
            'date' => time(),
            'payment_id' => 1,
            'type' => CashFlows::TYPE_REPLENISH,
            'sum' => '10000',
            'user_id' => 1,
        ]);
        $cashFlows->save();
        
        $cashFlows = new CashFlows([
            'title' => 'Пополнение',
            'date' => time(),
            'payment_id' => 2,
            'type' => CashFlows::TYPE_REPLENISH,
            'sum' => '2000',
            'user_id' => 1,
        ]);
        $cashFlows->save();
    }
}