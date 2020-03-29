<?php

use yii\helpers\Url;

class ContactCest
{
    public function _before(\AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/'));
    }

    public function contactPageWorks(AcceptanceTester $I)
    {
        $I->wantTo('Check Contacts page as home page');
        $I->expect('I am on Contacts page ');
        $I->wait(1); // wait for page to be opened
        $I->see('Contacts');
        $I->seeLink('Phone Book');
        $I->click('Phone Book');
        $I->wait(1); // wait for page to be opened
        $I->see('Contacts');
    }

    public function ensureThatCreateWorks(AcceptanceTester $I)
    {
        $I->wantTo('Check the create page');
        $I->expect('I am on Contacts page ');
        $I->see('Contacts');
        $I->scrollTo(['css' => '.btn', "name" => 'add-button']);
        $I->click(["name"=>"add-button"]);
        $I->waitForText('New contact', 5, 'h1'); // secs
        $I->see('New contact', 'h1');
        $I->fillField('Name', 'Taras');
        $I->fillField('Surname ', 'Vdovichenko');
        $I->fillField('Description', 'Relatives');
        $I->click('//*[@id="dynamic-form"]/div[2]/div/div/div/div[2]/table/tfoot/tr/td[2]/button');
        $I->fillField('#number-0-number', '+380665797883');
        $I->click('Create');
        $I->waitForText('Taras', 5, 'h1');
        $I->see('Taras');
    }

    public function ensureThatUpdateWorks(AcceptanceTester $I)
    {
        $I->wantTo('Check the create page');
        $I->expect('I am on Contacts page ');
        $I->see('Contacts');
        $I->click('//*[@id="contactsTable"]/tbody/tr[1]/td[6]/a[2]');
        $I->expect('I am on Update page ');
        $I->see('Update Oleg', 'h1');
        $I->clearField('Description');
        $I->fillField('Description', 'Test');
        $I->click('Update');
        $I->waitForText('Oleg', 5, 'h1');
    }

    public function ensureThatViewWorks(AcceptanceTester $I)
    {
        $I->wantTo('Check the view page');
        $I->expect('I am on Contacts page ');
        $I->click('//*[@id="contactsTable"]/tbody/tr[1]/td[6]/a[1]');
        $I->waitForText('Oleg', 5, 'h1');
        $I->scrollTo(['css' => '.btn', "name" => 'cansel-button']);
        $I->wait(1);
        $I->click(["name"=>"cansel-button"]);
        $I->waitForText('Contacts', 5, 'h1');
        $I->see('Contacts');
    }
}
