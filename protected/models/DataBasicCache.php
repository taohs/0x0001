<?php

/**
 * This is the model class for table "tb_back_data_basic_cache".
 *
 * The followings are the available columns in table 'tb_back_data_basic_cache':
 * @property integer $id
 * @property string $company_code
 * @property string $code
 * @property string $name
 * @property string $format
 * @property string $unit
 * @property string $current_number
 * @property string $current_unpaid_debts
 * @property string $price
 * @property string $unpaid_debts_amount
 * @property string $current_unpaid_debts_amount
 * @property string $tax
 * @property string $after_tax
 * @property string $month
 * @property string $open_balance_payable
 * @property string $company_name
 * @property string $current_balance_payable
 * @property string $current_amount_pay
 * @property string $remark
 * @property string $acceptances_amount
 * @property string $create_time
 */
class DataBasicCache extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_back_data_basic_cache';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_code, code, name, unit, month, company_name, remark', 'length', 'max'=>255),
			array('current_number, current_unpaid_debts, price, unpaid_debts_amount, current_unpaid_debts_amount, tax, after_tax, open_balance_payable, current_balance_payable, current_amount_pay, acceptances_amount', 'length', 'max'=>22),
			array('format, create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_code, code, name, format, unit, current_number, current_unpaid_debts, price, unpaid_debts_amount, current_unpaid_debts_amount, tax, after_tax, month, open_balance_payable, company_name, current_balance_payable, current_amount_pay, remark, acceptances_amount, create_time', 'safe', 'on'=>'search'),
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
			'company_code' => '单位编号',
			'code' => '物料编号',
			'name' => '物料名称',
			'format' => '规格型号',
			'unit' => '计量单位',
			'current_number' => '本期收入数量',
			'current_unpaid_debts' => '本期挂账数量',
			'price' => '单价',
			'unpaid_debts_amount' => '挂账金额',
			'current_unpaid_debts_amount' => '本期挂账金额',
			'tax' => '税额',
			'after_tax' => '去税金额',
			'month' => '会计期间',
			'open_balance_payable' => '期初应付账款余额',
			'company_name' => '单位名称',
			'current_balance_payable' => '本期应付账款余额',
			'current_amount_pay' => '本期付款额',
			'remark' => '备注',
			'acceptances_amount' => '其中承兑额',
			'create_time' => '创建时间',
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
		$criteria->compare('current_number',$this->current_number,true);
		$criteria->compare('current_unpaid_debts',$this->current_unpaid_debts,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('unpaid_debts_amount',$this->unpaid_debts_amount,true);
		$criteria->compare('current_unpaid_debts_amount',$this->current_unpaid_debts_amount,true);
		$criteria->compare('tax',$this->tax,true);
		$criteria->compare('after_tax',$this->after_tax,true);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('open_balance_payable',$this->open_balance_payable,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('current_balance_payable',$this->current_balance_payable,true);
		$criteria->compare('current_amount_pay',$this->current_amount_pay,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('acceptances_amount',$this->acceptances_amount,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DataBasicCache the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
