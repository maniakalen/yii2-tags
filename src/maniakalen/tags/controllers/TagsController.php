<?php


namespace maniakalen\tags\controllers;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class TagsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['tags'],
                        'allow' => true,
                        'roles' => [],
                    ],
                    [
                        'actions' => ['tags-add', 'tags-edit', 'tags-delete'],
                        'allow' => true,
                        'roles' => ['maniakalen/tags/manage'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'tags-add' => ['post'],
                    'tags-edit' => ['post'],
                    'tags-delete' => ['delete']
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'tags' => ['class' => 'maniakalen\tags\actions\Tags'],
            'tags-add' => ['class' => 'maniakalen\tags\actions\TagsAdd'],
            'tags-edit' => ['class' => 'maniakalen\tags\actions\TagsEdit'],
            'tags-delete' => ['class' => 'maniakalen\tags\actions\TagsDelete']
        ];
    }
}