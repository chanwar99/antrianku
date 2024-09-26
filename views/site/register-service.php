<?php
/** @var yii\web\View $this */
/** @var app\models\Service $service */

use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;

$this->title = Html::encode($service->name);
?>

<div class="site-register-service">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?= Html::encode($service->name) ?></h1>
        <p class="lead">Rp <?= number_format($service->price, 0, ',', '.') ?></p>
        <p class="lead"><?= Html::encode($service->description) ?></p>
    </div>

    <div class="body-content mt-4">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success">
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Antrian Sekarang</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($currentQueue): ?>
                            <div class="alert alert-info">
                                Nomor antrian sekarang: <strong><?= Html::encode($currentQueue->queue_number) ?></strong>
                                (Status: <strong><?= Html::encode($currentQueue->queue_status) ?></strong>)
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                Tidak ada antrian yang sedang diproses saat ini.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Jumlah Antrian Menunggu</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            Jumlah antrian yang menunggu: <strong><?= Html::encode($waitingQueueCount) ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= Html::button('Ambil Antrian', [
            'class' => 'btn btn-primary',
            'data-bs-toggle' => 'modal',
            'data-bs-target' => '#confirmModal'
        ]) ?>

        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Ambil Antrian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin mengambil antrian untuk layanan
                        <strong><?= Html::encode($service->name) ?></strong>?
                    </div>
                    <div class="modal-footer">
                        <?= Html::button('Batal', [
                            'class' => 'btn btn-secondary',
                            'data-bs-dismiss' => 'modal'
                        ]) ?>
                        <?= Html::beginForm(['site/take-queue', 'serviceId' => $service->id, 'merchantId' => $service->merchant_id], 'post', ['id' => 'takeQueueForm']) ?>
                        <?= Html::submitButton('Ambil Antrian', ['class' => 'btn btn-primary']) ?>
                        <?= Html::endForm() ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>