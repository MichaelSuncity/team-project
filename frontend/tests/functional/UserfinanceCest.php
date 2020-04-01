<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class UserfinanceCest
{
    public function checkUser(FunctionalTester $I)
    {
        $I->amOnRoute('user/user');;
        $I->see('My Application');
        $I->seeLink('test');
        $I->see('Ваш идентификонный номер ');
        $I->see('Ваше имя');
        $I->see('Ваша фамилия');
        $I->see('Ваш электроный ящик');
        $I->see('Дата создания вашего акаунта');
        $I->see('Дата изменения акаунта');
        

        $I->wait(2); // wait for page to be opened

        
    }
}
