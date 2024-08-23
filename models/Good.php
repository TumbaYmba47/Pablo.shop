<?

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Good extends ActiveRecord
{
    public static function tableName()
    {
        return 'good';
    }
    public function getAllGoods(){
        $goods = Yii::$app->cache->get('goods');
        if (!$goods)
        {
            $goods = Good::find()->asArray()->all();
            Yii::$app->cache->set('goods', $goods, 90);
        }
        return $goods;
    }
    public function getGoodsCategories($id){
        $goods = Good::getAllGoods();
        foreach ($goods as $good){
            if ($good['category'] == $id){
                $catGoods[]=$good;
            }
        }
        return $catGoods;
    }
    public function getSearchResults($search){
        $goods = Good::getAllGoods();
        foreach ($goods as $good){
            if (preg_match("/$search/iu", $good['name'])){
                $searchResults[] = $good;
            }
        }
        return $searchResults;
        // $searchResults = Good::find()->where(['like','name', $search])->asArray()->all();
        // return $searchResults;
    }
    public function getOneGoods($id){
        $goods = Good::getAllGoods();
        foreach ($goods as $good){
            if ($good['id'] == $id){
                return $good;
            }
        }
    }
}