<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m200327_133658_Create_contacts_table extends Migration
{
    /*
     * Create an array with data of contacts to fill out the Contacts table. Just for showing reason.
     */
    const InitialContacts = [
        [
            'name' => 'Oleg',
            'surname' => 'Timoshenko',
            'description' => 'Web developer'
        ],
        [
            'name' => 'Vasia',
            'surname' => 'Aleynikov',
            'description' => 'Retired'
        ],
        [
            'name' => 'Ruslana',
            'surname' => 'Komar',
            'description' => 'Big boss'
        ],
        [
            'name' => 'Clava',
            'surname' => 'Nenvenchenko',
            'description' => 'Constractor'
        ],
        [
            'name' => 'Luba',
            'surname' => 'Timoshenko',
            'description' => 'Wife'
        ],
        [
            'name' => 'Petia',
            'surname' => 'Poroshenko',
            'description' => 'Old president'
        ],
        [
            'name' => 'Volodomir',
            'surname' => 'Zelenscky',
            'description' => 'Current president'
        ],
        [
            'name' => 'Dmitry',
            'surname' => 'Dzuba',
            'description' => 'Friends'
        ],
        [
            'name' => 'Lena',
            'surname' => 'Smirnova',
            'description' => 'Wife of comrade'
        ],
        [
            'name' => 'Sergei',
            'surname' => 'Gema',
            'description' => 'My colleague'
        ],
        [
            'name' => 'Una',
            'surname' => 'Avose',
            'description' => 'Actor'
        ],
        [
            'name' => 'Valentina',
            'surname' => 'Timoshenko',
            'description' => 'Mom'
        ]
    ];

    /*
     * Create an array with numbers of contacts to fill out the Numbers table
     */
    const InitialPhoneNumbers = [
        'Oleg' => ['+38067579783'],
        'Vasia' => ['09599786656', '09599786654' ],
        'Ruslana'=> ['09599786656', '09599786654', '09599786659'],
        'Clava' =>  ['0959386656', '0959946654', '0959788659'],
        'Luba' => ['0669386656', '0669946654', '0669788659'],
        'Petia' => ['0669386656', '0669946654', '0669788659'],
        'Volodomir' => ['0669386656'],
        'Dmitry' => ['0959968665', '+380959978665', '0959977659'],
        'Lena' => ['0959968633', '+380959978333', '0959977633'],
        'Sergei' => ['0959968633', '+380959978333', '0959977633', '0759968633', '+380759978333', '0989977633', '0639968633', '+380639978333', '0639977633'],
        'Una' => ['0959968633', '+380959978333'],
        'Valentina' => ['0666269761']
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Contacts',
            [
                'id'            => $this->primaryKey(),
                'name'          => $this->string()->notNull()->unique(),
                'surname'       => $this->string(),
                'description'   => $this->text(),
            ]
        );

        $this->createTable('Numbers',
            [
                'id'            => $this->primaryKey(),
                'number'        => $this->string(), // There is the string type because a number can be with "+" symbol
                'contact_id'    => $this->integer()->notNull(),
                'description'   => $this->text(),
            ]
        );

        /*
         * Create index by 'contact_id' 
         */
        $this->createIndex(
            'idx-numbers-contact_id',
            'Numbers',
            ['contact_id']
        );

         /*
          * Fill out the tables with some data
          */
         $this->fillOutDb();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('Contacts');
        $this->dropTable('Numbers');
    }

    /*
     * Insert data to Contacts and Numbers tables. Just for showing reason.
     */
    public function fillOutDb()
    {
        /* Fill out the Contacts table. BatchInsert is a good idea for that */
        $this->batchInsert('Contacts', ['name', 'surname', 'description'], self::InitialContacts);

        /* Prepare array for batchInsert request at first */
        $list = [];
        foreach(self::InitialPhoneNumbers as $name => $numbers){
            $query = new \yii\db\Query();
            $contact_id = $query->select('id')->from('Contacts')->where(['name' => $name])->one();
            foreach($numbers as $number){
                $list[] = ['number' => $number, 'contact_id' => $contact_id['id']];
            }
        }

        /* Fill out the Numbers table */
        $this->batchInsert('Numbers', ['number', 'contact_id'],  $list);
    }
}
