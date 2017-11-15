<br/><div style="font-size:24px;font-family: 微软雅黑;">
   <div>特惠详情</div>
   <!-- <input class="btn btn-primary" style="float:right;margin-right:5%;" type="button" value="返回" onclick="history.go(-1)"> -->	
</div><br/>

<div style="float:left;width:63%;position:relative;">
	<table class="table table-bordered" style="width:50%;">
    	<tr>
    		<th width="120px">所属医院</th>
    		<td><?php echo $pgArr[0]['hospitalName'];?></td>
    	</tr>
    	<tr>
    		<th >标题</th>
    		<td><?php echo $pgArr[0]['proName'];?></td>
    	</tr>
    	<tr>
    		<th>副标题</th>
    		<td><?php echo $pgArr[0]['proIntro'];?></td>
    	</tr> 
    	<tr>
    		<th>项目类型一</th>
    		<td><?php echo $mbuyArr[0]['mName'];?></td>
    	</tr>
    	<tr>
    		<th>项目类型二</th>
    		<td><?php echo $mbuyArr2[0]['mName'];?></td>
    	</tr>
    	<tr>
    		<th>项目类型三</th>
    		<td><?php echo $mbuyArr3[0]['mName'];?></td>
    	</tr>
    	<tr>
    		<th>医生</th>
    		<td><?php echo $dgArr[0]['docName'];?></td>
    	</tr>  
    	<tr>
    		<th>城市</th>
    		<td><?php echo $siteArr[0]['name'];?></td>
    	</tr> 	
    	<tr>
    		<th>上架时间</th>
    		<td><?php echo $pgArr[0]['onshelfTime'];?></td>
    	</tr> 
    	<tr>
    		<th>下架时间</th>
    		<td><?php echo $pgArr[0]['offshelfTime'];?></td>
    	</tr> 
    	<tr>
    		<th>活动有效期</th>
    		<td><?php echo $pgArr[0]['validateTime'];?></td>
    	</tr>
    	<tr>
    		<th>市场价</th>
    		<td><?php echo $pgArr[0]['lowPrice'];?></td>
    	</tr>     	   	
    	<tr>
    		<th>颜小美最低价</th>
            <td><?php echo $pgArr[0]['mlowPrice'];?></td>
    	</tr>
    	<tr>		
    		<th>产品详情描述一</th>
            <td><?php echo $pgArr[0]['proDesc2'];?></td>
    	</tr>
    	<tr>		
    		<th>产品详情描述二</th>
            <td><?php echo $pgArr[0]['proDesc3'];?></td>
    	</tr>
    	<tr>		
    		<th>产品详情描述三</th>
            <td><?php echo $pgArr[0]['proDesc4'];?></td>
    	</tr>
    	<tr>		
    		<th>备注</th>
            <td><?php echo $pgArr[0]['gRemark'];?></td>
    	</tr>	
	</table>
	
	<h3 style="font-size:24px;font-family: 微软雅黑;">套餐详情</h3>
	<table class="table table-bordered">
		<th>商品规格名称</th>
		<th>规格</th>
		<th>总价</th>
		<th>预付款</th>
		<th>到医院付</th>
		<th>数量</th>
		<th>套餐限购</th>	
		
		<?php foreach ($gdskuArr as $k=>$v){?>	
		<tr>
			<td><?php echo $v['name']; ?></td>
			<td><?php echo $v['specification']; ?></td>
			<td><?php echo $v['price']; ?></td>
			<td><?php echo $v['setPrice']; ?></td>
			<td><?php echo $v['hosPrice']; ?></td>
			<td><?php echo $v['num']; ?></td>
			<td><?php echo $v['buyLimit']; ?></td>		
		</tr>
		<?php }?>		
	</table><br/>
	<?php if(Yii::$app->session->get('item') == 'root' || Yii::$app->session->get('item') == 'admin' || Yii::$app->session->get('item') == 'BD'){?>	
    	<div style="width: 200px;position:absolute;right:10px;top:200px">
            <form action="index.php?r=pgoods/pass" method="post" >
            	<input type="hidden" name="gid" value="<?php echo $gid;?>" />
            	<input class="btn btn-primary"  type="submit" name="pass" value="审核通过！"/>
            </form>
    	</div><br/>
        
        <div style="width: 200px;position:absolute;right:10px;top:280px">   
            <form action="index.php?r=pgoods/overrule" method="post" >
            	<input type="hidden" name="gid" value="<?php echo $gid;?>" />
            	<input class="btn btn-danger" type="submit" name="overrule" value="不予通过！" />   	
            </form>
        </div>    
    <?php }?>
			
</div>

<div style="float:right;width:30%;margin-right:60px;">
	<br/><b><p style="text-align: center;">产品封面图片</p></b>
	<p style="text-align: center;"><img style="width:200px;height:150px;" src="<?php echo $pgArr['0']['proImage'];?>"></p>
	<br/><b><p style="text-align: center;">产品图片1</p></b>
	<p style="text-align: center;"><img style="width:200px;height:150px;" src="<?php echo $pgArr['0']['proImage2'];?>"></p>
	<br/><b><p style="text-align: center;">产品图片2</p></b>
	<p style="text-align: center;"><img style="width:200px;height:150px;" src="<?php echo $pgArr['0']['proImage3'];?>"></p>
	<br/><b><p style="text-align: center;">产品效果图</p></b>
	<p style="text-align: center;"><img style="width:200px;height:150px;" src="<?php echo $pgArr['0']['effectDrawing'];?>"></p> 	
</div>