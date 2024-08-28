<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <link rel="icon" href="/img/zalupa.ico">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<section class="body">
    <header>
        <div class="container">
            <div class="header">
                <a href="/">На главную</a>
                <a href="#">Вход в админку</a>
                <a class="cart" data-toggle="modal" data-target=".bd-example-modal-xl">Корзина <span class="menuQ">(<?=$_SESSION['cart.totalQ'] ? $_SESSION['cart.totalQ'] : 0?>)</span></a>
                <form action="<?=Url::to('/category/search')?>" method="get">
                    <input type="text" style="padding: 5px" placeholder="Поиск..." name="search" required>
                </form>
            </div>
        </div>
    </header>
<div class="conteiner">

    <?= $content;?>
    
</div>
<footer>
        <div class="container">
            <div class="footer">
                &copy; Все права защищены или типа того
            </div>
        </div>
    </footer>
</section>
<!-- Modal -->
<div id="cart" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    </div>
  </div>
</div>
<div id="order" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      </div>
  </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
