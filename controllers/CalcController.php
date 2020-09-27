<?php


namespace app\controllers;

use app\models\CalcForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\widgets\ActiveForm;

class CalcController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Калькулятор
     *
     * @return string
     */
    public function actionCalc()
    {
        $total = 0;
        $str = '';

        /** @var CalcForm $calc */
        $calc = new CalcForm();
        if (Yii::$app->request->isAjax && ($calc->load(Yii::$app->request->post()))) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($calc);
        }

        /** @var CalcForm $calc */
        if ($calc->load(Yii::$app->request->post())) {

            if ($calc->myOperation === 'plus') {
                $total = $calc->number1 + $calc->number2;
            } elseif ($calc->myOperation === 'minus') {
                $total = $calc->number1 - $calc->number2;
            } elseif ($calc->myOperation === 'times') {
                $total = $calc->number1 * $calc->number2;
            } elseif ($calc->myOperation === 'divided by') {
                if (!$calc->number2 == 0) {
                    $total = $calc->number1 / $calc->number2;
                }
            }

            if (($calc->myOperation === 'divided by') && ($calc->number2 == 0)) {
                $str = "Нельзя делить на ноль!";
            } else {
                $str = "<h1> $calc->number1 $calc->myOperation $calc->number2 = $total</h1>";
            }
        }

        return $this->render('index', [
            'model' => $calc,
            'total' => $total,
            'str' => $str
        ]);
    }

}