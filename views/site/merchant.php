<?php
/** @var yii\web\View $this */
/** @var array $merchants */
/** @var string $searchTerm */

use yii\bootstrap5\Html;

$this->title = 'Daftar Merchant';
?>

<div class="merchant-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?= Html::encode($this->title) ?></h1>
        <p class="lead">Hasil pencarian untuk: <?= Html::encode($searchTerm) ?></p>
    </div>

    <div class="body-content mt-4">
        <div class="row">
            <?php if (empty($merchants)): ?>
                <div class="alert alert-warning">
                    Tidak ada merchant ditemukan.
                </div>
            <?php else: ?>
                <?php foreach ($merchants as $merchant): ?>
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><?= Html::encode($merchant->name) ?></h5>
                                <p class="card-text"><?= Html::encode($merchant->location) ?></p>
                                <p class="card-text">
                                    <?php foreach ($merchant->merchantCategories as $category): ?>
                                        <?= Html::encode($category->category->name) ?>
                                    <?php endforeach; ?>
                                </p>
                                <?= Html::a('Detail Merchant', ['site/merchant', 'id' => $merchant->id], ['class' => 'btn btn-outline-primary']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div>