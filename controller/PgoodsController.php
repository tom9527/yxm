<?php

namespace app\controllers;

use Yii;
use app\models\Area;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Goods;
use app\models\Fqa;
use yii\web\UploadedFile;
use yii\common\Pagination;
use app\models\GoodsDetails;
use app\models\SkuType;
use app\models\Hospital;
use app\models\Mbuy;
use app\models\DoctorGoods;
use app\models\Doctor;
use app\models\Goodsext;
use app\models\FeiLiTools;

ini_set("error_reporting","E_ALL & ~E_NOTICE");

class PgoodsController extends BaseController{

    public $layout="common";

    //特惠列表-> 特惠商品
    public function actionPgindex(){

        $pag=$_GET['page'];
        
        $userName =Yii::$app->session->get('username');
        
        $hospitalId = $_SESSION['hospitalId'];
        
        $db=Yii::$app->getDb();
        
        //$sql="select item_name from auth_assignment where user_id=:username";
        
        $sql = "select auth_assignment.item_name
                from auth_assignment,auth_item
                where auth_assignment.item_name = auth_item.name and auth_item.type=1
                and auth_assignment.user_id = '$userName' ";
        
        $command=$db->createCommand($sql);
        
        $command->bindParam(':username', $userName);
        
        $itemArr = $command->queryAll();
        
        $item = $itemArr[0]['item_name'];
        
        //var_dump($item);die;
        
        $itemCon = array("yun","admin","root","主编","BD");

        if(in_array($item,$itemCon)){
                
            //全部特惠商品                    
            $cntsql="select count(*)
                     from goods g LEFT JOIN area a on(g.proSite=a.id)
                     LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                     where g.hospitalId = hos.id ";     
    
            $ww= $db->createCommand($cntsql)->queryAll();
    
            $cnt=$ww['0']['count(*)'];
    
            $per=8;
    
            $page=new Pagination($cnt,$per);
    
            $page_list=$page->fpage();
    
            //var_dump($page_list);die;
    
            $sql="select g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
                  g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.recommend, g.id gId, g.createTime
                  from goods g LEFT JOIN area a on(g.proSite=a.id)
                  LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                  where g.hospitalId = hos.id
                  order by g.createTime desc $page->limit ";
    
            $pgArr= $db->createCommand($sql)->queryAll();
        
        } else {
            
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                     from goods g LEFT JOIN area a on(g.proSite=a.id)
                     LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                     where g.hospitalId = hos.id 
                     and g.hospitalId= $hospitalId ";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=8;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.recommend, g.id gId, g.createTime
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.hospitalId= $hospitalId
            order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();
            
        }
        
        foreach ($pgArr as $k=>$v) {
            $pgArr[$k]['pag'] = $pag;
        }        

        $active = -1;

        return $this->render('pgindex',['page_list'=>$page_list,
                                        'pgArr'=>$pgArr,
                                        'active'=>$active,
        ]);

    }     

    //待审核
    public function actionUnchecked(){
        
        $pag=$_GET['page'];
        
        $userName =Yii::$app->session->get('username');
        
        $hospitalId = $_SESSION['hospitalId'];
        
        $db=Yii::$app->getDb();
        
        //$sql="select item_name from auth_assignment where user_id=:username";
        
        $sql = "select auth_assignment.item_name
                from auth_assignment,auth_item
                where auth_assignment.item_name = auth_item.name and auth_item.type=1
                and auth_assignment.user_id = '$userName' ";
        
        $command=$db->createCommand($sql);
        
        $command->bindParam(':username', $userName);
        
        $itemArr = $command->queryAll();
        
        $item = $itemArr[0]['item_name'];
        
        //var_dump($item);die;
        
        $itemCon = array("yun","admin","root","主编","BD");
        
        if(in_array($item,$itemCon)){
        
        //if($userName=="root" || $userName=="admin"){
        
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                        from goods g LEFT JOIN area a on(g.proSite=a.id)
                        LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                        where g.hospitalId = hos.id
                        and g.status = -1";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.id gId, g.createTime
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.status = -1
            order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();
        
        } else {
            
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                     from goods g LEFT JOIN area a on(g.proSite=a.id)
                     LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                     where g.hospitalId = hos.id
                     and g.hospitalId= $hospitalId
                     and g.status = -1";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.id gId
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.hospitalId= $hospitalId
            and g.status = -1
            order by g.id desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();
                                   
        }
        
        foreach ($pgArr as $k=>$v) {
            $pgArr[$k]['pag'] = $pag;
        }
        
        $active = 0;
        
        //var_dump($pgArr);die;
        
        return $this->render('pgindex',['page_list'=>$page_list,
            'pgArr'=>$pgArr,
            'active'=>$active,
        ]);
   
    }

    //待上架
    public function actionCheckthrough(){
        
        $pag=$_GET['page'];
        
        $userName =Yii::$app->session->get('username');
        
        $hospitalId = $_SESSION['hospitalId'];
        
        $db=Yii::$app->getDb();
        
        //$sql="select item_name from auth_assignment where user_id=:username";
        
        $sql = "select auth_assignment.item_name
                from auth_assignment,auth_item
                where auth_assignment.item_name = auth_item.name and auth_item.type=1
                and auth_assignment.user_id = '$userName' ";
        
        $command=$db->createCommand($sql);
        
        $command->bindParam(':username', $userName);
        
        $itemArr = $command->queryAll();
        
        $item = $itemArr[0]['item_name'];
        
        //var_dump($item);die;
        
        $itemCon = array("yun","admin","root","主编","BD");
        
        if(in_array($item,$itemCon)){
        
        //if($userName=="root" || $userName=="admin"){
        
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                     from goods g LEFT JOIN area a on(g.proSite=a.id)
                     LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                     where g.hospitalId = hos.id
                     and g.status = 0";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.id, g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.id gId, g.createTime
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.status = 0
            order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();
        
        } else {
            
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                     from goods g LEFT JOIN area a on(g.proSite=a.id)
                     LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                     where g.hospitalId = hos.id
                     and g.hospitalId= $hospitalId
                     and g.status = 0";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.id, g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.id gId, g.createTime
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.hospitalId= $hospitalId
            and g.status = 0
            order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();
            
        }
        
        foreach ($pgArr as $k=>$v) {
            $pgArr[$k]['pag'] = $pag;
        }
        
        $active = 1;
        
        //var_dump($pgArr);die;
        
        return $this->render('pgindex',['page_list'=>$page_list,
            'hospId'=>$hospId,
            'pgArr'=>$pgArr,
            'active'=>$active,
        ]);
  
    }

    //已上架
    public function actionOnshelf(){
        
        $pag=$_GET['page'];
        
        $userName =Yii::$app->session->get('username');
        
        $hospitalId = $_SESSION['hospitalId'];
        
        $db=Yii::$app->getDb();
        
        //$sql="select item_name from auth_assignment where user_id=:username";
        
        $sql = "select auth_assignment.item_name
        from auth_assignment,auth_item
        where auth_assignment.item_name = auth_item.name and auth_item.type=1
        and auth_assignment.user_id = '$userName' ";
        
        $command=$db->createCommand($sql);
        
        $command->bindParam(':username', $userName);
        
        $itemArr = $command->queryAll();
        
        $item = $itemArr[0]['item_name'];
        
        //var_dump($item);die;
        
        $itemCon = array("yun","admin","root","主编","BD");
        
        if(in_array($item,$itemCon)){
        
        //if($userName=="root" || $userName=="admin"){
        
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                        from goods g LEFT JOIN area a on(g.proSite=a.id)
                        LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                        where g.hospitalId = hos.id
                        and g.status = 1";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.id, g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.recommend, g.id gId, g.createTime
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.status = 1
            order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();
        
        } else {
            
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                        from goods g LEFT JOIN area a on(g.proSite=a.id)
                        LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                        where g.hospitalId = hos.id
                        and g.hospitalId= $hospitalId
                        and g.status = 1";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.id, g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.recommend, g.id gId, g.createTime
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.hospitalId= $hospitalId
            and g.status = 1
            order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();                    
            
        }
        
        foreach ($pgArr as $k=>$v) {
            $pgArr[$k]['pag'] = $pag;
        }
        
        $active = 2;
        
        //var_dump($pgArr);die;
        
        return $this->render('pgindex',['page_list'=>$page_list,
            'hospId'=>$hospId,
            'pgArr'=>$pgArr,
            'active'=>$active,
        ]);

    }

