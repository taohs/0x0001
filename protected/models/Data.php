<?php

/**
 * This is the model class for table "tb_back_data".
 *
 * The followings are the available columns in table 'tb_back_data':
 * @property integer $id
 * @property string $company_code
 * @property string $code
 * @property string $name
 * @property string $format
 * @property string $unit
 * @property integer $last_number
 * @property integer $current_number
 * @property string $unpaid_debts
 * @property string $price
 * @property string $unpaid_debts_amount
 * @property string $no_unpaid_debts_amount
 * @property string $closing_amount
 * @property string $tax
 * @property string $after_tax
 * @property string $month
 * @property string $no_unpaid_debts
 */
class Data extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_back_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('last_number, current_number', 'numerical', 'integerOnly'=>true),
			array('company_code, code, name, format, unit, unpaid_debts, unpaid_debts_amount, no_unpaid_debts_amount, closing_amount, month, no_unpaid_debts', 'length', 'max'=>255),
			array('price, tax, after_tax', 'length', 'max'=>17),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_code, code, name, format, unit, last_number, current_number, unpaid_debts, price, unpaid_debts_amount, no_unpaid_debts_amount, closing_amount, tax, after_tax, month, no_unpaid_debts', 'safe', 'on'=>'search'),
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
			'company_code' => 'Company Code',
			'code' => 'Code',
			'name' => 'Name',
			'format' => 'Format',
			'unit' => 'Unit',
			'last_number' => 'Last Number',
			'current_number' => 'Current Number',
			'unpaid_debts' => 'Unpaid Debts',
			'price' => 'Price',
			'unpaid_debts_amount' => 'Unpaid Debts Amount',
			'no_unpaid_debts_amount' => 'No Unpaid Debts Amount',
			'closing_amount' => 'Closing Amount',
			'tax' => 'Tax',
			'after_tax' => 'After Tax',
			'month' => 'Month',
			'no_unpaid_debts' => '为挂帐数量',
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
		$criteria->compare('company_code',$this->company_code,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('format',$this->format,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('last_number',$this->last_number);
		$criteria->compare('current_number',$this->current_number);
		$criteria->compare('unpaid_debts',$this->unpaid_debts,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('unpaid_debts_amount',$this->unpaid_debts_amount,true);
		$criteria->compare('no_unpaid_debts_amount',$this->no_unpaid_debts_amount,true);
		$criteria->compare('closing_amount',$this->closing_amount,true);
		$criteria->compare('tax',$this->tax,true);
		$criteria->compare('after_tax',$this->after_tax,true);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('no_unpaid_debts',$this->no_unpaid_debts,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Data the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
