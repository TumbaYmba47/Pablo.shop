<?php

namespace app\controllers;

use app\models\Good;
use yii\web\Controller;
use Yii;

class GoodController extends Controller
{
    public function actionIndex($id)
    {
        $goods = new Good();
        $good = $goods->getOneGoods($id);
        return $this->render('index', compact('good'));
    }
}