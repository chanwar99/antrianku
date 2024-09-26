<?php
/** @var yii\web\View $this */
/** @var app\models\Merchant $merchant */
/** @var app\models\Service[] $services */

use yii\bootstrap5\Html;

$this->title = $merchant->name;
?>

<div class="site-merchant-detail">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?= Html::encode($merchant->name) ?></h1>
        <p class="lead"><?= Html::encode($merchant->location) ?></p>
        <p class="lead"><?= Html::encode($merchant->category) ?></p>
    </div>

    <div class="body-content mt-4">
        <p class="lead">Layanan yang Tersedia:</p>
        <div class="row">
            <?php foreach ($merchant->services as $service): ?>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($service->name) ?></h5>
                            <p class="card-text"><?= Html::encode($service->description) ?></p>
                            <p class="card-text">Rp <?= number_format($service->price, 0, ',', '.') ?></p>
                            <?= Html::a('Lihat Antrian', ['site/register-service', 'id' => $service->id], ['class' => 'btn btn-outline-primary']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>