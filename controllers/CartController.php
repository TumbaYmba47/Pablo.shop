<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Good;
use app\models\Order;
use app\models\OrderGood;
use yii\helpers\Url;
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
       if (!$session['cart.totalSum']){
           return $this->render('success', compact('session'));
        }
        $order = new Order;
        if ($order->load(Yii::$app->request->post())) {
            $order->date = date('Y-m-d H:i:s');
            $order->sum = $session['cart.totalSum'];
            if ($order->save()) {
                $session['ordId'] = $order->id;
                $this->saveOrderInfo($session['cart'], $session['ordId']);
                Yii::$app->mailer->compose('order', ['session' => $session , 'order' => $order])
                ->setFrom(['jonescarri4@gmail.com' => 'Магазин пенисов'])
                ->setTo($order->email)
                ->setSubject('ваш заказ принят')
                ->send();
                $session->remove('cart');
                $session->remove('cart.totalQ');
                $session->remove('cart.totalSum');
                $this->refresh();
                return $this->render('success', compact('session' , $session['ordId']));
            }
        }
        $this->layout = 'empty-layout';
        return $this->render('order', compact('session' , 'order'));
    }

    protected function saveOrderInfo($goods, $orderId){
        foreach ($goods as $id=>$good){
            $orderInfo = new OrderGood();
            $orderInfo->order_id = $orderId;
            $orderInfo->product_id = $id;
            $orderInfo->name = $good['name'];
            $orderInfo->price = $good['price'];
            $orderInfo->quantity = $good['goodQ'];
            $orderInfo->sum = $good['price'] * $good['goodQ'];
            $orderInfo->save();
        }

    }
}