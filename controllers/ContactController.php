<?php

namespace app\controllers;

use Yii;
use app\models\Contact;
use app\models\ContactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\models\Number;
use app\models\Model;
use yii\data\ArrayDataProvider;


/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $contact = new Contact();
        $list = $contact->listAll();
        return $this->render('index', compact('list', 'contact'));
    }

    /**
     * Displays a single Contact model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $contact = $this->findModel($id);
        $numbers = $contact->numbers;
        $list = new ArrayDataProvider(['allModels' => $numbers, 'key' => 'id',  'pagination' => false]);

        return $this->render('view', compact('contact', 'list'));
    }

    /**
     * Creates a new Contact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $contact = new Contact();
        $number = new Number();
        $numbers = [$number];

        if ($contact->load(Yii::$app->request->post())) {

            //forming multiple models
            list($deletedIDs, $numbers) = $contact->buildMultiple($numbers, $number);

            // ajax validation
            if (Yii::$app->request->isAjax) {
              Yii::$app->response->format = Response::FORMAT_JSON;
              return $contact->mergeAllArray($numbers, $number);
            }
                error_log(print_r($numbers, true));

            // validate all models
            if (Model::validateMultiple($numbers) && $contact->validate()) {
                $contact->saveContactAndNumbers($numbers, $deletedIDs, $number);
                Yii::$app->session->setFlash('info', "$contact->name has been created successfully!");
                return $this->redirect(['view', 'id' => $contact->id]);
            }
        }

        return $this->render('_form', compact('contact', 'numbers'));

    }

    /**
     * Updates an existing Contact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $contact = $this->findModel($id);
        $number = new Number();
        $numbers = $contact->numbers;

        if ($contact->load(Yii::$app->request->post())) {

            //forming multiple models
            list($deletedIDs, $numbers) = $contact->buildMultiple($numbers, $number);

            // ajax validation
            if (Yii::$app->request->isAjax) {
              Yii::$app->response->format = Response::FORMAT_JSON;
              return $contact->mergeAllArray($numbers, $number);
            }
                error_log(print_r($numbers, true));

            // validate all models
            if (Model::validateMultiple($numbers) && $contact->validate()) {
                $contact->saveContactAndNumbers($numbers, $deletedIDs, $number);
                Yii::$app->session->setFlash('info', "$contact->name has been updated successfully!");
                return $this->redirect(['view', 'id' => $contact->id]);
            }
        }

        $numbers = (empty($numbers)) ? [$number] : $numbers;

        return $this->render('_form', compact('contact', 'numbers'));
    }

    /**
     * Deletes an existing Contact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('info', "It has been deleted successfully!");

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($contact = Contact::findOne($id)) !== null) {
            return $contact;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
