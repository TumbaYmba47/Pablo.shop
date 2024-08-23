<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Good;
use yii\web\Controller;
use Yii;

class CartController extends Controller
{
    public function actionOpen(){
        $session = Yii::$app->session;
        $session->open();
        // $session->remove('cart');
        // $session->remove('cart.totalQ');
        // $session->remove('cart.totalSum');
        return $this->renderPartial('cart', compact('session'));
    }
    public function actionAdd($id)
    {
        $goods = new Good();
        $good = $goods->getOneGoods($id);
        $session = Yii::$app->session;
        $session->open();
        // $session->remove('cart');
        $cart = new Cart();
        $cart->addToCart($good);
        return $this->renderPartial('cart', compact('good', 'session'));
    }
    public function actionClear(){
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.totalQ');
        $session->remove('cart.totalSum');
        return $this->renderPartial('cart', compact('session'));
    }
    public function actionRemove($id){
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->removeToCart($id);
        return $this->renderPartial('cart', compact('session'));
    }
}