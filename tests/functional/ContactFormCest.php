<?php

class ContactFormCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click(["name"=>"add-button"]);

    }

    public function openContactPage(\FunctionalTester $I)
    {
        $I->see('New contact', 'h1');
    }

}
