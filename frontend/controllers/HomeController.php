<?phpnamespace frontend\controllers;use Yii;use frontend\base\BaseFrontController;//主页控制器class HomeController extends BaseFrontController{    //首页    public function actionIndex() {        return $this->render('index');    }}