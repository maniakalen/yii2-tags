<?php


namespace maniakalen\tags\migrations;

use yii\db\Migration;

class M200226_121010_Tags_system extends Migration
{
    public function safeUp()
    {
        try {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this->createTable('tags', [
                'id' => $this->primaryKey(),
                'tag' => $this->string()
            ], $tableOptions);

            $this->createTable('tags_tables', [
                'id' => $this->primaryKey(),
                'tag_id' => $this->integer(),
                'table_name' => $this->string(),
                'table_item_id' => $this->integer()
            ], $tableOptions);

            $this->createIndex('idx_table_item_id', 'tags_tables', 'table_item_id', false);
            $this->addForeignKey('idx_fk_table_tag_ids', 'tags_tables', 'tag_id', 'tags', 'id', 'CASCADE', 'CASCADE');
        } catch (\Exception $e) {
            return false;
        }
        return true;

    }

    public function safeDown()
    {
        try {
            $this->dropIndex('idx_table_item_id', 'tags_tables');
            $this->dropForeignKey('idx_fk_table_tag_ids', 'tags_tables');
            $this->dropTable('tags_tables');
            $this->dropTable('tags');
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}