<?php
/** @var yii\web\View $this */
/** @var array $categories */

use yii\bootstrap5\Html;

$this->title = 'Beranda';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Selamat Datang di Antrianku!</h1>
        <p class="lead">Pilih Kategori</p>
    </div>

    <div class="body-content">
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($category->name) ?></h5>
                            <?= Html::beginForm(['site/merchant'], 'get', ['class' => 'd-inline']) ?>
                            <?= Html::hiddenInput('search', $category->name) ?>
                            <?= Html::submitButton('Cari Merchant', ['class' => 'btn btn-outline-primary']) ?>
                            <?= Html::endForm() ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>