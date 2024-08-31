<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>
    <h3>Ваш заказ №<?=$order->id?> принят</h3>
    <div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th style="padding: 8px; border: 1px solid #ddd">Наименование</th>
            <th style="padding: 8px; border: 1px solid #ddd">Количество</th>
            <th style="padding: 8px; border: 1px solid #ddd">Цена</th>
            <th style="padding: 8px; border: 1px solid #ddd">Сумма</th>
        </tr>
        </thead>
        <tbody>
            <?foreach ($session['cart'] as $goods=>$good){?>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd"><?=$good['name']?></td>
                <td style="padding: 8px; border: 1px solid #ddd"><?=$good['goodQ']?></td>
                <td style="padding: 8px; border: 1px solid #ddd"><?=$good['price']?> рублей</td>
                <td style="padding: 8px; border: 1px solid #ddd"><?=$good['price']*$good['goodQ']?> рублей</td>
            </tr>
            <?}?>
        <tr>
            <td colspan="3">Итого:</td>
            <td><?=$session['cart.totalQ']?> шт</td>
        </tr>
        <tr>
            <td colspan="3">На сумму:</td>
            <td><b><?=$session['cart.totalSum']?></b> рублей</td>
        </tr>
        </tbody>
    </table>
</div><div id="js-atavi-extension-install"></div><div id="target_kultivator_ico" data-ico="chrome-extension://ailgcbdikiapkcbglcpfippolmjfljgi/images/ico.png" style="display: none;"></div></body></html>