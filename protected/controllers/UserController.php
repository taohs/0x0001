<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/7
 * Time: 上午12:28
 */
class UserController extends Controller{

    protected $_model;
    public $controlName ='用户管理';
    public $actionName     ='用户列表';

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
    public function actionAdd()
    {
        $model=new User('add');

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
                //echo $model->getPrimaryKey();
                //var_dump($model->getPrimaryKey());
                if($model->save()){
                    $this->redirect('list');
                }

                // form inputs are valid, do something here
               // return;
            }
        }
        $this->render('add',array('model'=>$model));
    }
    public function actionUpdate()
    {
        //$model=new User('update');
        $model=$this->getModel();

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
            if($model->validate())
            {
                $model->save();
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('update',array('model'=>$model));
    }
    public function actionView(){
        echo 33;
    }
    public function actionDelete(){
     //   echo 44;
        $model = $this->getModel();
        echo $model->username;
    }
    protected function getModel(){
        if(is_null($this->_model)){
            $id = Yii::app()->request->getParam('id');
            if(isset($id)){
                $this->_model = User::getModelByPk($id);
            }
            if(is_null($this->_model)){
                throw Exception('model is null');
            }
        }
        return $this->_model;
    }
}