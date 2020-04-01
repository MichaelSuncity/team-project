<?php

namespace frontend\tests\acceptance;

use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class UserfinanceCest
{
    public function checkUser(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/user/user'));
        $I->see('My Application');
        $I->seeLink('test');
        $I->see('Ваш номер');
        $I->see('Ваше имя');
        $I->see('Ваша фамилия');
        $I->see('Ваш электроный ящик');
        $I->see('Дата создания вашего акаунта');
        $I->see('Дата изменения акаунта');
        

        $I->wait(2); // wait for page to be opened

        
    }
}