    //已下架
    public function actionOffshelf(){
        
        $pag=$_GET['page'];
        
        $userName =Yii::$app->session->get('username');
        
        $hospitalId = $_SESSION['hospitalId'];
        
        $db=Yii::$app->getDb();
        
        //$sql="select item_name from auth_assignment where user_id=:username";
        
        $sql = "select auth_assignment.item_name
        from auth_assignment,auth_item
        where auth_assignment.item_name = auth_item.name and auth_item.type=1
        and auth_assignment.user_id = '$userName' ";
        
        $command=$db->createCommand($sql);
        
        $command->bindParam(':username', $userName);
        
        $itemArr = $command->queryAll();
        
        $item = $itemArr[0]['item_name'];
        
        //var_dump($item);die;
        
        $itemCon = array("yun","admin","root","主编","BD");
        
        if(in_array($item,$itemCon)){
        
        //if($userName=="root" || $userName=="admin"){
        
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                        from goods g LEFT JOIN area a on(g.proSite=a.id)
                        LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                        where g.hospitalId = hos.id
                        and g.status = 2";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.id, g.proName, m.mName, a.name, hos.hospitalName,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.id gId, g.createTime
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.status = 2
            order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();
        
        } else {
            
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                        from goods g LEFT JOIN area a on(g.proSite=a.id)
                        LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                        where g.hospitalId = hos.id
                        and g.hospitalId= $hospitalId
                        and g.status = 2";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.id, g.proName, m.mName, a.name, hos.hospitalName,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.id gId, g.createTime
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.hospitalId= $hospitalId
            and g.status = 2
            order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();  
            
        }
            
        foreach ($pgArr as $k=>$v) {
            $pgArr[$k]['pag'] = $pag;
        }
        
        $active = 3;
        
        //var_dump($pgArr);die;
        
        return $this->render('pgindex',['page_list'=>$page_list,
            'hospId'=>$hospId,
            'pgArr'=>$pgArr,
            'active'=>$active,
        ]);  
        
    }

    //审核未通过
    public function actionRejected(){
        
        $pag=$_GET['page'];
        
        $userName =Yii::$app->session->get('username');
        
        $hospitalId = $_SESSION['hospitalId'];
        
        $db=Yii::$app->getDb();
        
        //$sql="select item_name from auth_assignment where user_id=:username";
        
        $sql = "select auth_assignment.item_name
        from auth_assignment,auth_item
        where auth_assignment.item_name = auth_item.name and auth_item.type=1
        and auth_assignment.user_id = '$userName' ";
        
        $command=$db->createCommand($sql);
        
        $command->bindParam(':username', $userName);
        
        $itemArr = $command->queryAll();
        
        $item = $itemArr[0]['item_name'];
        
        //var_dump($item);die;
        
        $itemCon = array("yun","admin","root","主编","BD");
        
        if(in_array($item,$itemCon)){
        
        //if($userName=="root" || $userName=="admin"){
            
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                        from goods g LEFT JOIN area a on(g.proSite=a.id)
                        LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                        where g.hospitalId = hos.id
                        and g.status = 3 ";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.id, g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
                  g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.id gId, g.createTime
                  from goods g LEFT JOIN area a on(g.proSite=a.id)
                  LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                  where g.hospitalId = hos.id
                  and g.status = 3
                  order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();
        
        } else {
            
            $db=Yii::$app->getDb();
            
            $cntsql="select count(*)
                        from goods g LEFT JOIN area a on(g.proSite=a.id)
                        LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                        where g.hospitalId = hos.id
                        and g.hospitalId= $hospitalId
                        and g.status = 3 ";
            
            $ww= $db->createCommand($cntsql)->queryAll();
            
            $cnt=$ww['0']['count(*)'];
            
            $per=6;
            
            $page=new Pagination($cnt,$per);
            
            $page_list=$page->fpage();
            
            //var_dump($page_list);die;
            
            $sql="select g.id, g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
            g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.id gId, g.createTime
            from goods g LEFT JOIN area a on(g.proSite=a.id)
            LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
            where g.hospitalId = hos.id
            and g.hospitalId= $hospitalId
            and g.status = 3
            order by g.createTime desc $page->limit ";
            
            $pgArr= $db->createCommand($sql)->queryAll();                       
        }

        foreach ($pgArr as $k=>$v) {
            $pgArr[$k]['pag'] = $pag;
        }
        
        $active = 4;
        
        //var_dump($pgArr);die;
        
        return $this->render('pgindex',['page_list'=>$page_list,
            'hospId'=>$hospId,
            'pgArr'=>$pgArr,
            'active'=>$active,
        ]);

    }

    //TOP10
    public function actionToplist(){   
        
        $db = Yii::$app->getDb();
        
        $sql = "select count(*) from goods g where g.status = 1 and g.goodslocation > 0";
        
        $topArr = $db->createCommand($sql)->queryAll();
        
        $top_cnt=$topArr['0']['count(*)'];
        
        $top_sql = "select g.id, g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
                    g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.id gId, g.createTime
                    from goods g LEFT JOIN area a on(g.proSite=a.id)
                    LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                    where g.hospitalId = hos.id
                    and g.status = 1 and g.goodslocation > 0
                    order by g.goodslocation desc ";
        
        $top = $db->createCommand($top_sql)->queryAll();
        
        $active = 5;
        
        return $this->render('toplist',['active'=>$active,
                                        'top'=>$top,
                                        'top_cnt'=>$top_cnt,           
        ]);
    }      
    
