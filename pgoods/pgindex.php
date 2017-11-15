<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$username=$_SESSION['username'];

?>

	<div style="width:100%;height:100px;" class="goodslist">

    <h3 align="center">特惠商品列表</h3><br/><br/>
    
	<div>
        <a class="btn btn-primary" style="color:#fff;font-size: 14px; float:right;margin-right:5px;border-radius:5px;" href="index.php?r=pgoods/create">添加特惠</a>
    </div>    
      
    
    <?php if(Yii::$app->session->get('item') == 'root' || Yii::$app->session->get('item') == 'admin' || Yii::$app->session->get('item') == 'BD' || Yii::$app->session->get('item') == 'yun'){ ?>        
    <div>
        <button style="font-size: 14px; float:right;margin-right:10px;border-radius:5px;" class="btn btn-primary search-btn" id="search-btn">
            <a style="color:#fff;" href="javascript:;">搜索</a>
    	</button>
    </div>    
    <?php }?>         
              <!-- 搜索弹出框            -->
              <form class="popup" role="form"  action="index.php?r=pgoods/search" method="post" >
                  <div class="Li-li1">
                      <div class="Inline">状态</div>
                      <div class="Inline1 form-group">
                        <select class="form-control" name="g_status" >
                            <option value="" >全部</option>
                            <option value="-1" >待审核</option>
                            <option value="0" >待上架</option>
                            <option value="1" >已上架</option>
                            <option value="2" >已下架</option>
                            <option value="3" >审核未通过</option>
                         </select>
                      </div>
                  </div>
                  <div class="Li-li1">
                       <div class="Inline">Id</div>
                       <input type="text" class="Inline1" name="g_id"/>
                  </div>
                   <div class="Li-li1">
                       <div class="Inline">地区</div>
                       <input type="text" class="Inline1" name="site_name"/>
                  </div>
                  <div class="Li-li1">
                       <div class="Inline">医院</div>
                       <input type="text" class="Inline1" name="hospitalName"/>
                  </div>
                   <div class="Li-li1">
                       <div class="Inline">项目类型</div>
                       <input type="text" class="Inline1" name="mName" />
                  </div>
                  
                  <div class="form-group creat">
                     <label for="dtp_input1" class="col-md-3 control-label" style="margin-left:35px;" >上架时间</label>
                     <div  class="input-group date form_datetime col-md-5" data-date="2016-10-24T05:25:07Z" data-date-format="" data-link-field="dtp_input1">
                         <input class="form-control" size="16" name="starttime" type="text" value="" readonly>
                         <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                         <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                     </div>
                     <input type="hidden" id="dtp_input1" value="" />             
    			  </div>
    
                  <div class="form-group creat">
                        <label for="dtp_input1" class="col-md-3 control-label" style="margin-left:35px;" >至</label>
                        <div class="input-group date form_datetime col-md-5" data-date="2016-10-24T05:25:07Z" data-date-format="" data-link-field="dtp_input1">
                            <input class="form-control" size="16"  name="endtime" type="text" value="" readonly required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                        <input type="hidden" id="dtp_input1" value="" />
                  </div>
                                    
                  <div class="Li-li2" >
                      <div class="Search" >
                      	  <input type="submit" value="搜&nbsp;&nbsp;&nbsp;索" style="border:0;outline:none;background:lightblue"/>
                      </div>
                      <div class="Remove" >
                      	  <input type="reset" value="清&nbsp;&nbsp;&nbsp;空" style="border:0;outline:none;background:#C2C2C2"/>
                      </div>
                  </div>
                  <button type="button" class="up" >收起</button>
              </form>
              
     </div>
     <br/><br/>
          
      <ul class="nav nav-tabs">
          <li role="presentation" class="<?php if($active==-1) echo "active";?>"><a href="index.php?r=pgoods/pgindex">全部特惠</a></li>
          <li role="presentation" class="<?php if($active==0) echo "active";?>"><a href="index.php?r=pgoods/unchecked">待审核</a></li>
          <li role="presentation" class="<?php if($active==1) echo "active";?>"><a href="index.php?r=pgoods/checkthrough">待上架</a></li>
          <li role="presentation" class="<?php if($active==2) echo "active";?>"><a href="index.php?r=pgoods/onshelf">已上架</a></li>
          <li role="presentation" class="<?php if($active==3) echo "active";?>"><a href="index.php?r=pgoods/offshelf">已下架</a></li>
          <li role="presentation" class="<?php if($active==4) echo "active";?>"><a href="index.php?r=pgoods/rejected"><span style='color:red;'>审核未通过</span></a></li>
          <?php if(Yii::$app->session->get('item') == 'root' || Yii::$app->session->get('item') == 'admin' || Yii::$app->session->get('item') == 'BD' || Yii::$app->session->get('item') == 'yun'){ ?>
          <li role="presentation" class="<?php if($active==5) echo "active";?>"><a href="index.php?r=pgoods/toplist"><span style='color:green;'>TOP4</span></a></li>
      	  <?php }?>
      </ul>
       
     <hr class="hr">
     	<div>
     		<table style="font-size: 1.5rem" class="table table-striped">
     			<tr>
                  <th>Id</th>
                  <th>标题</th>
                  <th>项目类型一</th>
                  <th>地区</th>
                  <th>医院</th>
                  <th>状态</th>
                  <th>
                      <?php if($active==-1){?>
                      	<a href="index.php?r=pgoods/lowestprepay">最低预约款</a>
                      <?php } else {?>
                      	最低预约款
                      <?php }?>
                  </th>
                  <th>上架时间</th>
                  <th>下架时间</th>
                  <!-- <th>最低价格</th> -->
                  <th>操作</th>
               </tr>

               <?php foreach($pgArr as $k=>$v){?>
               <tr>
                  <td><?php echo $v['gId']?></td>
                  <td><?php echo $v['proName'];?></td>
                  <td><?php echo $v['mName'];?></td>
                  <td><?php echo $v['name'];?></td>
                  <td><?php echo $v['hospitalName'];?></td>                  
                  <td><?php
                      if($v['status']==-1){
                          echo "待审核";
                      }else if($v['status']==0){
                          echo  "待上架";
                      }else if($v['status']==1){
                          echo  "已上架";
                      }else if($v['status']==2){
                          echo  "已下架";
                      }else if($v['status'] ==3){
                          echo  "<span style='color:red;'>审核未通过</span>";
                      }                          
                  ?>
                  </td>
                  <td><?php echo $v['mlowPrice']*0.1;?> </td>
                  <td><?php echo $v['onshelfTime'];?></td>
                  <td><?php echo $v['offshelfTime'];?></td>
                  <!-- <td>/* <//?php echo $v['mlowPrice'];?> */</td>      -->           
                  <td>                                           
                  	<?php if ($v['status']==-1 ){?>
                  		<a class="btn btn-success" style="color:#fff;" target="_blank" href="index.php?r=pgoods/detail&gid=<?php echo $v['gId']?>">详情</a>&nbsp;&nbsp;
                  		<a class="btn btn-danger" style="color:#fff;" href="index.php?r=pgoods/offline&gid=<?php echo $v['gId']?>&&page=<?php echo $v['pag'];?>">删除图片</a>&nbsp;&nbsp;
                  		<?php if(Yii::$app->session->get('username') == 'root' || Yii::$app->session->get('username') == 'admin'){?>
                  			<a class="btn btn-warning" style="color:#fff;" href="index.php?r=pgoods/changestatus&gid=<?php echo $v['gId']?>">成为免费医美</a>&nbsp;&nbsp;
                  		<?php }?>
                  	<?php }else if ($v['status'] ==3){?>	
                  		<a class="btn btn-inverse" style="color:#fff;" target="_blank" href="index.php?r=pgoods/reason&gid=<?php echo $v['gId']?>">失败原因及建议</a>&nbsp;&nbsp;
                  	<?php }?>
                  	<a class="btn btn-primary" style="color:#fff;" target="_blank" href="index.php?r=pgoods/update&gid=<?php echo $v['gId']?>&&page=<?php echo $v['pag'];?>">修改</a>&nbsp;&nbsp;                 	                  	                  	                 	
                 	<?php  if($v['status']==1){?>
                  		<a class="btn btn-warning" style="color:#fff;" href="index.php?r=pgoods/delete&gid=<?php echo $v['gId']?>&&page=<?php echo $v['pag'];?>">手动下线</a>&nbsp;&nbsp;                 
                  		<?php if(Yii::$app->session->get('username') == 'root' || Yii::$app->session->get('username') == 'admin'){?>
                  		<a class="btn btn-inverse" style="color:#fff;" href="index.php?r=pgoods/recommend&gid=<?php echo $v['gId']?>&&page=<?php echo $v['pag'];?>">排序</a>&nbsp;&nbsp; 
                  	<?php }}?>
<!--                   	</?php if ($v['status']==-1 ){?> 
                  		<a class="btn btn-success" style="color:#fff;" href="index.php?r=pgoods/copy&gid=<?php echo $v['gId']?>">复制</a>&nbsp;&nbsp;              
<!--                   	</?php }?> -->
                  </td>
              </tr>
              <?php };?>
          </table>

          <div style="text-align: center;margin-top: 20px;"><?php echo $page_list; ?></div>
   	</div>
   	
<script type="text/javascript" src="datepick/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="datepick/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="datepick/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="datepick/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $('.form_date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
</script>   	