<?php


namespace maniakalen\tags\models;


use yii\db\ActiveRecord;

class TagsTables extends ActiveRecord
{
    public static function tableName()
    {
        return 'tags_tables';
    }

    public function rules()
    {
        return [
            [['tag_id'], 'integer'],
            [['table_item_id'], 'integer'],
            [['table_name'], 'string', 'max' => 255]
        ];
    }

    public static function registerTag($tag_id, $item_id, $table)
    {
        try {
            $registry = \Yii::createObject([
                'class' => static::class,
                'tag_id' => $tag_id,
                'table_item_id' => $item_id,
                'table_name' => $table
            ]);

            if ($registry->save()) {
                return $registry;
            }

            return false;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage(), 'tags');
            return false;
        }
    }

    public static function deleteEntry($tag, $item_id, $table)
    {
        $item = static::find()
            ->select('tt.id')
            ->from(['tt' => static::tableName()])
            ->innerJoin(['t' => Tags::tableName()], 'tt.tag_id = t.id')
            ->where(['t.tag' => $tag, 'tt.table_item_id' => $item_id, 'tt.table_name' => $table])->one();
        return static::deleteAll(['id' => $item->id]);
    }
}