    //搜索
    public function actionSearch(){
        
        $pag=$_GET['page'];
        
        $posted=Yii::$app->request->post();
                
        if(!empty($posted)){              

            $status = $_POST['g_status'];
            $gid = $_POST['g_id'];
            $site_name = $_POST['site_name'];
            $hospitalName = $_POST['hospitalName'];
            $mName = $_POST['mName'];
            $starttime = $_POST['starttime'];
            $endtime = $_POST['endtime'];
            
            if(!is_numeric($status) &&
                empty($_POST['g_id']) && empty($_POST['site_name'])&& empty($_POST['hospitalName']) &&
                empty($_POST['mName']) && empty($_POST['starttime'])
                && empty($_POST['endtime']) )
            {
                return $this->redirect(['pgoods/pgindex']);
            }
                      
            if(!is_numeric($status)){ 
                
                if(!empty($gid)){
                    $gid = "g.id =". $gid;
                    $site_name = empty($site_name) ? "" : "and a.name = '$site_name'";
                    $hospitalName = empty($hospitalName) ? "" : "and hos.hospitalName like '%$hospitalName%'";
                    $mName = empty($mName) ? ""  : " and m.mName = '$mName'";
                    $starttime = empty($starttime) ? "" : " and '$starttime' <= g.onshelfTime";
                    $endtime = empty($endtime) ? "" : "and '$endtime' >= g.offshelfTime";
                }else{
                    if(!empty($site_name)){
                        $site_name = "a.name = '$site_name'";
                        $hospitalName = empty($hospitalName) ? "" : "and hos.hospitalName like '%$hospitalName%'";
                        $mName = empty($mName) ? ""  : " and m.mName = '$mName'";
                        $starttime = empty($starttime) ? "" : " and '$starttime' <= g.onshelfTime";
                        $endtime = empty($endtime) ? "" : "and '$endtime' >= g.offshelfTime";
                    }else{
                        if(!empty($hospitalName)){
                            $hospitalName = "hos.hospitalName like '%$hospitalName%'";
                            $mName = empty($mName) ? ""  : " and m.mName = '$mName'";
                            $starttime = empty($starttime) ? "" : " and '$starttime' <= g.onshelfTime";
                            $endtime = empty($endtime) ? "" : "and '$endtime' >= g.offshelfTime";
                        }else{
                            if(!empty($mName)){
                                $mName = " m.mName = '$mName'";
                                $starttime = empty($starttime) ? "" : " and '$starttime' <= g.onshelfTime";
                                $endtime = empty($endtime) ? "" : "and '$endtime' >= g.offshelfTime";
                            }else{
                                if(!empty($starttime)){
                                    $starttime = " '$starttime' <= g.onshelfTime";
                                    $endtime = empty($endtime) ? "" : "and '$endtime' >= g.offshelfTime";
                                } else{
                                    if(!empty($endtime)){
                                        $endtime = "'$endtime' >= g.offshelfTime";
                                    }
                                }
                            }
                        }
                    }
                }                                                               
            } else{
                $status = " g.status = $status";
                $gid = empty($gid) ? "" : "and g.id =". $gid;
                $site_name = empty($site_name) ? "" : "and a.name = '$site_name'";
                $hospitalName = empty($hospitalName) ? "" : "and hos.hospitalName like '%$hospitalName%'";
                $mName = empty($mName) ? ""  : " and m.mName = '$mName'";
                $starttime = empty($starttime) ? "" : " and '$starttime' <= g.onshelfTime";
                $endtime = empty($endtime) ? "" : "and '$endtime' >= g.offshelfTime";
            }
                                    
        }else{
            $status = $_GET['g_status'];                         
            $gid = $_GET['g_id'];
            $site_name = $_GET['site_name'];
            $hospitalName = $_GET['hospitalName'];
            $mName = $_GET['mName'];
            $starttime = $_GET['starttime'];
            $endtime = $_GET['endtime'];                  
        }
                                                              
        $db=Yii::$app->getDb();
        
        $cntsql="select count(*), g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
                 g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.recommend, g.id gId
                 from goods g LEFT JOIN area a on(g.proSite=a.id)
                 LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                 where $status $gid $site_name $hospitalName $mName $starttime $endtime
                 and g.hospitalId = hos.id";
        
        $ww= $db->createCommand($cntsql)->queryAll();
        
        $cnt=$ww['0']['count(*)'];
        
        $per=10;
        
        $url="";
        
        $url=$url."&g_status="."$status"."&g_id=".$gid."&site_name=".$site_name.
             "&hospitalName=".$hospitalName."&mName=".$mName."&starttime=".$starttime.
             "&endtime=".$endtime;
        
        $page=new Pagination($cnt,$per,$url);
        
        $page_list=$page->fpage();
        
        $sql="select g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
              g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.recommend, g.id gId
              from goods g LEFT JOIN area a on(g.proSite=a.id)
              LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
              where $status $gid $site_name $hospitalName $mName $starttime $endtime
              and g.hospitalId = hos.id
              order by g.id desc $page->limit ";
        
        $pgArr= $db->createCommand($sql)->queryAll();
        
        foreach ($pgArr as $k => $v) {
            $pgArr[$k]['pag']=$pag;
        }
        
        $active = -1;
        
        return $this->render('pgindex',['pgArr'=>$pgArr,
                                        'active'=>$active,
                                        'page_list'=>$page_list,
        ]);
                                                                        
    }

    //特惠列表->添加特惠页
    public function actionCreate(){
        

        $userName =Yii::$app->session->get('username');
        
        $hospitalId = $_SESSION['hospitalId'];
        
        $db=Yii::$app->getDb();
        
        //$sql="select item_name from auth_assignment where user_id=:username";
        
        $sql = "select auth_assignment.item_name
                from auth_assignment,auth_item
                where auth_assignment.item_name = auth_item.name and auth_item.type=1
                and auth_assignment.user_id = '$userName' ";
        
        $command=$db->createCommand($sql);
        
        $command->bindParam(':username', $userName);
        
        $itemArr = $command->queryAll();
        
        $item = $itemArr[0]['item_name'];
        
        //var_dump($item);die;
        
        $itemCon = array("yun","admin","root","主编","BD");                
        
        //项目类型一
        $db= Yii::$app->getDb();
        
        $sql = "select id, mName from mbuy where status = 1 and level = 1";
        
        $mbuyArr= $db->createCommand($sql)->queryAll();
        
        //项目类型二
        $sql2 = "select id, mName from mbuy where status = 1 and level = 1";
        
        $mbuyArrs= $db->createCommand($sql2)->queryAll();
        
        //项目类型三
        $sql3 = "select id, mName from mbuy where status = 1 and level = 1";
        
        $mbuyArrt= $db->createCommand($sql3)->queryAll();
        
        if(in_array($item,$itemCon)){
        //if($userName=="root" || $userName=="admin"){
            
            //省 、市
            $provinces=Area::find()->where(['pid' => 0])->all();
            
            return $this->render('create',[ 'mbuyArr'=>$mbuyArr,
                                            'mbuyArrs'=>$mbuyArrs,
                                            'mbuyArrt'=>$mbuyArrt,
                                            'provinces'=>$provinces,
                                            'userName' =>$userName,
                                            'item'=>$item,
                                            'itemCon'=>$itemCon,
            ]);
            
        } else {
            
            $db = Yii::$app->getDb();
            
            $sql = "select h.id, h.hospitalName, h.hospSite, a.name   
                    from hospital h, area a 
                    where a.id = h.hospSite and 
                    h.id = $hospitalId and status = 1";
            
            $hospitalArr = $db->createCommand($sql)->queryAll();
            
            $sqlDoc = "select Id, docName from doctor where status = 1 and hospitalId = $hospitalId ";
            
            $docArr = $db->createCommand($sqlDoc)->queryAll();
            
            //var_dump($hospitalArr);die;
            
            //var_dump($docArr);die;
            
            return $this->render('create',[ 'mbuyArr'=>$mbuyArr,
                                            'mbuyArrs'=>$mbuyArrs,
                                            'mbuyArrt'=>$mbuyArrt,
                                            'hospitalArr'=>$hospitalArr,
                                            'docArr' => $docArr,
                                            'userName' =>$userName,
                
            ]);
        }                 
        
    }

    public function actionFindmbuy(){

        $id=$_POST['id']; 
        
        //var_dump($id);die;

        $mbuyArr = Mbuy::findBySql("select id, mName from mbuy where status = 1 and level = 2 and pid = $id ")->all();

        echo   \yii\helpers\Json::encode($mbuyArr); return;

    }

    public function actionFindmbuys()
    {
        $id=$_POST['id'];       

        $mbuyArrs = Mbuy::findBySql("select id, mName from mbuy where status = 1 and level = 2 and pid = $id ")->all();

        //var_dump($mbuyArr);die;

        echo   \yii\helpers\Json::encode($mbuyArrs); return;
    }

    public function actionFindmbuyt()
    {
        $id=$_POST['id'];

        //$id = 1;

        $mbuyArrt = Mbuy::findBySql("select id, mName from mbuy where status = 1 and level = 2 and pid = $id ")->all();

        //var_dump($mbuyArr);die;

        echo   \yii\helpers\Json::encode($mbuyArrt); return;
    }

    //搜索医院
    public function actionFindhospital(){

        $data = $_POST;

        $name = $data['datas'];

        $db = Yii::$app->getDb();

        $sql =  "select id, hospitalName from hospital 
                 where hospitalName LIKE '%$name%' and status = 1";

        $hospitalname = $db->createCommand($sql)->queryAll();

        return json_encode($hospitalname);

    }

    //根据搜索的医院返回医生
    public function actionFinddoc(){

        $id=$_POST['did'];

        //$docArr = Doctor::findBySql("select Id, docName from doctor where status = 1 and hospitalId = $id ")->all();
        $data = (new \yii\db\Query())
        ->select(['Id','docName'])
        ->from('doctor')
        ->where(['hospitalId'=>$id])
        ->all();

        echo   \yii\helpers\Json::encode($data); return;
    }

    public function actionFindcitys(){

        $id=$_POST['id'];

        $provinces = Area::find()->where(['pid'=>$id])->all();

        echo   \yii\helpers\Json::encode($provinces); return;

    }

