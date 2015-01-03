<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/12/17
 * Time: 下午10:13
 */

class TestController extends Controller {

    public function actions()
    {
        return array(
            'quote'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }


    function actionIndex(){
        echo time();
        echo '<br>';
        echo $this->getPrice('IBM');
    }



    /**
     * @param string the symbol of the stock
     * @return float the stock price
     * @soap
     */
    public function getPrice($symbol)
    {
        $prices=array('IBM'=>100, 'GOOGLE'=>350);
        return isset($prices[$symbol])?$prices[$symbol]:0;
        //...return stock price for $symbol
    }

    /**
     * @param string the symbol of the stock
     * @param int
     * @return int
     * @soap
     */
    public function getPrice2($symbol,$back)
    {
        $prices=array('IBM'=>100, 'GOOGLE'=>350);
        return isset($prices[$symbol])?$prices[$symbol]:0;
        //...return stock price for $symbol
    }

    public function actionTest(){
        $client=new SoapClient('http://0x0001.dev/test/quote');
        echo $client->getPrice('GOOGLE');
    }
} 