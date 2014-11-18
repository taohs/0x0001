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

    /**
     * 显示公司全年月份表
     */
    function actionCompany(){
        //echo time();
      //  die();
        $companyCode = YiiBase::app()->request->getParam('company_code');
        $searchYear  = YiiBase::app()->request->getParam('year');
        if(!$searchYear){
            $searchYear = date('Y',time());
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
            $varData = Data::model()->find('company_code=:company_code and month=:month',array(':company_code'=>$companyCode,':month'=>$monthStart));
            if(!$varData){
                $monthArray[$monthStart] = array('basic'=>'未挂帐','extension'=>'未挂帐');
            }else{
                $monthArray[$monthStart] = array(
                    'basic'=>CHtml::link("查看",array("/data/basic","company_code"=>$companyInfo->code_id,"month"=>$monthStart)),
                    'extension'=>CHtml::link("查看",array("/data/extension","company_code"=>$companyInfo->code_id,"month"=>$monthStart)),
                );
            }
        }

        //YiiBase::app()->get
        YiiBase::app()->clientScript->registerCoreScript('jquery');
        $renderData = array(
            'companyInfo'=>$companyInfo,
            'year'=>$searchYear,
            'monthArray'=>$monthArray
        );
        $this->render('company',$renderData);
    }

    public function actionBasic(){
        $companyCode = YiiBase::app()->request->getParam('company_code');
        $month       = YiiBase::app()->request->getParam('month');

        $criteria = new CDbCriteria();
      //  $varData = Data::model()->findAll('company_code=:company_code and month=:month',array(':company_code'=>$companyCode,':month'=>$month));

        $companyInfo = Company::model()->find('code_id=:companyCode',array(':companyCode'=>$companyCode));

        $criteria->addCondition('company_code=:company_code and month=:month');
        $criteria->params=array(':company_code'=>$companyCode,':month'=>$month);
        $dataProvider = new CActiveDataProvider('Data',array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>15),
            'sort'=>array('defaultOrder'=>'id desc')
        ));
        $this->actionName= $companyInfo->company . $month ."基础挂账单";
        $renderData = array(
        //    'debtsData'=>$varData,
            'company'=>$companyInfo,
            'dataProvider'=>$dataProvider
        );
        $this->render('basic',$renderData);
    }
    public function actionExtension(){
        $companyCode = YiiBase::app()->request->getParam('company_code');
        $month       = YiiBase::app()->request->getParam('month');

        $criteria = new CDbCriteria();
        //  $varData = Data::model()->findAll('company_code=:company_code and month=:month',array(':company_code'=>$companyCode,':month'=>$month));

        $companyInfo = Company::model()->find('code_id=:companyCode',array(':companyCode'=>$companyCode));

        $criteria->addCondition('company_code=:company_code and month=:month');
        $criteria->params=array(':company_code'=>$companyCode,':month'=>$month);
        $dataProvider = new CActiveDataProvider('Data',array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>10),
            'sort'=>array('defaultOrder'=>'id desc')
        ));
        $this->actionName= $companyInfo->company . $month ."拓展挂账单";
        $renderData = array(
            //    'debtsData'=>$varData,
            'company'=>$companyInfo,
            'dataProvider'=>$dataProvider
        );
        $this->render('extension',$renderData);
    }
} 