    //医院列表->添加特惠
    public function actionAdd(){
        
        //var_export($_POST);die;
               
        $hospId = $_POST['hisHospid'];                                            
                                            
        $gModel = new Goods();    

        /////////
        if(!empty($_POST)){
             
            $postSku = $_POST['sku'];
            
            $skuNameArr = $postSku['skuName'];                       
            $skuSpecificationArr = $postSku['skuSpecification'];
//             $gLowPriceArr = $postSku['gLowPrice'];
            $gdPriceArr = $postSku['gdPrice'];
            $gdSetPriceArr = $postSku['gdSetPrice'];
            $gdHosPriceArr = $postSku['gdHosPrice'];
            $gdNumArr = $postSku['gdNum'];
            $gBuyLimitArr = $postSku['gBuyLimit'];
            
            $skuName= array_values($skuNameArr);
            $skuSpecification= array_values($skuSpecificationArr);
//             $gLowPrice= array_values($gLowPriceArr);
            $gdPrice= array_values($gdPriceArr);
            $gdSetPrice= array_values($gdSetPriceArr); 
            $gdHosPrice= array_values($gdHosPriceArr);
            $gdNum= array_values($gdNumArr);
            $gBuyLimit= array_values($gBuyLimitArr);
             
            //sku数量
            $skuCount = count($skuNameArr);
                        
            $skuArr = array();
            
            for($i=0;$i<$skuCount;$i++){
                 $skuArr[$i]['skuName'] = $skuName[$i];
                 $skuArr[$i]['skuSpecification'] = $skuSpecification[$i];
                 $skuArr[$i]['gLowPrice'] = $gLowPrice[$i];
                 $skuArr[$i]['gdPrice'] = $gdPrice[$i];
                 $skuArr[$i]['gdSetPrice'] = $gdSetPrice[$i];
                 $skuArr[$i]['gdHosPrice'] = $gdHosPrice[$i];
                 $skuArr[$i]['gdNum'] = $gdNum[$i];                 
                 $skuArr[$i]['gBuyLimit'] = $gBuyLimit[$i];                   
            }
                                                         
            //遍历拼接数组插入表中
            foreach ($skuArr as $k=>$v) {

                //goods最低颜小美价
                $gModel->mlowPrice = $skuArr[0]['gdPrice'];

                $gModel->save();
                 
                $stModel = new SkuType();

                $stModel->name = $v['skuName'];

                $stModel->specification = $v['skuSpecification'];
                 
                $stModel->save();

                $gdModel = new GoodsDetails();

                $gdModel->goodsId = $gModel->id;

                $gdModel->skuTypeId = $stModel->id;

                //gd原价
//                 $gdModel->lowPrice = $v['gLowPrice'];

                //总价
                $gdModel->price = $v['gdPrice'];

                //预付款
                $gdModel->setPrice = $v['gdSetPrice'];
                
                //到院付
                $gdModel->hosPrice = $v['gdHosPrice'];

                $gdModel->num = $v['gdNum'];
                
                $gdModel->buyLimit = $v['gBuyLimit'];

                $gdModel->save();
            }
                   

            if(strlen($_POST['city']) == 0){
                $proSite = 0;
            } else {
                $proSite = $_POST['city'];
            }
            
            //项目类型
            $mbuyres = $_POST['M']['selected'];
            
            $cnt = count($_POST['M']['selected']);
            
            $mbuyArr = array_values($mbuyres);
            
            $mbuy = array();
            
            for($j=0;$j<$cnt;$j++){
                $mbuy[$j]=$mbuyArr[$j];
            }           
             
            /////////
            $gModel->proName = $_POST['proName'];
            $gModel->proIntro = $_POST['proIntro'];
            $gModel->hospitalId = $_POST['hisHospid'];
            $gModel->proSite = $proSite;
            
            if(!empty($mbuy[0])){
                $gModel->mbuyType = $mbuy[0];
            }
            if(!empty($mbuy[1])){
                $gModel->mbuyType2 = $mbuy[1];
            }           
            if(!empty($mbuy[2])){
                $gModel->mbuyType3 = $mbuy[2];
            }
            $gModel->onshelfTime = $_POST['starttime'];
            $gModel->offshelfTime = $_POST['endtime'];
            $gModel->validateTime = $_POST['valitime'];            
            $gModel->createTime = Date("Y-m-d H:i:s");            
            $gModel->lowPrice= $_POST['lowPrice'];
            
//             $gModel->highPrice= $_POST['highPrice'];
            
            /* 封面图   */
            if(!empty($_POST['carouselimage0'])){
                $gModel->proImage = $_POST['carouselimage0'];
            }
            if(!empty($_POST['carouselimage1'])){
                $gModel->carouselImage2 = $_POST['carouselimage1'];
            }
            if(!empty($_POST['carouselimage2'])){
                $gModel->carouselImage3 = $_POST['carouselimage2'];
            }
            if(!empty($_POST['carouselimage3'])){
                $gModel->carouselImage4 = $_POST['carouselimage3'];
            }
            /* 详情图一 */
            if(!empty($_POST['fproimg0'])){
                $gModel->proImage2 = $_POST['fproimg0'];
            }
            if(!empty($_POST['fproimg1'])){
                $gModel->proImage4 = $_POST['fproimg1'];
            }
            if(!empty($_POST['fproimg2'])){
                $gModel->proImage5 = $_POST['fproimg2'];
            }
            if(!empty($_POST['fproimg3'])){
                $gModel->proImage6 = $_POST['fproimg3'];
            }            
            /* 详情图二  */
            if(!empty($_POST['sproimg0'])){
                $gModel->proImage3 = $_POST['sproimg0'];
            }
            if(!empty($_POST['sproimg1'])){
                $gModel->proImage7 = $_POST['sproimg1'];
            }
            if(!empty($_POST['sproimg2'])){
                $gModel->proImage8 = $_POST['sproimg2'];
            }
            if(!empty($_POST['sproimg3'])){
                $gModel->proImage9 = $_POST['sproimg3'];
            }
            /* 详情图三  */
            if(!empty($_POST['tproimg0'])){
                $gModel->effectDrawing = $_POST['tproimg0'];
            }
            if(!empty($_POST['tproimg1'])){
                $gModel->effectDrawing2 = $_POST['tproimg1'];
            }
            if(!empty($_POST['tproimg2'])){
                $gModel->effectDrawing3 = $_POST['tproimg2'];
            }
            if(!empty($_POST['tproimg3'])){
                $gModel->effectDrawing4 = $_POST['tproimg3'];
            }
            
            $gModel->proDesc2 = $_POST['proDesc2'];
            
            $gModel->proDesc3 = $_POST['proDesc3'];
            
            $gModel->proDesc4 = $_POST['proDesc4'];            

            $gModel->remarks = $_POST['remarks'];
            
            //预定数
            $gModel->reserveNum = mt_rand(100,200);

            $gModel->status = -1;
             
            $gModel->save();

            /////////商品绑定医生

            $dgModel = new DoctorGoods();

            $dgModel->docId = $_POST['docId'];

            $dgModel->goodsId = $gModel->id;

            $dgModel->save();          

            return $this->redirect(['pgoods/pgindex']);
            
        }

    }

