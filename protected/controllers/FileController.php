<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/7
 * Time: 上午12:47
 */
class FileController extends Controller{


    function init(){
        parent::init();
        if(Yii::app()->user->isGuest){
            $this->redirect('/login');
        }elseif(Yii::app()->user->role!=1){
            $this->redirect('/member');
        }
        $this->_user = $this->getUserInfo();
        $this->controlName ="文件管理";
    }

    public function actionIndex(){}
    public function actionList(){

        $dataProvider = new CActiveDataProvider('Company',array(
            'criteria'=>array(
                //'with'=>array('role0','company0')
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
    public function actionUpload(){
        $model = new FileForm(FileForm::SCENARIO_CSV);
        if(isset($_POST['FileForm'])){
           // Controller::refresh();

            if($cacheKey = YiiBase::app()->request->getParam('cacheKey')){
                $cache =  Yii::app()->cache->get($cacheKey);
                if($cache){
                    Controller::refresh();
                }else{
                    Yii::app()->cache->set($cacheKey,$cacheKey);
                }
            }else{
                Controller::refresh();
            }
            $model->attributes = $_POST['FileForm'];
            $model->date = date('Ym',time());
            $model->file = CUploadedFile::getInstance($model,'file');
            if($model->validate()){
                //echo 'upload';
                if(!is_dir(UPLOAD_ADDRESS.'/' .$model->getScenario())){
                    mkdir(UPLOAD_ADDRESS.'/' .$model->getScenario());
                }
                $name = uniqid();
                $namePath = UPLOAD_ADDRESS.'/' .$model->getScenario().'/'.$name.'.'.$model->file->extensionName;
                $model->file->saveAs($namePath);

                $xls = "/Users/taohaisong/Projects/Php/0x0001/protected/extensions/phpexcelreader/example.xls";
                Yii::import('ext.phpexcelreader.JPhpExcelReader');
                //$data = new JPhpExcelReader(UPLOAD_ADDRESS.'/' .$model->getScenario().'/'.$name.'.'.$model->file->extensionName);
               // $data = new JPhpExcelReader($xls);
              //  echo $data->dump(true,true);
                $csv= "/Users/taohaisong/Projects/Php/0x0001/protected/extensions/phpexcelreader/example.csv";

                $file = fopen($namePath,'r');
                $i=0;
                while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
//print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
                    if($i==0){
                        $hear=$data;
                    }else {
                        for($m=0,$n=count($hear);$m<$n;$m++){
                            $arr[$hear[$m]]=$data[$m];
                        }
                        $goods_list[] = $data;
                        $dataModel = new Data();
                        $dataModel->attributes =$arr;
                        if($dataModel->validate()){
                            $dataModel->save();
                        }
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->code = $data['1'];
                        //$dataModel->name = $data['2'];
                        //$dataModel->format = $data['3'];
                        //$dataModel->unit = $data['4'];
                        //$dataModel->last_number = $data['5'];
                        //$dataModel->current_number = $data['6'];
                        //$dataModel->unpaid_debts = $data['7'];
                        //$dataModel->no_unpaid_debts = $data['8'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];

                    }
                    $i++;
                }
//print_r($goods_list);

                /* foreach ($goods_list as $arr){
                    if ($arr[0]!=""){
                        echo $arr[0]."<br>";
                    }
                } */
                //print_r($goods_list);

                fclose($file);
                Controller::refresh();
                die('上传成功');
            }else{
                $error = $model->getErrors();
                Controller::refresh();
                //var_dump($error);
                die('上传失败');
            }
        }
        $this->actionName = "文件上传";
        $this->layout = "admin_tpl_right";
        $this->render('upload',array('model'=>$model,'cacheKey'=>uniqid()));
    }
    public function actionDownload(){}
    public function insertInfo(){}
    /**
     * nav
     */
    public function actionLeft(){
        $this->layout="admin_tpl_left";
        $this->render('left');
    }

    public function actionBasic(){
        $model = new FileForm(FileForm::SCENARIO_CSV);

        if(isset($_POST['FileForm'])){
            $uploadFile  = $this->upload($model);
           // var_dump($uploadFile);
            if($uploadFile && $this->readAndInsertDatabase($uploadFile,new DataBasic())){
                $msg = "基础挂帐单上传入库成功";
            }else{
                $msg = $uploadFile ? '基础挂帐单上传成功,入库失败。':'基础挂帐单上传失败。';
            }
            Yii::app()->user->setFlash("uploadCsvSubmit",$msg);
            $this->refresh();
        }

        $renderData = array('model'=>$model,'cacheKey'=>uniqid());
        $this->actionName = "基础挂帐单上传";
        $this->layout = "admin_tpl_right";
        $this->render('upload',$renderData);
    }

    public function actionExtension(){
        $model = new FileForm(FileForm::SCENARIO_CSV);

        if(isset($_POST['FileForm'])){
            $uploadFile  = $this->upload($model);

            if($uploadFile && $this->readAndInsertDatabase($uploadFile,new DataExtension())){
                $msg = "附加挂帐单上传入库成功";
            }else{
                $msg = $uploadFile ? '附加挂帐单上传成功,入库失败。':'附加挂帐单上传失败。';
            }
            Yii::app()->user->setFlash("uploadCsvSubmit",$msg);
            $this->refresh();
        }

        $renderData = array('model'=>$model,'cacheKey'=>uniqid());

        $this->actionName = "附加挂帐单上传";
        $this->layout = "admin_tpl_right";
        $this->render('upload',$renderData);
    }

    function readAndInsertDatabase($filePath,CActiveRecord $activeRecord){
        $file = fopen($filePath,'r');
        $i=0;
        $hear  =array();
        $transfer = $activeRecord::model()->dbConnection->beginTransaction();
        try{
            while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
                if($i==0){
                    $hear  = $data;
                    $array = $ddd = $activeRecord->attributeLabels();
                    foreach($array as $k=>$v){
                        $array[$k]=md5(str_replace(array('帐','期未结'),array('账','期末结'),trim($v)));
                    }
                    $attriArray = array_flip($array);
                    foreach($hear as $k=>$temp){
                        $encode = mb_detect_encoding($temp,array('GB2312','GBK','UTF-8','utf8','utf-8'),true);
                        echo $encode;
                        if($encode == 'UTF8'){
                            $arr[$k] = $d = str_replace(array('帐','期未结'),array('账','期末结'),$temp);
                        }else{
                            $arr[$k] = $d = md5(str_replace(array('帐','期未结'),array('账','期末结'),mb_convert_encoding(trim($temp),'utf8',$encode)));
                        }
                    }
                    foreach($arr as $k=>$v){
                        $tempArr[$k]=$attriArray[$v];
                    }
                    $hear = $tempArr;
                }else {
                    $arr = array();
                    for($m=0,$n=count($hear);$m<$n;$m++){
                        $encode = mb_detect_encoding($data[$m],array('GB2312','GBK','UTF-8','utf8','utf-8'),true);
                        if($encode == 'UTF8'||$encode == 'UTF-8'||$encode == 'utf8'||$encode == 'utf-8'){
                            $content = $data[$m];
                        }else{
                            if($m==0){
                                $content = str_replace(array('年','期'),array('',''),mb_convert_encoding(trim($data[$m]),'utf8',$encode));
                            }else{
                                $content = mb_convert_encoding(trim($data[$m]),'utf8',$encode);
                                $content = $content!='' ? $content :null;
                            }
                        }
                        $arr[$hear[$m]]=$content;
                    }

                    $goods_list[] = $data;
                    $dataModel = clone $activeRecord;
                    $dataModel->attributes =$arr;
                    $dataModel->create_time = date('Y-m-d H:i:s');

                    //die();
                    if($dataModel->validate()){
                        $dataModel->setIsNewRecord(true);
                        $dataModel->save();
                    }
                    unset($dataModel);
                }
                $i++;
            }
            $transfer->commit();
            fclose($file);
            return true;
        }catch (Exception $e){
            $transfer->rollback();
            return false;
        }
    }

    public function upload($model){
        $model = new FileForm(FileForm::SCENARIO_CSV);
        if(isset($_POST['FileForm'])){
            if($cacheKey = YiiBase::app()->request->getParam('cacheKey')){
                $cache =  Yii::app()->cache->get($cacheKey);
                if($cache){
                    Controller::refresh();
                }else{
                    Yii::app()->cache->set($cacheKey,$cacheKey);
                }
            }else{
                Controller::refresh();
            }
            $model->attributes = $_POST['FileForm'];
            $model->date = date('Ym',time());
            $model->file = CUploadedFile::getInstance($model,'file');
            if($model->validate()){
                //echo 'upload';
                if(!is_dir(UPLOAD_ADDRESS.'/' .$model->getScenario())){
                    mkdir(UPLOAD_ADDRESS.'/' .$model->getScenario());
                }
                $name = uniqid();
                $namePath = UPLOAD_ADDRESS.'/' .$model->getScenario().'/'.$name.'.'.$model->file->extensionName;
                $upload = $model->file->saveAs($namePath);
                return $upload ? $namePath : $upload;
                $xls = "/Users/taohaisong/Projects/Php/0x0001/protected/extensions/phpexcelreader/example.xls";
                Yii::import('ext.phpexcelreader.JPhpExcelReader');
                //$data = new JPhpExcelReader(UPLOAD_ADDRESS.'/' .$model->getScenario().'/'.$name.'.'.$model->file->extensionName);
                // $data = new JPhpExcelReader($xls);
                //  echo $data->dump(true,true);
                $csv= "/Users/taohaisong/Projects/Php/0x0001/protected/extensions/phpexcelreader/example.csv";

                $file = fopen($namePath,'r');
                $i=0;
                while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
//print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
                    if($i==0){
                        $hear=$data;
                        $temp = new Data();

                        $array = $temp->attributeLabels();

                        $attriArray = array_flip($array);
                        var_dump($attriArray);
                        foreach($hear as $k=>$temp){
                            echo $temp;
                            $encode = mb_detect_encoding($temp,array('GB2312','GBK','UTF-8','utf8','utf-8'),true);
                            echo $encode;
                            if($encode == 'UTF8' || $encode == 'CP936'){
                                $arr[$k] = $d = $temp;
                                echo 'a';
                            }else{
                                $arr[$k] = $d = iconv($encode,'utf8',$temp);
                                echo 'b';
                            }
                            echo '<br>';

                        }
                        echo '<br>';
                        echo '<br>';
                        echo '<br>';


                        var_dump($arr);
                        die();
                    }else {
                        for($m=0,$n=count($hear);$m<$n;$m++){
                            $arr[$hear[$m]]=$data[$m];
                        }
                        $goods_list[] = $data;
                        $dataModel = new Data();
                        $dataModel->attributes =$arr;
                        if($dataModel->validate()){
                            $dataModel->save();
                        }
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->code = $data['1'];
                        //$dataModel->name = $data['2'];
                        //$dataModel->format = $data['3'];
                        //$dataModel->unit = $data['4'];
                        //$dataModel->last_number = $data['5'];
                        //$dataModel->current_number = $data['6'];
                        //$dataModel->unpaid_debts = $data['7'];
                        //$dataModel->no_unpaid_debts = $data['8'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                    }
                    $i++;
                }
                fclose($file);
                Controller::refresh();
                die('上传成功');
            }else{
                $error = $model->getErrors();
                Controller::refresh();
                //var_dump($error);
                die('上传失败');
            }
        }

        return $renderData = array('model'=>$model,'cacheKey'=>uniqid());
        $this->render('upload',array('model'=>$model,'cacheKey'=>uniqid()));
    }

    function delBasicData(MonthForm $model){
        $month =  $model->year . $model->month;
        //var_dump($month);
        return DataBasic::model()->deleteAll('month=:month',array(':month'=>$month));
    }
    function delExtensionData(MonthForm $model){
        //if(!$model instanceof MonthForm)
        $month =  $model->year . $model->month;
        return DataExtension::model()->deleteAll('month=:month',array(':month'=>$month));
    }

    /**
     * 删除某月基础挂帐单
     */
    function actionDeleteBasic(){
        $model = new MonthForm();
        if(isset($_POST['MonthForm'])){
            $model->attributes = $_POST['MonthForm'];
            if($model->month<10)
                $model->month ='0'.$model->month;
            if($model->validate()&&$this->delBasicData($model)){
                $msg = "删除成功";
            }else{
                $msg = "删除失败";
            }
            Yii::app()->user->setFlash("delBasicSubmit",$msg);
           // $this->refresh();
        }
        $this->layout = "admin_tpl_right";
        $this->actionName = "删除基础挂帐单";
        $this->render('del_basic',array('model'=>$model));
    }

    /**
     * 删除某月附加挂帐单
     */
    function actionDeleteExtension(){
        $model = new MonthForm();
        if(isset($_POST['MonthForm'])){
            $model->attributes = $_POST['MonthForm'];
            if($model->month<10)
                $model->month ='0'.$model->month;
            if($model->validate()&&$this->delExtensionData($model)){
                $msg = "删除成功";
            }else{
                $msg = "删除失败";
            }
            Yii::app()->user->setFlash("delBasicSubmit",$msg);
            // $this->refresh();
        }
        $this->layout = "admin_tpl_right";
        $this->actionName = "删除附加挂帐单";
        $this->render('del_basic',array('model'=>$model));
    }
}