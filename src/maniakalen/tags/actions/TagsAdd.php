<?php


namespace maniakalen\tags\actions;


use maniakalen\tags\models\TagsTables;
use yii\base\Action;
use yii\base\ErrorException;
use yii\web\Response;

class TagsAdd extends Action
{
    /**
     * @param $id
     * @param $table
     * @return array
     * @throws ErrorException
     */
    public function run($id, $table)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $post = \Yii::$app->request->post();

        $tag = isset($post['tag'])?$post['tag']:null;
        if (!$tag) {
            throw new ErrorException("No tag provided");
        }

        $tag_record = \maniakalen\tags\models\Tags::findTag($tag);
        if (!$tag_record) {
            $tag_record = \maniakalen\tags\models\Tags::registerTag($tag);
        }

        if ($registry = TagsTables::registerTag($tag_record->id, $id, $table)) {
            return ['message' => 'Tag registered successfully'];
        }

        return ['message' => 'Tag failed'];
    }
}