<?php

/**
 * This is the model class for table "tb_back_user".
 *
 * The followings are the available columns in table 'tb_back_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $create_time
 * @property string $update_time
 * @property integer $is_valid
 * @property integer $company
 * @property integer $role
 *
 * The followings are the available model relations:
 * @property Role $role0
 * @property Company $company0
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_back_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'required'),
			array('id, is_valid, company, role', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>255),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, create_time, update_time, is_valid, company, role', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'role0' => array(self::BELONGS_TO, 'Role', 'role'),
			'company0' => array(self::BELONGS_TO, 'Company', 'company'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'is_valid' => 'Is Valid',
			'company' => 'Company',
			'role' => 'Role',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('is_valid',$this->is_vaild);
		$criteria->compare('company',$this->company);
		$criteria->compare('role',$this->role);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getModelByPk($id){
        $cacheKey = 'UserModel_'.$id;
        $cacheValue = Yii::app()->cache->get($cacheKey);
        $cacheExpire = 3600;
        if(!$cacheValue){
            $cacheValue = self::model()->findByPk($id);
            if($cacheValue){
                Yii::app()->cache->set($cacheKey,$cacheValue,$cacheExpire);
            }else{
                throw Exception("model is null");
            }
        }
        return $cacheValue;
    }

    function beforeSave(){
        $current = date('Y-m-d H:i:s',time());
        if(self::getScenario()=='add'){
            $this->create_time=$current;
        }
        $this->update_time=$current;
        return true;
    }
}
