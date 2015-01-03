<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/12/1
 * Time: 下午11:20
 */
class PasswordForm extends CFormModel{

    public $userId;
    public $oldPassword;
    public $newPassword;
    public $rePassword;
    protected $_identity;
    protected $_userInfo;

    function rules(){
        return array(
            array('userId,newPassword,rePassword','required','on'=>'admin2user'),
            array('userId,oldPassword,newPassword,rePassword','required','on'=>'create,update'),
            //array('userId','exist','className'=>'User','attributeName'=>'id'),
            array('oldPassword,newPassword,rePassword','length','min'=>'4','max'=>'18','tooShort'=>'密码不能小于4位','tooLong'=>'密码不能大于18位'),
            array('rePassword','compare','compareAttribute'=>'newPassword'),
            array('oldPassword','verifyPassword','on'=>'update')
        );
    }

    function attributeLabels(){
        return array(
            'oldPassword'=>'laomima',
            'newPassword'=>'xinmima',
            'rePassword'=>'queren'
        );
    }

    function verifyPassword(){
        if(!$this->hasErrors()){
            //$user = User::model()->findByPk($this->userId);
            //$this->_userInfo = $this->getUserInfo();
            $this->_identity = new UserIdentity($this->userInfo->username,$this->oldPassword);

            //var_dump($user);
            if($this->userInfo->password != $this->_identity->encodePassword($this->oldPassword)){
                $this->addError('oldPassword','密码错误');
            }
        }
    }

    function updatePassword(){
        if(!$this->hasErrors()){
            $this->userInfo->password = md5($this->newPassword);
            return $this->userInfo->save();
        }
        return false;
    }

    function getUserInfo(){
        if(is_null($this->_userInfo)){
            $this->_userInfo = User::model()->findByPk($this->userId);
        }
        return $this->_userInfo;
    }

}