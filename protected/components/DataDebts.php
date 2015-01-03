<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/25
 * Time: 上午12:38
 */
class DataDebts {

    function getData($companyCode,$month){
        $criteria       = $this->getCriteria($companyCode,$month);
        $dataProvider   = $this->getDataProvider('Data',$criteria);
        $totalCriteria  = clone $criteria;
        $totalCriteria->select = 'sum(current_number) as current_number,
            sum(unpaid_debts) as unpaid_debts,
            sum(after_tax) as after_tax,
            sum(tax) as tax,
            sum(no_unpaid_debts) as no_unpaid_debts,
            sum(closing_amount) as closing_amount,
            sum(unpaid_debts_amount) as unpaid_debts_amount';
        $total = Data::model()->find($totalCriteria);
        return array('dataProvider'=>$dataProvider,'total'=>$total);
    }
    function getBasicData($companyCode,$month){
        $criteria = $this->getCriteria($companyCode,$month);
        $dataProvider = $this->getDataProvider('DataBasic',$criteria);
        $totalCriteria = clone $criteria;
        $totalCriteria->select = 'sum(current_number) as current_number,
            sum(current_unpaid_debts) as current_unpaid_debts,
            sum(after_tax) as after_tax,
            sum(tax) as tax,
            sum(unpaid_debts_amount) as unpaid_debts_amount,
            max(open_balance_payable) as open_balance_payable,
            max(current_amount_pay) as current_amount_pay,
            max(acceptances_amount) as acceptances_amount,
            max(current_balance_payable) as current_balance_payable
            ';
        $total = DataBasic::model()->find($totalCriteria);
        return array('dataProvider'=>$dataProvider,'total'=>$total);
    }

    function getExtensionData($companyCode,$month){
        $criteria = $this->getCriteria($companyCode,$month);
        $dataProvider = $this->getDataProvider('DataExtension',$criteria);
        $totalCriteria = clone $criteria;
        $totalCriteria->select = 'sum(current_number) as current_number,
            sum(current_unpaid_debts) as current_unpaid_debts,
            sum(no_unpaid_debts) as no_unpaid_debts,
            sum(close_amount) as close_amount,
            sum(unpaid_debts_amount) as unpaid_debts_amount,

            max(open_balance_payable) as open_balance_payable,
            max(retention_money) as retention_money,
            max(deduction) as deduction,
            max(fine) as fine,
            max(transportation_fee) as transportation_fee,
            max(check_fee) as check_fee,
            max(other_fee) as other_fee,
            max(current_net_amount_paid) as current_net_amount_paid,
            max(current_card_amount_paid) as current_card_amount_paid,
            max(acceptances_amount) as acceptances_amount,
            max(current_balance_payable) as current_balance_payable

            ';
        $total = DataExtension::model()->find($totalCriteria);
        return array('dataProvider'=>$dataProvider,'total'=>$total);
    }

    function getCriteria($companyCode,$month){
        $criteria = new CDbCriteria();
        $criteria->addCondition('company_code=:company_code and month=:month');
        $criteria->params=array(':company_code'=>$companyCode,':month'=>$month);
        return $criteria;
    }

    /**
     * @param $modelName
     * @param $criteria
     * @return CActiveDataProvider
     */
    function getDataProvider($modelName,$criteria){
        return new CActiveDataProvider($modelName,array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>1000),
            'sort'=>array('defaultOrder'=>'id desc')
        ));
    }
}