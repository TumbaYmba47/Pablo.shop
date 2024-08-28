<html>
<?
if($session['cart.totalQ'] > 0){
?>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body><h2 style="padding: 10px; text-align: center">Корзина</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Фото</th>
            <th scope="col">Наименование</th>
            <th scope="col">Количество</th>
            <th scope="col">Цена</th>
            <th scope="col"></th>
        </tr>
    </thead>

    <tbody>
        <?foreach ($session['cart'] as $id=>$good){ ?>
        <tr>
            <td style="vertical-align: middle" width="150"><img src="/img/<?=$good['img']?>" alt="<?=$good['img']?>"></td>
            <td style="vertical-align: middle"><?=$good['name']?></td>
            <td style="vertical-align: middle"><?=$good['goodQ']?></td>
            <td style="vertical-align: middle"><?=$good['price']*$good['goodQ']?> рублей</td>
            <td class="delete" data-id="<?=$id?>" style="text-align: center; cursor: pointer; vertical-align: middle; color: red">
                <span>✖</span></td>
        </tr>
        <?}?>
        <tr style="border-top: 4px solid black">
            <td colspan="4">Всего товаров</td>
            <td class="total-quantity"><?=$session['cart.totalQ']?></td>
        </tr>
        <tr>
            <td colspan="4">На сумму </td>
            <td style="font-weight: 700"><?=$session['cart.totalSum']?> рублей</td>
        </tr>
    </tbody>

</table>

<div class="modal-buttons" style="display: flex; padding: 15px; justify-content: space-around">
    <button type="button" class="btn btn-danger" onclick="clearCart(event)">Очистить корзину</button>
    <button type="button" class="btn btn-secondary btn-close" data-toggle="modal" data-target=".bd-example-modal-xl">Продолжить покупки</button>
    <button type="button" class="btn btn-success btn-next" onclick="hideCart(event)">Оформить заказ</button>
</div><div id="js-atavi-extension-install"></div><div id="target_kultivator_ico" data-ico="chrome-extension://ailgcbdikiapkcbglcpfippolmjfljgi/images/ico.png" style="display: none;"></div></body></html>

<?}else{?>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<body><h2 style="padding: 10px; text-align: center">В корзине нет товаров</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Фото</th>
            <th scope="col">Наименование</th>
            <th scope="col">Количество</th>
            <th scope="col">Цена</th>
            <th scope="col"></th>
        </tr>
    </thead>

    <tbody>
        <tr style="border-top: 4px solid black">
            <td colspan="4">Всего товаров</td>
            <td class="total-quantity"><?=$session['cart.totalQ']?></td>
        </tr>
        <tr>
            <td colspan="4">На сумму </td>
            <td style="font-weight: 700"><?=$session['cart.totalSum']?> рублей</td>
        </tr>
    </tbody>

</table>

<div class="modal-buttons" style="display: flex; padding: 15px; justify-content: space-around">
    <button type="button" class="btn btn-secondary btn-close" data-toggle="modal" data-target=".bd-example-modal-xl">Начать покупки</button>
</div><div id="js-atavi-extension-install"></div><div id="target_kultivator_ico" data-ico="chrome-extension://ailgcbdikiapkcbglcpfippolmjfljgi/images/ico.png" style="display: none;"></div></body></html>
<?} ?>