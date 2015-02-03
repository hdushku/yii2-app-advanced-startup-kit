<?php
	namespace backend\controllers;

	use backend\helpers\enums\Configuration as Enum;
	use Yii;
	use yii\filters\AccessControl;
	use yii\web\Controller;

	/**
	 * Site controller
	 */
	class SiteController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'only'  => ['index'],
					'rules' => [
						[
							'actions' => ['index'],
							'allow'   => TRUE,
							'roles'   => ['@'],
						],
					],
				],
			];
		}

		/**
		 * @inheritdoc
		 */
		public function actions()
		{
			return [
				'error' => [
					'class' => 'yii\web\ErrorAction',
				],
			];
		}

		/**
		 * Initiates application setup
		 *
		 * @return string|\yii\web\Response
		 */
		public function actionIndex()
		{
			// Checks if the application has been installed successfully
			if (Yii::$app->config->get(Enum::APP_SECRET) != '' && Yii::$app->params['installed'] === TRUE)
				return $this->render('index');
			else
				return $this->redirect(Yii::$app->urlManager->createUrl('//installer/install/index'));
		}
	}
