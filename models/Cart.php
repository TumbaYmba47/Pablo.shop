<?
namespace app\models;
use Yii;
use yii\db\ActiveRecord;
class Cart extends ActiveRecord{
    public function addToCart($good){
        if(isset($_SESSION['cart'][$good['id']]) ){
            $_SESSION['cart'][$good['id']]['goodQ'] += 1;
        }
        else{
            $_SESSION['cart'][$good['id']] = [
                'goodQ' => 1,
                'name' => $good['name'],
                'price' => $good['price'],
                'img' => $good['img'],
            ];
        }
        $_SESSION['cart.totalQ'] = isset($_SESSION['cart.totalQ']) ? $_SESSION['cart.totalQ'] + 1 : 1;
        $_SESSION['cart.totalSum'] = isset($_SESSION['cart.totalSum']) ? $_SESSION['cart.totalSum'] + $good['price'] : $good['price'];
    }
    public function removeToCart($id){
        $totalQ = $_SESSION['cart'][$id]['goodQ'];
        $_SESSION['cart.totalSum'] -= $_SESSION['cart'][$id]['price'] * $totalQ;
        $_SESSION['cart.totalQ'] -= $totalQ;
        unset($_SESSION['cart'][$id]);


    //     if(isset($_SESSION['cart'][$good['id']]) ){
    //         $_SESSION['cart'][$good['id']]['goodQ'] += 1;
    //     }
    //     else{
    //         $_SESSION['cart'][$good['id']] = [
    //             'goodQ' => 1,
    //             'name' => $good['name'],
    //             'price' => $good['price'],
    //             'img' => $good['img'],
    //         ];
    //     }
    //     $_SESSION['cart.totalQ'] = isset($_SESSION['cart.totalQ']) ? $_SESSION['cart.totalQ'] + 1 : 1;
    //     $_SESSION['cart.totalSum'] = isset($_SESSION['cart.totalSum']) ? $_SESSION['cart.totalSum'] + $good['price'] : $good['price'];
    }
}