    //修改页面
    public function actionUpdate(){

        $pag=$_GET['page'];        
        $gid = $_GET['gid'];
        
        $userName =Yii::$app->session->get('username');

        $db= Yii::$app->getDb();        
        $accsql = "select auth_assignment.item_name
                   from auth_assignment,auth_item
                   where auth_assignment.item_name = auth_item.name and auth_item.type=1
                   and auth_assignment.user_id = '$userName' ";       
        $command=$db->createCommand($accsql);        
        $command->bindParam(':username', $userName);        
        $itemArr = $command->queryAll();        
        $item = $itemArr[0]['item_name'];       
        $itemCon = array("yun","admin","root","主编","BD");

        $pgArr = Goods::find()->where(['id'=>$gid])->one();

        //var_dump($pgArr->mbuyType3);die;
        if(!empty($pgArr->mbuyType) && !empty($pgArr->mbuyType2) && !empty($pgArr->mbuyType3)){
            $mbuyLg = 3;
        }else{
            if((!empty($pgArr->mbuyType) && !empty($pgArr->mbuyType2)) || (!empty($pgArr->mbuyType) && !empty($pgArr->mbuyType3)) || (!empty($pgArr->mbuyType2) && !empty($pgArr->mbuyType3))){
                $mbuyLg = 2;
            }else{
                if(!empty($pgArr->mbuyType) || !empty($pgArr->mbuyType2) || !empty($pgArr->mbuyType3)){
                    $mbuyLg = 1;
                }else{
                    $mbuyLg = 0;
                }             
            }           
        }  
        
        //var_dump($mbuyLg);die;
        
        $dgArr = DoctorGoods::find()->where(['goodsId'=>$gid])->one();

        $skusql = "select gd.id, gd.goodsId, gd.skuTypeId, gd.lowPrice, gd.price,
                   gd.setPrice, gd.hosPrice, gd.num, gd.buyLimit, sku.name, sku.specification
                   from skutype sku, goodsdetails gd
                   where gd.skuTypeId = sku.id
                   and gd.goodsId = $gid ";
        $gdskuArr= $db->createCommand($skusql)->queryAll();
               
        $skuctsql = "select count(*)
                     from skutype sku, goodsdetails gd
                     where gd.skuTypeId = sku.id
                     and gd.goodsId = $gid ";
        $skuctArr= $db->createCommand($skuctsql)->queryAll();
        $skuct = $skuctArr[0]['count(*)'];

        //项目类型
        $sql = "select id, mName from mbuy where status = 1 and level = 1";

        $mbuyArr= $db->createCommand($sql)->queryAll();
        
        //  获取特惠项目标签
        $strdoc="";
        $docnum=0;
        
        //echo $goods1Id;die;
        
        if(!empty($pgArr->mbuyType)){
            $strdoc=$strdoc.$pgArr->mbuyType;
            $docnum++;
        }
        
        if(!empty($pgArr->mbuyType2)){
            if($docnum==0){
                $strdoc=$strdoc.$pgArr->mbuyType2;
                $docnum++;
            }else{
                $strdoc=$strdoc.",".$pgArr->mbuyType2;
            }
        }
        
        if(!empty($pgArr->mbuyType3)){
            if($docnum==0){
                 $strdoc=$strdoc.$pgArr->mbuyType3;
            }else{
                 $strdoc=$strdoc.",".$pgArr->mbuyType3;
            }
        }
        
        //var_dump($strdoc);die;
        if(!empty($strdoc)){
            $sl2 = "select id, mName from mbuy where status = 1 and level = 2 and id in (".$strdoc.") ";    
            $secmbuyArr= $db->createCommand($sl2)->queryAll();             
        }else{
            $secmbuyArr=array();
        }
        //var_dump($secmbuyArr);die;     
         
        //省 、市
        $provinces=Area::find()->where(['pid' => 0])->all();
        $cityId = $pgArr['proSite'];
        $cityArr=Area::find()->where(['id' =>$cityId])->all();

        //医生           
        $hId = $pgArr['hospitalId'];       
        $sql_list_doc = "select d.Id, d.docName 
                         from doctor d, hospital h
                         where d.hospitalId = h.id
                         and h.id = $hId ";        
        $listdocName = $db->createCommand($sql_list_doc)->queryAll();
        
        //医院
        $sqlHos = "select h.id, h.hospitalName
                   from hospital h, goods g
                   where h.id = g.hospitalId and g.id = $gid ";
        
        $hosName = $db->createCommand($sqlHos)->queryAll();
        
        return $this->render('update',['mbuyArr'=>$mbuyArr, 
                                       'sm'=>$secmbuyArr,
                                       'mlg'=>$mbuyLg,
                                       'provinces'=>$provinces,
                                       'pgArr'=>$pgArr,
                                       'dgArr'=>$dgArr,
                                       'gdskuArr'=>$gdskuArr,                                       
                                       'cityArr'=>$cityArr,
                                       'skuct'=>$skuct,
                                       'listdocName'=>$listdocName,
                                       'hosName'=>$hosName,
                                       'pag'=>$pag,
                                       'userName'=>$userName,         
                                       'item'=>$item,
                                       'itemCon'=>$itemCon,
        ]);
                     
    }

