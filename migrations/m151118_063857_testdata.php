<?php

use yii\db\Schema;
use yii\db\Migration;

class m151118_063857_testdata extends Migration
{
    public function up()
    {
        $test_data = [
            '1' => [
                'firstname' => 'Роберт',
                'lastname' => 'Хайнлайн',
            ],
            '2' => [
                'firstname' => 'Гарри',
                'lastname' => 'Гаррисон',
            ],
            '3' => [
                'firstname' => 'Айзек',
                'lastname' => 'Азимов',
            ],
            '4' => [
                'firstname' => 'Роберт',
                'lastname' => 'Асприн',
            ],
            '5' => [
                'firstname' => 'Роджер',
                'lastname' => 'Желязны',
            ],
        ];
        foreach($test_data as $value) {
            $this->insert('authors', $value);
        }
    }

    public function down()
    {
        $this->truncateTable('authors');
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
