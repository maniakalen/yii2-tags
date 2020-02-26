<?php


namespace maniakalen\tags\actions;

use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class TagsSearch extends Action
{
    public function run($search = '')
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $tags = \maniakalen\tags\models\Tags::searchTags($search);
        return ArrayHelper::map($tags, 'id', 'tag');
    }
}