<?php

use yii\db\Schema;
use yii\db\Migration;

class m151113_042051_books extends Migration
{
    public function up()
    {
        $this->createTable('books',[
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
            'date_create' => Schema::TYPE_DATE.' NOT NULL',
            'date_update' => Schema::TYPE_DATE.' NOT NULL',
            'preview' => Schema::TYPE_TEXT.' NOT NULL',
            'date' => Schema::TYPE_DATE.' NOT NULL',
            'author_id' => Schema::TYPE_INTEGER.' NOT NULL',
        ]);
        $this->createTable('authors', [
            'id' => Schema::TYPE_PK,
            'firstname' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
            'lastname' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
        ]);
        $this->addForeignKey( 'authors', 'books', 'author_id', 'authors', 'id');
    }

    public function down()
    {
        $this->dropTable('books');
        $this->dropTable('authors');
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
