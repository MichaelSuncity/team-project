<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class UserAutorisationCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('userautorisation/autorisation');
    }

   
    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'MyName',
            'SignupForm[subname]' => 'MySubname',
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[password]' => 'tester_password',
        ]);

       
    }
}
