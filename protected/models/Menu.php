<?php

/**
 * This is the model class for table "tb_back_menu".
 *
 * The followings are the available columns in table 'tb_back_menu':
 * @property integer $id
 * @property string $menu_name
 * @property integer $parent_id
 * @property integer $grand_id
 * @property string $limit
 * @property integer $is_valid
 */
class Menu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_back_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, parent_id, grand_id, is_valid', 'numerical', 'integerOnly'=>true),
			array('menu_name, limit', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, menu_name, parent_id, grand_id, limit, is_valid', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_name' => 'Menu Name',
			'parent_id' => 'Parent',
			'grand_id' => 'Grand',
			'limit' => 'Limit',
			'is_valid' => 'Is Valid',
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
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('grand_id',$this->grand_id);
		$criteria->compare('limit',$this->limit,true);
		$criteria->compare('is_valid',$this->is_valid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
