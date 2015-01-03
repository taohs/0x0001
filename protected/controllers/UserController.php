<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/7
 * Time: 上午12:28
 * @var $_model User
 * @var Yii YiiBase
 */
class UserController extends Controller{

    protected $_model;
    public $controlName ='用户管理';
    public $actionName     ='用户列表';

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
     * index
     */
    public function actionIndex(){

    }
    public function actionList(){

        $dataProvider = new CActiveDataProvider('User',array(
            'criteria'=>array(
                'with'=>array('role0','company0')
            ),
            'countCriteria'=>array(
              //'condition'=>'status=1',
              // 'order' and 'with' clauses have no meaning for the count query
            ),
            'pagination'=>array(
              'pageSize'=>20,
            ),
            'sort' => array (
                'defaultOrder' => 't.id asc'
            )
        ));

      //  Yii::app()->clientScript->registerCoreScript('jquery');
        $renderData = array('dataProvider'=>$dataProvider,'controlName'=>'123','actionName'=>'1');
        $this->layout = 'admin_tpl_right';
        $this->render('list',$renderData);

    }
    public function actionLeft(){
        $this->layout = 'admin_tpl_left';
        $this->render('left');
    }
    public function actionCreate()
    {
        $model=new User('create');

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-add-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            if($model->validate())
            {

                $user = User::model()->find('username=:username',array(':username'=>$model->username));
                //var_dump($model->getPrimaryKey());
                if(is_null($user) && $model->password = md5($model->password) && $model->save()){
                 //   $this->redirect('list');
                    $msg = "新增成功";
                }else{
                    $msg = "新增失败";
                }
                Yii::app()->user->setFlash('createUserSubmit',$msg);
                $this->refresh();
                // form inputs are valid, do something here
               // return;
            }
        }
        $this->layout = "admin_tpl_right";
        $this->actionName = "创建用户";
        $this->render('create',array('model'=>$model));
    }
    public function actionUpdate()
    {
        //$model=new User('update');
        $model=$this->getModel('update');

        //echo $model->getScenario();

        //var_dump($model->attributes);
        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-update-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
           // var_dump($model->password);
            if($model->validate()&&$model->save())
            {
                $model->setModelByPk($model->id,3600,$model);
                //$model->save();
                // form inputs are valid, do something here
                //return;
                $msg = "修改成功";
            }else{
                $msg = "修改失败";
            }
            Yii::app()->user->setFlash('updateUserSubmit',$msg);
            $this->refresh();
        }
        $this->layout = "admin_tpl_right";
        $this->render('update',array('model'=>$model));
    }
    function actionUpdatePassword(){
        $model = new PasswordForm('admin2user');

       // $model->isAttributeRequired();
        if(isset($_POST['ajax']))
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['PasswordForm'])){
            $model->attributes = $_POST['PasswordForm'];
            $model->userId = Yii::app()->request->getParam('id');

            if($model->validate()&&$model->updatePassword()){
                Yii::app()->user->setFlash('passwordSubmitted','修改成功');
                Controller::refresh();
            }else{
                Yii::app()->user->setFlash('passwordSubmitted','修改失败');
                Controller::refresh();
            }
        }

        $renderData = array('model'=>$model);
        $this->layout ='admin_tpl_right';
        $this->actionName = "修改密码";
        $this->render('password',$renderData);
    }
    public function actionView(){
        echo 33;
    }
    public function actionDelete(){
     //   echo 44;
        $model = $this->getModel('delete');
        echo $model->username;
    }
    protected function getModel($scenario=null){
        if(is_null($this->_model)){
            $id = Yii::app()->request->getParam('id');
            if(isset($id)){
                $this->_model = User::getModelByPk($id);
                //$this->setScenario($scenario);
                $this->_model->setScenario($scenario);
            }
            if(is_null($this->_model)){
                throw Exception('model is null');
            }
        }
        return $this->_model;
    }

    function actionPassword(){
        $model = new PasswordForm('update');

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
                Controller::refresh();
            }
        }

        $renderData = array('model'=>$model);
        $this->layout ='admin_tpl_right';
        $this->actionName = "修改密码";
        $this->render('password',$renderData);
    }

    /**
     * @var $company Company
     */
    function actionAuto(){
        //$user =  new User();
        //$transaction = $user::model()->dbConnection->beginTransaction();
        //try{
        //    $companyArray = Company::model()->findAll();
        //    foreach($companyArray as $company){
        //        $tempUser = new User();
        //        $tempUser->role = 2;
        //        $tempUser->is_valid = $company->is_valid;
        //        $tempUser->company  = $company->id;
        //        $tempUser->username = $company->code_id;
        //        $tempUser->password = md5($tempUser->username);
        //        if($tempUser->username!='0000'&&$tempUser->validate()&&$tempUser->save()){
        //            unset ($tempUser);
        //        }
        //    }
        //    $transaction->commit();
        //    echo 'yes';
        //}catch (Exception $e){
        //    $transaction->rollback();
        //    echo 'no';
        //}
    }
}