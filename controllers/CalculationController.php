<?php
/**
 * Created by PhpStorm.
 * User: ursus
 * Date: 04.08.17
 * Time: 6:35
 */

namespace app\controllers;


use app\models\Calculation;
use app\models\CalculationList;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CalculationController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['delete'],
                ],
            ],
        ];
    }


    public function actionIndex(){
        $model_list = new CalculationList();
        $model_list->load(Yii::$app->request->get());
        $provider = new ActiveDataProvider([
            'query' => $model_list->query(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('list', [
            'model' => $model_list,
            'provider' => $provider
        ]);
    }

    public function actionItem(){
        if(Yii::$app->request->get('id')){
            $model = Calculation::findOne(Yii::$app->request->get('id'));
        }else{
            $model = new Calculation();
        }

        if(Yii::$app->request->post($model->formName())){
            $model->load(Yii::$app->request->post());
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Calculation saved');
                return $this->redirect(Yii::$app->urlManager->createUrl(['calculation/item','id' => $model->id]));
            }
        }
        return $this->render('item', [
            'model' => $model,
            'codes' => $model->codes
        ]);
    }



    public function actionDelete(){
        $model = Calculation::findOne(Yii::$app->request->get('id'));
        if(!$model){
            throw new NotFoundHttpException('calculation not found');
        }
        if($model->delete()){
            Yii::$app->session->setFlash('success', 'Calculation deleted');
            return $this->redirect(Yii::$app->urlManager->createUrl(['calculation']));
        }
    }
}