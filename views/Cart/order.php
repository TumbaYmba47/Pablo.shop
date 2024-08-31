<?
use yii\widgets\ActiveForm;
?>
<div class="modal-header">
    <h2 style="text-align: center">Оформление заказа</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div style="padding: 2%;">

    <?$form = ActiveForm::begin()?>
    
    <?=$form->field($order, 'name')?>
    <?=$form->field($order, 'email')?>
    <?=$form->field($order, 'phone')?>
    <?=$form->field($order, 'address')?>
        <div class="modal-buttons" style="display: flex; padding: 15px; justify-content: space-around">
            <button class="btn btn-success">Оформить заказ</button>
        </div>


    <? ActiveForm::end() ?>
</div>