    //修改
    public function actionUppginfo(){
        
        //var_dump($_POST);die;       
        $page = $_GET['pag'];       
        $gid = $_POST['gid'];

        $gModel = Goods::findOne($gid);
        $dgModel = DoctorGoods::find()->where(['goodsId'=>$gid])->one();                       
        
        ////////对已有套餐的修改  start//////////////////
        if(!empty($_POST['skuShu'])){
            //sku数量
            $skuct = $_POST['skuShu'];
    
            $skuArr = array();
    
            //拼接sku数组
            for($i=0;$i<=$skuct-1;$i++){
    
                $gdModel = GoodsDetails::findOne($_POST['gdId'.$i]);
    
                $skuModel = SkuType::findOne($_POST['skuTypeId'.$i]);
    
                $skuArr[$i]['gdModel'] = $gdModel;
    
                $skuArr[$i]['skuModel'] = $skuModel;
    
                $skuArr[$i]['skuName'] = $_POST['skuName'.$i];
                $skuArr[$i]['skuSpecification'] = $_POST['skuSpecification'.$i];
                $skuArr[$i]['gLowPrice'] = $_POST['gLowPrice'.$i];
                $skuArr[$i]['gdPrice'] = $_POST['gdPrice'.$i];
                $skuArr[$i]['gdSetPrice'] = $_POST['gdSetPrice'.$i];
                $skuArr[$i]['gdHosPrice'] = $_POST['gdHosPrice'.$i];
                $skuArr[$i]['gdNum'] = $_POST['gdNum'.$i];
                $skuArr[$i]['gBuyLimit'] = $_POST['gBuyLimit'.$i];
            }
    
            //var_dump($skuArr);die;
    
            //遍历拼接数组进行修改
            foreach ($skuArr as $k=>$v) {
    
                //goods原价
                $gModel->lowPrice= $skuArr[0]['gLowPrice'];
    
                //goods最低皮小美价
                $gModel->mlowPrice = $skuArr[0]['gdPrice'];    
    
                $gModel->save();
    
                $v['skuModel']->name = $v['skuName'];
    
                $v['skuModel']->specification = $v['skuSpecification'];
                 
                $v['skuModel']->save();
    
                /* //gd原价
                $v['gdModel']->lowPrice = $v['gLowPrice']; */
    
                //总价
                $v['gdModel']->price = $v['gdPrice'];
    
                //预付款
                $v['gdModel']->setPrice = $v['gdSetPrice'];
                
                //到院付
                $v['gdModel']->hosPrice = $v['gdHosPrice'];
    
                $v['gdModel']->num = $v['gdNum'];
                
                $v['gdModel']->buyLimit = $v['gBuyLimit'];
    
                $v['gdModel']->save();
            }
        }
        //////////////对已有套餐的修改   end///////////////
        
        //////////////原有商品无套餐，现进行新增  start////////////        
        if(!empty($_POST['new_skuShu'])){
            
            $postSku = $_POST['sku'];
            
            //var_dump($postSku);die;
            
            $skuNameArr = $postSku['skuName'];
            $skuSpecificationArr = $postSku['skuSpecification'];
            $gLowPriceArr = $postSku['gLowPrice'];
            $gdPriceArr = $postSku['gdPrice'];
            $gdSetPriceArr = $postSku['gdSetPrice'];
            $gdHosPriceArr = $postSku['gdHosPrice'];
            $gdNumArr = $postSku['gdNum'];
            $gBuyLimitArr = $postSku['gBuyLimit'];
            
            $skuName= array_values($skuNameArr);
            $skuSpecification= array_values($skuSpecificationArr);
            $gLowPrice= array_values($gLowPriceArr);
            $gdPrice= array_values($gdPriceArr);
            $gdSetPrice= array_values($gdSetPriceArr);
            $gdHosPrice= array_values($gdHosPriceArr);
            $gdNum= array_values($gdNumArr);
            $gBuyLimit= array_values($gBuyLimitArr);
             
            //sku数量
            $skuCount = count($skuNameArr);
            
            $new_skuArr = array();
            
            for($i=0;$i<$skuCount;$i++){
                $new_skuArr[$i]['skuName'] = $skuName[$i];
                $new_skuArr[$i]['skuSpecification'] = $skuSpecification[$i];
                $new_skuArr[$i]['gLowPrice'] = $gLowPrice[$i];
                $new_skuArr[$i]['gdPrice'] = $gdPrice[$i];
                $new_skuArr[$i]['gdSetPrice'] = $gdSetPrice[$i];
                $new_skuArr[$i]['gdHosPrice'] = $gdHosPrice[$i];
                $new_skuArr[$i]['gdNum'] = $gdNum[$i];
                $new_skuArr[$i]['gBuyLimit'] = $gBuyLimit[$i];
            }
            
            //var_dump($new_skuArr);  die;
            
            //遍历拼接数组插入表中
            foreach ($new_skuArr as $k=>$v) {
                                
                //goods最低皮小美价
                $gModel->mlowPrice = $new_skuArr[0]['gdPrice'];                          
            
                $gModel->save();
                 
                $stModel = new SkuType();
            
                $stModel->name = $v['skuName'];
            
                $stModel->specification = $v['skuSpecification'];
                 
                $stModel->save();
            
                $gdModel = new GoodsDetails();
            
                $gdModel->goodsId = $gid;
            
                $gdModel->skuTypeId = $stModel->id;
            
                /* //gd原价
                $gdModel->lowPrice = $v['gLowPrice']; */
            
                //总价
                $gdModel->price = $v['gdPrice'];
            
                //预付款
                $gdModel->setPrice = $v['gdSetPrice'];
                
                //到院付
                $gdModel->hosPrice = $v['gdHosPrice'];
            
                $gdModel->num = $v['gdNum'];   
                
                $gdModel->buyLimit = $v['gBuyLimit'];
            
                $gdModel->save();
            }
        }                        
        ///////////////原有商品无套餐，现进行新增  end//////////////
        
        //项目类型
        $mbuyres = $_POST['M']['selected'];
        
        //var_dump($mbuyres);die;
        
        $cnt = count($_POST['M']['selected']);
        
        $mbuyArr = array_values($mbuyres);
        
        $mbuy = array();
        
        for($j=0;$j<$cnt;$j++){
            $mbuy[$j]=$mbuyArr[$j];
        }
        
        //var_dump($mbuy);die;

        if(strlen($_POST['city']) == 0){
            $proSite = 0;
        } else {
            $proSite = $_POST['city'];
        }

        $gModel->proName = $_POST['proName'];

        $gModel->proIntro = $_POST['proIntro'];

        $gModel->hospitalId = $_POST['hisHospid'];

        $gModel->proSite = $proSite;
        
        if(!empty($mbuy[0])){
            $gModel->mbuyType = $mbuy[0];
        }
        if(!empty($mbuy[1])){
            $gModel->mbuyType2 = $mbuy[1];
        }
        if(!empty($mbuy[2])){
            $gModel->mbuyType3 = $mbuy[2];
        }
        $gModel->onshelfTime = $_POST['starttime'];

        $gModel->offshelfTime = $_POST['endtime'];

        $gModel->validateTime = $_POST['valitime'];
        
        $gModel->createTime = Date("Y-m-d H:i:s");
        
        $gModel->lowPrice = $_POST['lowPrice'];
               
        /* 封面图   */
        if(!empty($_POST['carouselimage0'])){
            $gModel->proImage = $_POST['carouselimage0'];
        }
        if(!empty($_POST['carouselimage1'])){
            $gModel->carouselImage2 = $_POST['carouselimage1'];
        }
        if(!empty($_POST['carouselimage2'])){
            $gModel->carouselImage3 = $_POST['carouselimage2'];
        }
        if(!empty($_POST['carouselimage3'])){
            $gModel->carouselImage4 = $_POST['carouselimage3'];
        }
        /* 详情图一 */
        if(!empty($_POST['fproimg0'])){
            $gModel->proImage2 = $_POST['fproimg0'];
        }
        if(!empty($_POST['fproimg1'])){
            $gModel->proImage4 = $_POST['fproimg1'];
        }
        if(!empty($_POST['fproimg2'])){
            $gModel->proImage5 = $_POST['fproimg2'];
        }
        if(!empty($_POST['fproimg3'])){
            $gModel->proImage6 = $_POST['fproimg3'];
        }
        /* 详情图二  */
        if(!empty($_POST['sproimg0'])){
            $gModel->proImage3 = $_POST['sproimg0'];
        }
        if(!empty($_POST['sproimg1'])){
            $gModel->proImage7 = $_POST['sproimg1'];
        }
        if(!empty($_POST['sproimg2'])){
            $gModel->proImage8 = $_POST['sproimg2'];
        }
        if(!empty($_POST['sproimg3'])){
            $gModel->proImage9 = $_POST['sproimg3'];
        }
        /* 详情图三  */
        if(!empty($_POST['tproimg0'])){
            $gModel->effectDrawing = $_POST['tproimg0'];
        }
        if(!empty($_POST['tproimg1'])){
            $gModel->effectDrawing2 = $_POST['tproimg1'];
        }
        if(!empty($_POST['tproimg2'])){
            $gModel->effectDrawing3 = $_POST['tproimg2'];
        }
        if(!empty($_POST['tproimg3'])){
            $gModel->effectDrawing4 = $_POST['tproimg3'];
        }    

        $gModel->proDesc2 = $_POST['proDesc2'];
        
        $gModel->proDesc3 = $_POST['proDesc3'];
        
        $gModel->proDesc4 = $_POST['proDesc4'];

        $gModel->remarks = $_POST['remarks'];

        $gModel->status = -1;
         
        $gModel->save();

        //修改绑定医生
        
        if ($dgModel != null){
        
            $dgModel->docId = $_POST['docId'];
        
            $dgModel->save();
        
        } else {
            
            //不存在  添加医生
            $dgModels = new DoctorGoods();
            
            $dgModels->docId = $_POST['docId'];
            
            $dgModels->goodsId = $gid;
            
            $dgModels->save();                    
        }

        return $this->redirect(['pgoods/unchecked','page'=>$page]);
        
    }

    //详情
    public function actionDetail(){

        $gid = $_GET['gid'];

        //var_dump($gid);var_dump($hospId);die;

        $db=Yii::$app->getDb();

        $sqlPg="select *, g.hospitalId hId, g.remarks gRemark
                from goods g, hospital hos
                where  g.hospitalId = hos.id
                and g.id = $gid" ;

        $pgArr= $db->createCommand($sqlPg)->queryAll();

        //var_dump($pgdgArr);die; 
        
        $sqlDg = "select * 
                  from doctor d, doctorgoods dg 
                  where d.Id = dg.docId and dg.goodsId = $gid";
        
        $dgArr= $db->createCommand($sqlDg)->queryAll();
        
        //var_dump($dgArr);die;

        $sqlMbuy = "select m.mName from goods g LEFT JOIN mbuy m on(g.mbuyType=m.id)
        where g.id = $gid ";

        $mbuyArr= $db->createCommand($sqlMbuy)->queryAll();

        //var_dump($mbuyArr);die;

        $sqlMbuy2 = "select m.mName from goods g LEFT JOIN mbuy m on(g.mbuyType2=m.id)
        where g.id = $gid ";

        $mbuyArr2= $db->createCommand($sqlMbuy2)->queryAll();

        //var_dump($mbuyArr2);die;

        $sqlMbuy3 = "select m.mName from goods g LEFT JOIN mbuy m on(g.mbuyType3=m.id)
        where g.id = $gid ";

        $mbuyArr3= $db->createCommand($sqlMbuy3)->queryAll();

        //var_dump($mbuyArr3);die;

        $sqlSite = "select a.name from goods g LEFT JOIN area a on(g.proSite=a.id)
        where g.id = $gid ";

        $siteArr= $db->createCommand($sqlSite)->queryAll();

        //var_dump($siteArr);die;

        $sqlGdsku="select *
                   from goodsdetails gd, skutype sku
                   where gd.skuTypeId = sku.id and gd.goodsId = $gid ";

        $gdskuArr= $db->createCommand($sqlGdsku)->queryAll();

        //var_dump($gdskuArr);die;


        return $this->render('detail',['gid'=>$gid,
                                        'pgArr'=>$pgArr,
                                        'dgArr'=>$dgArr,
                                        'mbuyArr'=>$mbuyArr,
                                        'mbuyArr2'=>$mbuyArr2,
                                        'mbuyArr3'=>$mbuyArr3,
                                        'siteArr'=>$siteArr,
                                        'gdskuArr'=>$gdskuArr,
        ]);

    }

