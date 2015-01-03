<?php
/**
 *
 * 会员登录后只能够查看自己的挂帐单信息喝修改密码
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/18
 * Time: 下午3:22
 */

/**
 * Class MemberController
 * @property User $_user
 */
class MemberController extends Controller{

    public $layout="admin_tpl_right";
    protected  $_user;


    function init(){
        parent::init();
        if(Yii::app()->user->isGuest){
            $this->redirect('/login');
        }elseif(Yii::app()->user->role!=2){
            $this->redirect('/site');
        }
        $this->_user = $this->getUserInfo();

        $this->controlName = "挂帐信息";
        $this->actionName = "挂帐信息";
    }



    function actionTop(){
        $this->layout = "login";

        $this->render('/site/top');
    }
    /**
     *
     */
    function actionLeft(){
        $this->layout="admin_tpl_left";
        $this->render('left');
    }

    function actionRight(){
        $this->redirect($this->createUrl('list'));
    }


    function actionTpl(){
        $this->layout = "admin_tpl";
        $this->breadcrumbs=null;
        $this->render('index');
    }

    function actionIndex(){

        $this->layout = "admin_tpl";
        $this->breadcrumbs=null;
        $this->render('index');
        die();

    }

    function actionList(){
        $companyId = $this->_user->company;
        //die();
        $model = new YearForm();
        if(isset($_POST['YearForm'])){
            $model->attributes = $_POST['YearForm'];
        }
        $searchYear  = $model->year;
        if(!$searchYear){
            $searchYear = $model->year = date('Y',time());
        }
       // echo $searchYear;
        $companyInfo = Company::model()->findByPk($companyId);
        $companyCode = $companyInfo->code_id;

        $this->actionName = $companyInfo->company . $searchYear . "年度列表";

        $monthStart = $searchYear.'01';
        $monthEnd   = $searchYear.'12';

        //$cacheKey   = 'monthArray_userId_'.Yii::app()->user->id.'_month_'.$searchYear;
        //$cacheKey = Yii::app()->cache->get($cacheKey);

        //var_dump($cacheValue);die();
        //if(!$cacheValue) {
            $monthArray = array();
            for ($monthStart = $searchYear . '01', $monthEnd = $searchYear . '12'; $monthStart <= $monthEnd; $monthStart++) {
                $dataBasic = DataBasic::model()->find('company_code=:company_code and month=:month',array(':company_code'=>$companyCode,':month'=>$monthStart));
                $dataExtension = DataExtension::model()->find('company_code=:company_code and month=:month',array(':company_code'=>$companyCode,':month'=>$monthStart));

                $basic = $dataBasic ? CHtml::link("查看",array("/member/basic","company_code"=>$companyInfo->code_id,"month"=>$monthStart)) : '未挂帐';
                $extension = $dataExtension ? CHtml::link("查看",array("/member/extension","company_code"=>$companyInfo->code_id,"month"=>$monthStart)) : '未挂帐';
                $monthArray[$monthStart] =  array('basic'=>$basic,'extension'=>$extension);
            }
          //  Yii::app()->cache->set($cacheKey,$monthArray,600);
        //}else{
          //  $monthArray = $cacheValue;
        //}

        //YiiBase::app()->get
        Yii::app()->clientScript->registerCoreScript('jquery');
        $renderData = array(
            'companyInfo'=>$companyInfo,
            'year'=>$searchYear,
            'monthArray'=>$monthArray,
            'model'=>$model
        );

        $this->render('list',$renderData);
    }

    function actionBasic(){
        $companyId = $this->_user->company;
       // $this->daduan();
        $companyInfo = Company::model()->findByPk($companyId);
        $companyCode = $companyInfo->code_id;
        $month       = YiiBase::app()->request->getParam('month');

        $dataDebts = new DataDebts();
        $data = $dataDebts->getBasicData($companyCode,$month);

        $this->actionName= $companyInfo->company . $month ."基础挂账单";
        $renderData = array(
            //    'debtsData'=>$varData,
            'company'=>$companyInfo,
        //    'dataProvider'=>$dataProvider,
            'dataProvider'=>$data['dataProvider'],
            'total'=>$data['total']
        );
        $this->render('/data/basic',$renderData);
    }
    function actionExtension(){
        $companyId = $this->_user->company;
        $companyInfo = Company::model()->findByPk($companyId);

        $companyCode = $companyInfo->code_id;
        $month       = YiiBase::app()->request->getParam('month');

        $criteria = new CDbCriteria();
        //  $varData = Data::model()->findAll('company_code=:company_code and month=:month',array(':company_code'=>$companyCode,':month'=>$month));


        $criteria->addCondition('company_code=:company_code and month=:month');
        $criteria->params=array(':company_code'=>$companyCode,':month'=>$month);
        $dataProvider = new CActiveDataProvider('Data',array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>10),
            'sort'=>array('defaultOrder'=>'id desc')
        ));
        $dataDebts = new DataDebts();
        $data = $dataDebts->getExtensionData($companyCode,$month);

        $this->actionName= $companyInfo->company . $month ."基础挂账单";
        $renderData = array(
            //    'debtsData'=>$varData,
            'company'=>$companyInfo,
            //'dataProvider'=>$dataProvider
            'dataProvider'=>$data['dataProvider'],
            'total'=>$data['total']
        );

        $this->render('/data/extension',$renderData);
    }
    function actionPassword(){
        $model = new PasswordForm();

        if(isset($_POST['ajax']))
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['PasswordForm'])){
            $model->attributes = $_POST['PasswordForm'];
            $model->userId = Yii::app()->user->id;


            if($model->validate()&&$model->updatePassword()){
                Yii::app()->user->setFlash('passwordSubmitted','修改成功');
                Controller::refresh();
            }else{
                Yii::app()->user->setFlash('passwordSubmitted','修改失败');
                return $model->getErrors();
            }
        }

        $renderData = array('model'=>$model);
        $this->layout ='admin_tpl_right';
        $this->actionName = "修改密码";
        $this->render('password',$renderData);
    }

    function actionLogout(){
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    function daduan(){
        echo time();
        die();
    }
}