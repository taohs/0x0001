<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/13
 * Time: 上午9:49
 */

class CompanyController extends Controller {

    public $layout="admin_tpl_right";

    public $controlName = "公司管理";

    public $breadcrumbs = array('公司管理1'=>array('/site/index','id'=>1));

    protected  $_user;

    function init(){
        parent::init();
        if(Yii::app()->user->isGuest){
            $this->redirect('/login');
        }elseif(Yii::app()->user->role!=1){
            $this->redirect('/member');
        }
        $this->_user = $this->getUserInfo();
    }

    public function actionIndex(){
        echo time();
    }
    public function actionLeft(){
        $this->layout = "admin_tpl_left";
        $this->render('left');
    }
    public function actionList(){


        $keyword = YiiBase::app()->request->getParam('keyword');
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('company',$keyword);
        $criteria->addSearchCondition('code_id',$keyword,true,'or');


        $dataProvider = new CActiveDataProvider('Company',array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
            'sort' => array (
                'defaultOrder' => 't.id asc'
            )
        ));

        //  Yii::app()->clientScript->registerCoreScript('jquery');
        $renderData = array(
            'dataProvider'=>$dataProvider,
            'breadcrumbs'=>array('index'=>array('/site/index','id'=>1)),
            'controlName'=>'123',
            'actionName'=>'1',
            'keyword'=>$keyword
        );
        $this->actionName = "公司列表";
        $this->layout = 'admin_tpl_right';
        $this->render('list',$renderData);
    }

    public function actionUpdate(){
        $id   = YiiBase::app()->request->getParam('id');
        $model = Company::model()->findByPk($id);
        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='company-update-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */
        if(isset($_POST['Company']))
        {
            $model->attributes=$_POST['Company'];
            if($model->validate()&&$model->save())
            {
                Yii::app()->user->setFlash("companySubmitted",'修改企业成功!');
                // form inputs are valid, do something here
                //return;
            }else{
                Yii::app()->user->setFlash("companySubmitted",'修改企业失败!'.print_r($model->getErrors(),true));
            }
            $this->refresh();
        }
        $this->render('update',array('model'=>$model));
    }
    public function actionCreate(){

        $model = new Company();
        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='company-update-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */
        if(isset($_POST['Company']))
        {
            $model->attributes=$_POST['Company'];
            if($model->validate()&&$model->save())
            {
                Yii::app()->user->setFlash("companySubmitted",'新增企业成功!');
                // form inputs are valid, do something here
                //return;
            }else{
                Yii::app()->user->setFlash("companySubmitted",'新增企业失败!'.var_dump($model->getErrors()));
            }
            $this->refresh();
        }
        $this->render('create',array('model'=>$model));
    }
    public function actionDelete(){}

    public function getDetbs($data,$row,$c){
      //  var_dump($c->value);
       // echo "<a href='http://www.baidu.com/'>$data->id,$row</a>";
        echo CHtml::link("查看",array("/data/company","company_code"=>$data->code_id));
    }

} 