    //审核通过
    public function actionPass(){

        $gid = $_POST['gid'];

        //var_dump($gid);die;

        $gModel = Goods::findOne($gid);

        $gModel->status = 0;
        
        $gModel->createTime = Date("Y-m-d H:i:s");

        $gModel->save();

        $active = 1;

        return $this->redirect(['pgoods/checkthrough']);

    }

    //审核未通过
    public function actionOverrule(){

        $gid = isset($_POST['gid']) ? $_POST['gid'] : $_GET['gid'];

        //var_dump($gid);die;

        if(!empty($_POST['pro']) && !empty($_POST['adv']) ){

            $gid = $_POST['gids'];
            
            //var_dump($gid);die;
           
            $gModel = Goods::findOne($gid);

            $gModel->reviewpro = $_POST['pro'];

            $gModel->reviewadv = $_POST['adv'];
            
            $gModel->createTime = Date("Y-m-d H:i:s");

            $gModel->status = 3;

            if($gModel->save()){

                return $this->redirect(['pgoods/rejected']);
            }

        }else{

            return $this->render('overrule',['gid'=>$gid]);
        }

    }
     
    //未通过原因及建议
    public function actionReason(){

        $gid = $_GET['gid'];

        $gModel = Goods::findOne($gid);

        return $this->render('reason',['gModel'=>$gModel]);

    }

    //上线中特惠--手动下线
    public function actionDelete(){

        $gid = $_GET['gid'];

        //var_dump($gid);die;

        $gModel = Goods::findOne($gid);
        
        $gModel->status = 2;
        
        $gModel->save();

        //$gModel->delete();

        return $this->redirect(['pgoods/offshelf']);

    }

    //添加top4
    public function actionRecommend(){

        $gl = $_GET['cnt'];
        
        if(!empty($_POST['rec'])){
            
            $gids = $_POST['rec'];

            $recomObj = Goods::find()->where(['id'=>$gids])->one();
    
            $recomObj->goodslocation = $_POST['rg']+1;                                               
            
            $recomObj->save();
                
            return $this->redirect(['pgoods/toplist']);
        }else{          
            return $this->render('recommend',['gl'=>$gl]);
        }
    }
    
    //删除top4
    public function actionDeletetop($id){
        
        $recomObj = Goods::find()->where(['id'=>$id])->one();
        
        $recomObj->goodslocation = 0;
        
        $recomObj->save();
        
        return $this->redirect(['pgoods/toplist']);
    }
    
    //检查特惠状态
    public function actionCheckstatus(){
        
        $gid = $_POST['gid'];   
        
        $gl = $_POST['gl'];
        
        $data = array('id'=>$gid);
        
        $res = Goods::findOne($data);     
        
        $db=Yii::$app->getDb();
               
        $sql="select g.id
              from goods g 
              where g.status = 1 and g.goodslocation > 0";
        
        $rgArr= $db->createCommand($sql)->queryAll();
                
        foreach($rgArr as $v){
            if($v['id'] == $gid){
                $arr['status'] = 2;
                return json_encode($arr);
            }
        }
        
        if($res['status'] == 1){
            $arr['status'] = 1;
            return json_encode($arr);
        }else{
            $arr['status'] = 0;
            return json_encode($arr);
        }
    }     

    //删除图片
    public function actionOffline(){

        $gid = $_GET['gid'];

        $offlineObj = Goods::find()->where(['id'=>$gid])->one();

        //var_dump($offlineObj['proImage']);die;
        $offlineObj->proImage="";
        
        $offlineObj->proImage2="";
        
        $offlineObj->proImage3="";
        
        $offlineObj->effectDrawing="";
        
        $offlineObj->createTime = Date("Y-m-d H:i:s");

        $active = -1;

        if($offlineObj->save()){
            return $this->redirect(['pgoods/unchecked']);
        }else{
            echo "删除图片失败！";
        }

    }
    
    public function actionLowestprepay(){
        
        $pag=$_GET['page'];
        
        //全部特惠商品
        
        $db=Yii::$app->getDb();
        
        $cntsql="select count(*)
                 from goods g LEFT JOIN area a on(g.proSite=a.id)
                 LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
                 where g.hospitalId = hos.id
                 and g.status = 1 ";
        
        $ww= $db->createCommand($cntsql)->queryAll();
        
        $cnt=$ww['0']['count(*)'];
        
        $per=6;
        
        $page=new Pagination($cnt,$per);
        
        $page_list=$page->fpage();
        
        //var_dump($page_list);die;
        
        $sql="select g.proName, m.mName, a.name, hos.hospitalName, g.hospitalId,
              g.status, g.onshelfTime,g.offshelfTime, g.mlowPrice, g.recommend, g.id gId
              from goods g LEFT JOIN area a on(g.proSite=a.id)
              LEFT JOIN mbuy m on(g.mbuyType=m.id), hospital hos
              where g.hospitalId = hos.id   
              and g.status = 1
              order by g.mlowPrice $page->limit ";
        
        $pgArr= $db->createCommand($sql)->queryAll();
        
        foreach ($pgArr as $k=>$v) {
            $pgArr[$k]['pag'] = $pag;
        }
        
        $active = -1;
        
        return $this->render('pgindex',['page_list'=>$page_list,
                                        'pgArr'=>$pgArr,
                                        'active'=>$active,
        ]);
        
        
    }
    
    /* 修改状态成为免费医美 */
    public function actionChangestatus($gid){
        
        $gid = $_GET['gid'];
        
        $db=Yii::$app->getDb();
        
        $gesql="select * from goodsext ge
                 where ge.goodsId = $gid ";
        
        $ww= $db->createCommand($gesql)->queryAll();        
        
        $gModel = Goods::findOne($gid);
        
        $gModel->status = 5;
        
        $gModel->reserveNum = 0;
        
        $gModel->save();
        
        if(empty($ww)){
        
            $gextModel = new Goodsext();
            
            $gextModel->goodsId = $gid;
            
            $gextModel->save();  
        }
        //$gModel->delete();
        
        return $this->redirect(['freeplastics/index']);               
    }   

    //上传图片---产品封面图
    public function actionUploadcarouselimage(){
        
        $file=$_FILES;
        
        if(count($file['headimage']['name'])>4){
            $arr['code']=2;
            return json_encode($arr);
        }else{
             
            $target_path=null;
        
            try{
                $target_path  = "";
                $target_path= FeiLiTools::CreateMoodDir("uploads","goods/carousel/".date('Y-m-d',time()));
            }catch(\exception $e){
        
            }
             
            for($i=0;$i<count($file['headimage']['name']);$i++ ){
                 
                $file['headimage']['name'][$i] = strtotime("now").mt_rand(1,10000).".".substr(strrchr($file['headimage']['name'][$i], '.'), 1);
                 
                $file['headimage']['thumb_name'][$i] = strtotime("now").mt_rand(1,10000).'thumb.'.substr(strrchr($file['headimage']['name'][$i], '.'), 1);
                 
                $move= move_uploaded_file($file['headimage']['tmp_name'][$i], $target_path.$file['headimage']['name'][$i]);
                 
                FeiLiTools::img2thumb1($target_path.$file['headimage']['name'][$i],$target_path.$file['headimage']['thumb_name'][$i],640,640);
                 
                $basedir= Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.'/';
        
                $image[$i]=$basedir.$target_path.$file['headimage']['thumb_name'][$i];
            }
             
            if($move){
                $arr['code']=1;
                $arr['src']=$image;
                return json_encode($arr);
            }else{
                $arr['code']=0;
                return json_encode($arr);
            }
        }        
    }
    
