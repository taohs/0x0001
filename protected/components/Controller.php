<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();


    public $controlName ='用户管理';
    public $actionName  ='用户列表';
    protected $_user;


    function getUserInfo(){
        $cacheKey = 'userInfo_id_'.Yii::app()->user->id;
        $cacheValue = Yii::app()->cache->get($cacheKey);
        if(!$cacheValue){
            $cacheValue = User::model()->findByPk(Yii::app()->user->id);
            Yii::app()->cache->set($cacheKey,$cacheValue,600);
        }
        return $cacheValue;
    }
}