<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class GeneralCest
{
    public function checkGeneral(FunctionalTester $I)
    {
        $I->amOnRoute('mainpage/main');
        $I->see('container', 'div');
        $I->see('#', 'th');
        $I->see('Имя пользователя', 'th');
        $I->see('Дата регистрации', 'th');
        $I->see('1', 'th');
        $I->see('TestName', 'th');
        $I->see('1586271650', 'th');
        $I->see('table', 'table');
        $I->see('#', 'th');
        $I->see('Валютная пара', 'th');
        $I->see('Цена', 'th');
        $I->see('1', 'th');
        $I->see('eur/usd', 'цена');
        $I->see('цена', 'h1');
        $I->see('2', 'th');
        $I->see('gpb/usd', 'цена');
        $I->see('цена', 'h1');
        $I->see('3', 'th');
        $I->see('usd/cad', 'цена');
        $I->see('цена', 'h1');
        
    }
}
