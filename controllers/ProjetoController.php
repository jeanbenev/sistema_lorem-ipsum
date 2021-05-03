<?php

namespace app\controllers;

use Yii;
use app\models\Projeto;
use app\models\Equipe;
use app\models\ProjetoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjetoController implements the CRUD actions for Projeto model.
 */
class ProjetoController extends Controller
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
                    'CalcularRetornoInvestimento' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Projeto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjetoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projeto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Projeto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projeto();
        if($model->load(Yii::$app->request->post())){
            $transaction = Projeto::getDb()->beginTransaction();
            try {
                if($model->save()){
                    foreach($model->participantes as $id_participante){
                        $equipe = new Equipe;
                        $equipe->data_cadastro = date("Y-m-d H:i:s");
                        $equipe->fk_id_projeto = $model->id_projeto;
                        $equipe->fk_id_participante = $id_participante;
                        $equipe->save();
                    }
                    if($transaction->commit()){
                        return $this->redirect(['view', 'id' => $model->id_projeto]);
                    }
                }
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch(\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_projeto]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @uses Usada para a funcionalidade de Simular um Investimento
     */
    public function actionSimularInvestimento($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'simular_investimento';
        $feedback = ['status'=>'info', 'mensagem'=>''];
        if(Yii::$app->request->post()){
            if($model->load(Yii::$app->request->post())){
                if((int)$model->valor_investimento_simulacao<$model->valor_projeto){
                    $feedback['status'] = "danger";
                    $feedback['mensagem'] = "O cálculo de retorno do investimento deve levar em consideração o risco e valor que será investido";
                }elseif($model->risco == 0){
                    $feedback['status'] = "success";
                    $feedback['mensagem'] = "O valor de retorno do projeto é de 5%: ".($model->formatarValorReal($model->valor_investimento_simulacao*0.05));
                }elseif($model->risco == 1){
                    $feedback['status'] = "success";
                    $feedback['mensagem'] = "O valor de retorno do projeto é de 10%: ".($model->formatarValorReal($model->valor_investimento_simulacao*0.10));
                }elseif($model->risco == 2){
                    $feedback['status'] = "success";
                    $feedback['mensagem'] = "O valor de retorno do projeto é de 20%: ".($model->formatarValorReal($model->valor_investimento_simulacao*0.20));
                }
            }
        }
        return $this->renderAjax('simularinvestimento', [
            'model' => $model,
            'feedback' => $feedback,
        ]);
    }

    /**
     * Updates an existing Projeto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            try {
                foreach($model->equipes as $equipe){
                    $equipe->delete();
                }
                foreach($model->participantes as $id_participante){
                    $equipe = new Equipe;
                    $equipe->data_cadastro = date("Y-m-d H:i:s");
                    $equipe->fk_id_projeto = $model->id_projeto;
                    $equipe->fk_id_participante = $id_participante;
                    $equipe->save();
                }
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id_projeto]);
                }

            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch(\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Projeto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $projeto = $this->findModel($id);
        try {
            foreach($projeto->equipes as $equipe){
                $equipe->delete();
            }
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        $projeto->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Projeto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projeto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projeto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