    //上传图片---产品详情图一
    public function actionUploadproimage1(){
    
        $file=$_FILES;
    
        if(count($file['headimage']['name'])>4){
            $arr['code']=2;
            return json_encode($arr);
        }else{
             
            $target_path=null;
    
            try{
                $target_path  = "";
                $target_path= FeiLiTools::CreateMoodDir("uploads","goods/proimage1/".date('Y-m-d',time()));
            }catch(\exception $e){
    
            }
             
            for($i=0;$i<count($file['headimage']['name']);$i++ ){
                 
                $file['headimage']['name'][$i] = strtotime("now").mt_rand(1,10000).".".substr(strrchr($file['headimage']['name'][$i], '.'), 1);
                 
                $file['headimage']['thumb_name'][$i] = strtotime("now").mt_rand(1,10000).'thumb.'.substr(strrchr($file['headimage']['name'][$i], '.'), 1);
                 
                $move= move_uploaded_file($file['headimage']['tmp_name'][$i], $target_path.$file['headimage']['name'][$i]);
                 
                FeiLiTools::img2thumb1($target_path.$file['headimage']['name'][$i],$target_path.$file['headimage']['thumb_name'][$i],640,640);
                 
                $basedir= Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.'/';
    
                $image[$i]=$basedir.$target_path.$file['headimage']['thumb_name'][$i];
            }
             
            if($move){
                $arr['code']=1;
                $arr['src']=$image;
                return json_encode($arr);
            }else{
                $arr['code']=0;
                return json_encode($arr);
            }
        }
    }
    
    //上传图片---产品封面图二
    public function actionUploadproimage2(){
    
        $file=$_FILES;
     
        if(count($file['headimage']['name'])>4){
            $arr['code']=2;
            return json_encode($arr);
        }else{
             
            $target_path=null;
    
            try{
                $target_path  = "";
                $target_path= FeiLiTools::CreateMoodDir("uploads","goods/proimage2/".date('Y-m-d',time()));
            }catch(\exception $e){
    
            }
             
            for($i=0;$i<count($file['headimage']['name']);$i++ ){
                 
                $file['headimage']['name'][$i] = strtotime("now").mt_rand(1,10000).".".substr(strrchr($file['headimage']['name'][$i], '.'), 1);
                 
                $file['headimage']['thumb_name'][$i] = strtotime("now").mt_rand(1,10000).'thumb.'.substr(strrchr($file['headimage']['name'][$i], '.'), 1);
                 
                $move= move_uploaded_file($file['headimage']['tmp_name'][$i], $target_path.$file['headimage']['name'][$i]);
                 
                FeiLiTools::img2thumb1($target_path.$file['headimage']['name'][$i],$target_path.$file['headimage']['thumb_name'][$i],640,640);
                 
                $basedir= Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.'/';
    
                $image[$i]=$basedir.$target_path.$file['headimage']['thumb_name'][$i];
            }
             
            if($move){
                $arr['code']=1;
                $arr['src']=$image;
                return json_encode($arr);
            }else{
                $arr['code']=0;
                return json_encode($arr);
            }
        }
    }
    
    //上传图片---产品封面图三
    public function actionUploadproimage3(){
    
        $file=$_FILES;
    
        if(count($file['headimage']['name'])>4){
            $arr['code']=2;
            return json_encode($arr);
        }else{
             
            $target_path=null;
    
            try{
                $target_path  = "";
                $target_path= FeiLiTools::CreateMoodDir("uploads","goods/proimage3/".date('Y-m-d',time()));
            }catch(\exception $e){
    
            }
             
            for($i=0;$i<count($file['headimage']['name']);$i++ ){
                 
                $file['headimage']['name'][$i] = strtotime("now").mt_rand(1,10000).".".substr(strrchr($file['headimage']['name'][$i], '.'), 1);
                 
                //$file['headimage']['thumb_name'][$i] = strtotime("now").mt_rand(1,10000).'thumb.'.substr(strrchr($file['headimage']['name'][$i], '.'), 1);
                 
                $move= move_uploaded_file($file['headimage']['tmp_name'][$i], $target_path.$file['headimage']['name'][$i]);
                 
                //FeiLiTools::img2thumb1($target_path.$file['headimage']['name'][$i],$target_path.$file['headimage']['thumb_name'][$i],640);
                 
                $basedir= Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.'/';
    
                //$image[$i]=$basedir.$target_path.$file['headimage']['thumb_name'][$i];
                $image[$i]=$basedir.$target_path.$file['headimage']['name'][$i];
            }
             
            if($move){
                $arr['code']=1;
                $arr['src']=$image;
                return json_encode($arr);
            }else{
                $arr['code']=0;
                return json_encode($arr);
            }
        }
    }
       
    
  /*   //复制商品
    public function actionCopy(){
        
        $goodsId = $_GET['gid'];
        
        $db=Yii::$app->getDb();
        
        $sql = "select g.proName, g.proIntro, g.proDesc2, g.proDesc3, g.proDesc4, g.proSite, 
               g.lowPrice, g.highPrice, g.mlowPrice, 
               g.mbuyType, g.mbuyType2, g.mbuyType3, g.hospitalId,
               g.proImage, g.proImage2, g.proImage3, g.effectDrawing,
               g.onshelfTime, g.offshelfTime, g.validateTime, 
               g.remarks
               from goods g 
               where id = $goodsId";
        
        $pgArr= $db->createCommand($sql)->queryAll();               
                
        //1、连接数据库
        $link = mysql_connect("localhost","root","");
        
        mysql_query("SET NAMES 'UTF8'",$link);
        
        //2、应用数据库
        mysql_select_db("pxm");

        if(!empty($pgArr)){
            
            $query = "insert into goods
				     (proName, proIntro, proDesc2, proDesc3, proDesc4, proSite,
                      lowPrice, highPrice, mlowPrice,
                      mbuyType, mbuyType2, mbuyType3, hospitalId,
                      proImage, proImage2, proImage3, effectDrawing,
                      onshelfTime, offshelfTime, validateTime, remarks) 
                      values
				     ('".$pgArr[0]['proName']."',
				      '".$pgArr[0]['proIntro']."',
				      '".$pgArr[0]['proDesc2']."',
				      '".$pgArr[0]['proDesc3']."',
				      '".$pgArr[0]['proDesc4']."',
				      '".$pgArr[0]['proSite']."',
				      '".$pgArr[0]['lowPrice']."',
				      '".$pgArr[0]['highPrice']."',
				      '".$pgArr[0]['mlowPrice']."',
				      '".$pgArr[0]['mbuyType']."',    
				      '".$pgArr[0]['mbuyType2']."',
				      '".$pgArr[0]['mbuyType3']."',
				      '".$pgArr[0]['hospitalId']."',   
				      '".$pgArr[0]['proImage']."',
				      '".$pgArr[0]['proImage2']."',
				      '".$pgArr[0]['proImage3']."',    
				      '".$pgArr[0]['effectDrawing']."',
				      '".$pgArr[0]['onshelfTime']."',
				      '".$pgArr[0]['offshelfTime']."',    
				      '".$pgArr[0]['validateTime']."',
				      '".$pgArr[0]['remarks']."')";
           
            $result = mysql_query($query);
                           
            if($result){
                echo "添加成功";
                
                //return $this->redirect(['pgoods/pgindex']);
                
            }else{
                echo "添加失败".mysql_error();
            }               
        }
        
        //SELECT * from 你要查的表名 where 自增长的主键/日期=(select max(主键/日期) from 你要查的表名)
        
        $sqlGid = "select max(id) maxGid from goods";
        
        $gidArr= $db->createCommand($sqlGid)->queryAll();
        
        //var_dump($gidArr);die;
        
        $skusql = "select gd.id, gd.goodsId, gd.skuTypeId, gd.lowPrice, gd.price,
                   gd.setPrice, gd.hosPrice, gd.num, gd.buyLimit, sku.name, sku.specification
                   from skutype sku, goodsdetails gd
                   where gd.skuTypeId = sku.id
                   and gd.goodsId = $goodsId ";
        
        $gdskuArr= $db->createCommand($skusql)->queryAll();
        
        //var_dump($gdskuArr);die;
        
        foreach ($gdskuArr as $k=>$v){
        
            $query2 = "insert into skutype
				      (name, specification)
                      values
				      ('".$v['name']."',
				      '".$v['specification']."')";
             
            $result2 = mysql_query($query2);
        }
        
        echo $result2;die;
        
        
        mysql_close();
                 
    }
     */
    
    
    
    
}