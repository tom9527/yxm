<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	<h3 style="text-align:center;">TOP4列表</h3>
	
	<div>
		<a class="btn btn-primary" style="color:#fff;font-size: 14px; float:left;margin-right:5px;border-radius:5px;" href="index.php?r=pgoods/pgindex">返回特惠列表</a>
		<?php if($top_cnt < 4){?>	
        <a class="btn btn-primary" style="color:#fff;font-size: 14px; float:right;margin-right:5px;border-radius:5px;" href="index.php?r=pgoods/recommend&cnt=<?php echo $top_cnt;?>">添加TOP4</a>
    	<?php }else{ ?>
    	<a class="btn btn-danger" style="color:#fff;font-size: 14px; float:right;margin-right:5px;border-radius:5px;">TOP4已满</a>
    	<?php }?>    
    </div>
    
    <hr class="hr">
     	<div>
     		<table style="font-size: 1.5rem" class="table table-striped">
     			<tr>
                  <th>Id</th>
                  <th>标题</th>
                  <th>项目类型</th>
                  <th>地区</th>
                  <th>医院</th>                 
                  <th>上架时间</th>
                  <th>下架时间</th>                  
                  <th>操作</th>
               </tr>
               
              <?php foreach($top as $k=>$v){?>
               <tr>
                  <td><?php echo $v['gId']?></td>
                  <td><?php echo $v['proName'];?></td>
                  <td><?php echo $v['mName'];?></td>
                  <td><?php echo $v['name'];?></td>
                  <td><?php echo $v['hospitalName'];?></td>                                    
                  <td><?php echo $v['onshelfTime'];?></td>
                  <td><?php echo $v['offshelfTime'];?></td>               	  
               	  <td>                 	  	              	  	                 	  	               	  	
               	  	<a class="btn btn-inverse" style="color:#fff;" href="index.php?r=pgoods/deletetop&id=<?php echo $v['id']?>">移除</a>&nbsp;&nbsp;              
               	  </td>
               </tr>    
               <?php }?>                                 
          </table>

          <div style="text-align: center;margin-top: 20px;">
          	<?php if($top_cnt<4){?>
          		已推荐  <?php echo $top_cnt; ?>  个, 还可推荐  <?php echo 4-$top_cnt; ?>  个
          	<?php }else{?>
          		TOP4已满
          	<?php }?>
          </div>
   	</div>
	
	
</body>
</html>