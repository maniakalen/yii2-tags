<?php


namespace maniakalen\tags\models;


use yii\db\ActiveRecord;

class Tags extends ActiveRecord
{
    public static function tableName()
    {
        return 'tags';
    }

    public function rules()
    {
        return [
            [['tag'], 'string', 'max' => 255]
        ];
    }

    public static function searchTags($search = '')
    {
        return static::find()
            ->where('MATCH(tag) AGAINST (\'' . $search . '\' IN BOOLEAN MODE)')
            ->all();
    }

    public static function fetchTags($item_id, $table_name)
    {
        return static::find()
            ->from(['t' => static::tableName()])
            ->select(['t.id', 't.tag'])
            ->innerJoin(['tt' => TagsTables::tableName()], 't.id = tt.tag_id')
            ->where(['tt.table_item_id' => $item_id, 'table_name' => $table_name])
            ->all();
    }

    public static function findTag($tag)
    {
        return static::find()
            ->where(['tag' => $tag])
            ->one();
    }

    public static function registerTag($tag)
    {
        try {
            $tag = \Yii::createObject([
                'class' => static::class,
                'tag' => $tag
            ]);
            if ($tag->save()) {
                return $tag;
            }
            return false;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage(), 'tags');
            return false;
        }
    }
}