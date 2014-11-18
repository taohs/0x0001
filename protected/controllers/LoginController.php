<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/6
 * Time: 下午10:33
 */

class LoginController extends Controller {

    public $layout = '//layouts/login';
    /**
     * 登录页
     */
    function actionIndex(){
        //echo time();
        $model = new LoginForm();

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect('/site/index');
               // $this->redirect(Yii::app()->user->returnUrl);
        }


        $this->render('index',array('model'=>$model));
    }

    /**
     * 登录处理页
     */
    function actionLogin(){}

    /**
     * logout page
     */
    function actionLogout(){}

} 