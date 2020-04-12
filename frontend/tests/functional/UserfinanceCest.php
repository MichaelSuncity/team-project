<?php
namespace frontend\tests\functional;
  
use frontend\tests\FunctionalTester;

class UserfinanceCest
{
     public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('user/user');
    }
    public function checkUser(FunctionalTester $I)
    {
        
        $I->see('My Application');
        $I->seeLink('test');
        $I->see('Ваш идентификонный номер');
        $I->see('1');
        $I->see('Ваше имя');
        $I->see('Вася');
        $I->see('Ваша фамилия');
        $I->see('Иванов');
        $I->see('Ваш электроный ящик');
        $I->see('mail@mail.ru');
       
        

        $I->wait(2); // wait for page to be opened

        
    }
}
