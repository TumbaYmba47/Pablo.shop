<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Good;
use app\models\Order;
use app\models\OrderGood;
use yii\web\Controller;
use Yii;

class CartController extends Controller
{
    public function actionOpen(){
        $session = Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart', compact('session'));
    }
    public function actionAdd($id)
    {
        $goods = new Good();
        $good = $goods->getOneGoods($id);
        $session = Yii::$app->session;
        $session->open();
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
    public function actionOrder(){
        $session = Yii::$app->session;
        $session->open();
        $order = new Order;
        if ($order->load(Yii::$app->request->post())) {
            $order->date = date('Y-m-d H:i:s');
            $order->sum = $session['cart.totalSum'];
            if ($order->save()) {
                Yii::$app->mailer->compose()
                    ->setFrom(['aa@aa' => ' test test'])
                    ->setTo('asas@ascasc.ru')
                    ->setSubject('ваш заказ принят')
                    ->send();
                $session->remove('cart');
                $session->remove('cart.totalQ');
                $session->remove('cart.totalSum');
                return $this->render('success', compact('session'));
            }
        }
        $this->layout = 'empty-layout';
        return $this->render('order', compact('session' , 'order'));
    }
}