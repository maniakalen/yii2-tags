<?php


namespace maniakalen\tags\actions;

use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class Tags extends Action
{
    public function run($id, $table)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $tags = \maniakalen\tags\models\Tags::fetchTags($id, $table);
        return ArrayHelper::map($tags, 'id', 'tag');
    }
}