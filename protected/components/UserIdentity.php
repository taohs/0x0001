<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    protected $_userId;
    public $_roleId;
    public $_roleName;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $user = User::model()->find('username=:username',array(':username'=>$this->username));

		if(!isset($user) && is_null($user)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }elseif($user->password!==$this->encodePassword()) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }else {
            $this->errorCode = self::ERROR_NONE;
            $this->_roleId = $user->role;
            $this->_userId  = $user->id;
            $this->setState('role',$user->role);
            $this->setState('roleId',$this->_roleId);
            $this->setState('roleName',$user->role0->role_name);
            $this->setState('loginTime',date('Y-m-d H:i:s'));
        }
		return !$this->errorCode;
	}

    function encodePassword(){
        return md5($this->password);//md5($this->password);
    }

    function getId(){
        return $this->_userId;
    }

    function getRole(){
        return $this->_roleId;
    }
}