<?php


namespace console\controllers;


use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * @throws \Exception
     *
     *
     * php yii rbac/init
     *
     */
    public function actionInit()
    {
        \Yii::$app->runAction('migrate', ['migrationPath' => '@yii/rbac/migrations']);

        /**
         * создание ролей пользователей
         * юзер
         * админ
         */

        $auth = \Yii::$app->authManager;

        $roleUser = $auth->createRole('user');
        $roleUser->description = 'Обычный пользователь сайта';
        $auth->add($roleUser);


        $roleAdmin = $auth->createRole('admin');
        $roleAdmin->description = 'Администратор сайта';
        $auth->add($roleAdmin);
        $auth->addChild($roleAdmin, $roleUser);

        /**
         *
         * Установка ролей на пользователей
         *
         */

        $auth->assign($roleAdmin,1);
        $auth->assign($roleUser,2);
    }
}