<?
namespace app\widgets;

use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $data;
    public function run()
    {
        $this->data = new Category();
        $this->data = $this->data->getAllCategory();
        $this->data = $this->categoryToTamplate($this->data);
        return $this->data;
    }
    public function categoryToTamplate($data){
        include __DIR__.'/tamplate/Menu.php';
    }
}