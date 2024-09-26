<?php
/** @var yii\web\View $this */
/** @var app\models\Queue[] $queues */

use yii\bootstrap5\Html;

$this->title = 'My Queue';
?>

<div class="site-my-queue">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="body-content mt-4">
        <?php if (empty($queues)): ?>
            <div class="alert alert-warning">
                Anda belum memiliki antrian.
            </div>
        <?php else: ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Antrian</th>
                        <th>Layanan</th>
                        <th>Merchant</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($queues as $queue): ?>
                        <tr>
                            <td>
                                <span class="badge bg-primary">
                                    <?= Html::encode($queue->queue_number) ?>
                                </span>
                            </td>
                            <td><?= Html::encode($queue->service->name) ?></td>
                            <td><?= Html::encode($queue->merchant->name) ?></td>
                            <td>
                                <?php
                                switch ($queue->queue_status) {
                                    case 'waiting':
                                        $badgeClass = 'bg-warning';
                                        break;
                                    case 'processing':
                                        $badgeClass = 'bg-info';
                                        break;
                                    case 'completed':
                                        $badgeClass = 'bg-success';
                                        break;
                                }
                                ?>
                                <span class="badge <?= $badgeClass ?>">
                                    <?= Html::encode(ucfirst($queue->queue_status)) ?>
                                </span>
                            </td>
                            <td><?= Yii::$app->formatter->asDatetime($queue->created_at, 'php:d-m-Y H:i') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</div>