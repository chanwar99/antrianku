<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\Category;
use app\models\Merchant;
use app\models\Service;
use app\models\Queue;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $categories = Category::find()->all();

        return $this->render('index', [
            'categories' => $categories,
        ]);
    }

    public function actionSignup()
    {
        $this->layout = 'auth';

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {

            Yii::$app->session->setFlash('success', 'Registrasi berhasil, silahkan login!. ');

            return $this->redirect(['login']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        $this->layout = 'auth';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionMerchant()
    {
        $searchTerm = Yii::$app->request->get('search', '');
        $merchantId = Yii::$app->request->get('id', null); // Mengambil ID merchant dari request

        if ($merchantId !== null) {
            $merchant = Merchant::findOne($merchantId);

            if (!$merchant) {
                throw new \yii\web\NotFoundHttpException("Merchant tidak ditemukan.");
            }

            return $this->render('merchant-detail', [
                'merchant' => $merchant,
            ]);
        }

        $query = Merchant::find()
            ->joinWith('merchantCategories.category')
            ->andFilterWhere(['like', 'merchants.name', $searchTerm])
            ->orFilterWhere(['like', 'categories.name', $searchTerm]);

        $merchants = $query->all();

        return $this->render('merchant', [
            'merchants' => $merchants,
            'searchTerm' => $searchTerm,
        ]);
    }

    public function actionRegisterService($id)
    {

        $service = Service::findOne($id);
        if (!$service) {
            throw new \yii\web\NotFoundHttpException('Layanan tidak ditemukan.');
        }

        // Ambil nomor antrian yang sedang "processing"
        $currentQueue = Queue::find()
            ->where(['service_id' => $id, 'queue_status' => 'processing'])
            ->orderBy(['created_at' => SORT_ASC])
            ->one();

        // Ambil jumlah antrian dengan status "waiting"
        $waitingQueueCount = Queue::find()
            ->where(['service_id' => $id, 'queue_status' => 'waiting'])
            ->count();

        return $this->render('register-service', [
            'service' => $service,
            'currentQueue' => $currentQueue,
            'waitingQueueCount' => $waitingQueueCount,
        ]);
    }

    public function actionTakeQueue($serviceId, $merchantId)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $service = Service::findOne($serviceId);
        if (!$service) {
            throw new \yii\web\NotFoundHttpException('Layanan tidak ditemukan.');
        }

        // Mendapatkan nomor antrian berikutnya
        $lastQueue = Queue::find()
            ->where(['service_id' => $serviceId])
            ->orderBy(['queue_number' => SORT_DESC])
            ->one();

        $nextQueueNumber = $lastQueue ? $lastQueue->queue_number + 1 : 1; // Jika tidak ada antrian, mulai dari 1
        $statusMsg = $lastQueue ? 'waiting' : 'processing';

        // Buat entri antrian baru
        $queue = new Queue();
        $queue->service_id = $serviceId;
        $queue->merchant_id = $merchantId;
        $queue->user_id = Yii::$app->user->id;
        $queue->queue_number = $nextQueueNumber;
        $queue->queue_status = $statusMsg;
        $queue->created_at = date('Y-m-d H:i:s');

        if ($queue->save()) {
            Yii::$app->session->setFlash('success', 'Anda baru saja mengambil antrian. Nomor antrian Anda: <b>' . $nextQueueNumber . '</b>');
        }

        return $this->redirect(['site/register-service', 'id' => $serviceId]);
    }

    public function actionMyQueue()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $userId = Yii::$app->user->id;

        $queues = Queue::find()
            ->where(['user_id' => $userId])
            ->with(['service', 'merchant'])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('my-queue', [
            'queues' => $queues,
        ]);
    }
}
