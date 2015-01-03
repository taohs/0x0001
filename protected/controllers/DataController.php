<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/14
 * Time: 上午1:11
 */

class DataController extends Controller{

    public $layout = "admin_tpl_right";

    public $controlName="挂帐单管理";

    function init(){
        parent::init();
        if(Yii::app()->user->isGuest){
            $this->redirect('/login');
        }elseif(Yii::app()->user->role!=1){
            $this->redirect('/member');
        }
        $this->_user = $this->getUserInfo();
    }
    /**
     * 显示公司全年月份表
     */
    function actionCompany(){
        //echo time();
      //  die();
        $companyCode = YiiBase::app()->request->getParam('company_code');

        $model = new YearForm();
        if(isset($_POST['YearForm'])){
            $model->attributes = $_POST['YearForm'];
        }
        $searchYear  = $model->year;
        if(!$searchYear){
            $searchYear = $model->year = date('Y',time());
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition('`code_id`=:companyCode');
        $criteria->params=array(':companyCode'=>$companyCode);
        $companyInfo = Company::model()->find($criteria);
        $this->actionName = $companyInfo->company . $searchYear . "年度列表";

        $monthStart = $searchYear.'01';
        $monthEnd   = $searchYear.'12';

        $monthArray = array();
        for($monthStart = $searchYear.'01',$monthEnd = $searchYear.'12'; $monthStart<=$monthEnd; $monthStart++){
            $dataBasic = DataBasic::model()->find('company_code=:company_code and month=:month',array(':company_code'=>$companyCode,':month'=>$monthStart));
            $dataExtension = DataExtension::model()->find('company_code=:company_code and month=:month',array(':company_code'=>$companyCode,':month'=>$monthStart));

            $basic = $dataBasic ? CHtml::link("查看",array("/data/basic","company_code"=>$companyInfo->code_id,"month"=>$monthStart)) : '未挂帐';
            $extension = $dataExtension ? CHtml::link("查看",array("/data/extension","company_code"=>$companyInfo->code_id,"month"=>$monthStart)) : '未挂帐';
            $monthArray[$monthStart] =  array('basic'=>$basic,'extension'=>$extension);
            //if(!$dataBasic&&!$dataExtension){
            //    $monthArray[$monthStart] = array('basic'=>'未挂帐','extension'=>'未挂帐');
            //}else{
            //    $monthArray[$monthStart] = array(
            //        'basic'=>CHtml::link("查看",array("/data/basic","company_code"=>$companyInfo->code_id,"month"=>$monthStart)),
            //        'extension'=>CHtml::link("查看",array("/data/extension","company_code"=>$companyInfo->code_id,"month"=>$monthStart)),
            //    );
            //}
        }

        //YiiBase::app()->get
        YiiBase::app()->clientScript->registerCoreScript('jquery');
        $renderData = array(
            'companyInfo'=>$companyInfo,
            'year'=>$searchYear,
            'monthArray'=>$monthArray,
            'model'=>$model
        );
        $this->render('company',$renderData);
    }

    public function actionBasic(){
        $companyCode = YiiBase::app()->request->getParam('company_code');
        $month       = YiiBase::app()->request->getParam('month');


        $dataDebts = new DataDebts();
        $data = $dataDebts->getBasicData($companyCode,$month);

        $companyInfo = Company::model()->find('code_id=:companyCode',array(':companyCode'=>$companyCode));
        $this->actionName= $companyInfo->company . $month ."基础挂账单";
        $renderData = array(
        //    'debtsData'=>$varData,
            'company'=>$companyInfo,
            'dataProvider'=>$data['dataProvider'],
            'total'=>$data['total']
        );
        $this->render('basic',$renderData);
    }
    public function actionExtension(){
        $companyCode = YiiBase::app()->request->getParam('company_code');
        $month       = YiiBase::app()->request->getParam('month');



        $dataDebts = new DataDebts();
        $data = $dataDebts->getExtensionData($companyCode,$month);


        $companyInfo = Company::model()->find('code_id=:companyCode',array(':companyCode'=>$companyCode));
        $this->actionName= $companyInfo->company . $month ."拓展挂账单";
        $renderData = array(
            //    'debtsData'=>$varData,
            'total'=>$data['total'],
            'company'=>$companyInfo,
            'dataProvider'=>$data['dataProvider']
        );
        $this->render('extension',$renderData);
    }
} 