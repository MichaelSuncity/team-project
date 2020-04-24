<?php

return [
    [
        'controller' => 'api/expensescategories',
        'class' => \yii\rest\UrlRule::class,
        'extraPatterns' => [
        ],
    ],
    [
        'controller' => 'api/expenses',
        'class' => \yii\rest\UrlRule::class,
        'extraPatterns' => [
        ],
    ],
    //payment-method
    'payment-method' => 'payment-method/index',
    'payment-method/<id:\d+>' => 'payment-method/view',
    'payment-method/update/<id:\d+>' => 'payment-method/update',
    'payment-method/delete/<id:\d+>' => 'payment-method/delete',
    'payment-method/transfer/<id:\d+>' => 'payment-method/transfer',
    'payment-method/operation/<id:\d+>' => 'payment-method/operation',
    //cash-flows
    'cash-flows' => 'cash-flowsd/index',
    'cash-flows/payment-method/<payment_id:\d+>' => 'cash-flows/payment-method',
];