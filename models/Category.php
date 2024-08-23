<?
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
class Category extends ActiveRecord{
    public static function tableName()
    {
        return 'category';
    }

    public function getAllCategory ()
    {
        $category = Yii::$app->cache->get('category');
        if (!$category)
        {
            $category = Category::find()->asArray()->all();
            Yii::$app->cache->set('category', $category, 90);
        }
        return $category;
    }
}