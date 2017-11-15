<script type="text/javascript" src="assets/common/rili-js/laydate.js"></script>
<link rel="stylesheet" type="text/css" href="datepick/csss/creat.css">
<div style="width:743px;height: 42px;background: #eeeeee;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;text-indent: 18px;font-size: 22px;line-height: 42px;color: #363636;margin-top: 40px;font-family: 'microsoft yahei';">
  		添加特惠
</div>	   

<form enctype="multipart/form-data" action="index.php?r=pgoods/add" method="post" >
	<!--新添加的-->
	<ul style="width: 675px;height: auto;margin-left: 70px;margin-top: 28px;">
		<!--所属医院-->
		<li style="width: 100%;height:52px ;color: #5a5a5a;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					<em style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;">所属医院</em>
  			</div>
  			<?php if(in_array($item,$itemCon)){?>
  			<div style="width: 527px;height:60px ;float: left;">
  				 <input id="kw" autocomplete="off" name="Doctor[hospitalname]" onKeyup="getContent(this);" style="width:527px;height: 38px;outline: none;border: 0;border: 1px solid #CDCDCD;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;text-indent: 25px;" class="form-control" id="exampleInputEmail1" required="required"/>
  				 <span style="color:#ff9191;font-size: 13px;">不能手动全部输入，请点击，下面输入框的提示医院</span>
  				 <input id="haha" type="hidden" name="hisHospid" value="">
  				 	 <div id="append" style="width: 370px;height: 160px;overflow: scroll;background: #FFFFFF;display: none;z-index: 99;border: 1px solid #C0C4CD;"></div>
  			</div>
  			<?php } else {?>
  			<div class="form-group" >
                <label for="exampleInputEmail1"><span ><?php echo $hospitalArr[0]['hospitalName'];?></span></label>
        		<input type="hidden" name="hisHospid" value="<?php echo $hospitalArr[0]['id'];?>"/>
			</div>	
			<?php }?>
  		</li>
  		<!--主标题-->
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					<em style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;">主标题</em>
  			</div>
  			<div style="width: 527px;height:60px ;float: left;">
  				 <input name="proName" style="width:527px;height: 38px;outline: none;border: 0;border: 1px solid #CDCDCD;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;text-indent: 25px;"  required="required" placeholder="填写服务类别，如：玻尿酸、韩式双眼皮或自体脂肪丰胸等" onfocus="this.placeholder=''" onblur="this.placeholder='填写服务类别，如：玻尿酸、韩式双眼皮或自体脂肪丰胸等'" />
  				 <span style="color: #ff9191;font-size: 13px;">(只填文字，请不要添加【】)</span>
  			</div>
  		</li>
  		<!--副标题-->
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					<em style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;">副标题</em>
  			</div>
  			<div style="width: 527px;height:60px ;float: left;">
  				 <input name="proIntro" style="width:527px;height: 38px;outline: none;border: 0;border: 1px solid #CDCDCD;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;text-indent: 25px;"  required="required" placeholder="形容服务项目，用于包装产品的名字，如：侧脸女王，高挺美鼻不是梦" onfocus="this.placeholder=''" onblur="this.placeholder='填写服务类别，如：玻尿酸、韩式双眼皮或自体脂肪丰胸等'"/>
  				 <span style="color: #ff9191;font-size: 13px;">(形容服务项目，用于包装产品的名字，如：侧脸女王，高挺美鼻不是梦)</span>
  			</div>
  		</li>
  		<!--项目类型-->
  		<li style="width: 100%;min-height:60px ;height: auto!important;height: 60px;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					<em style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;">项目类型</em>
  			</div>
  			<div style="width: 527px;min-height:60px ;height: auto!important;height: 60px;float: left;position: relative;">
  				<div style="width:438px;min-height: 38px;height: auto!important;height: 38px;outline: none;border: 0;border: 1px solid #CDCDCD;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;display: inline-block;" class="listBox">
      				<div id="mbuyIdholder" style='margin-left: 18px;margin-top: 10px;display: inline-block;'>
      				
      				</div>
  				</div>
  				 <span style="font-size: 13px;width: 80px;height: 38px;background: #ff9a9a;color: #FFFFFF;display: inline-block;vertical-align: top;-moz-border-radius: 12px;-webkit-border-radius: 12px;border-radius: 12px;text-align: center;line-height: 38px;font-size: 18px;" id="add">+添加</span>
  				 <!--项目弹框-->
  				 <div style="width: 560px;min-height:700px ;height: auto!important;height: 700px;position: absolute;left: 0;top: -340px;background: #f7f7f7;display: none;" id="tanchuang">
  				 	<div style="width: 100%;height: 50px;font-size: 20px;text-align: center;line-height: 50px;background: #e2e6ef;color: #000000;">选择项目类型(最多三个)</div>
  				 	<!--已选项目-->
  				 	<div style="width: 480px;min-height: 100px;height: auto!important;height:100px;margin: 0 auto;margin-top: 20px;margin-bottom: 20px;">
  				 		<div style="width: 70px;height:100px ;float: left;display: inline-block;font-size: 16px;padding-top: 16px;">已选项目:</div>
  				 		<div style="width:410px ;min-height:100px ;height:auto!important ;height:100px ;float: left;display: inline-block;border: 1px solid #e1e6eb;background: #FFFFFF;padding-left: 10px;padding-top: 10px;" id="selected"></div>
  				 	</div>
  				 	<!--选项目-->
  				 	<div style="width: 480px;min-height:200px ;height:auto!important ;height:200px ;margin: 0 auto;display: flex;">
  				 		<div style="width: 70px;height:200px ;float: left;display: inline-block;font-size: 16px;padding-top: 16px;">选项目:</div>
  				 		<div style="width:410px ;min-height:200px ;height:auto!important ;height:200px ;float: left;display: inline-block;border: 1px solid #e1e6eb;background: #FFFFFF;padding-top: 20px;">
  				 			<!--项目左边列表-->
  				 			<ul style="width: 100px;height: 400px;overflow:scroll;float: left;display: inline-block;" id="xiangmuList"  >  				 				 		 				
  				 				<?php foreach($mbuyArr as $v){?>  				 					
  				 					<li onclick="onclickList(<?php echo $v['id'];?>)" style="text-align: center;height: 40px;line-height: 40px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;font-size: 14px;"  >  				 					
  				 						<?php echo $v['mName'];?>  				 					
  				 					</li>
  				 				<?php }?>  				 				
  				 			</ul>
  				 			<!--项目右边选项-->
  				 			<ul style="width: 307px;height: 400px;overflow: scroll;float: left;display: inline-block;background: #f2f2f2;" id="xiangmuDetail">  			 				
  				 				<!--  <li style="height: 25px;line-height: 25px;font-size: 14px;background: #FFFFFF;text-align: center;min-width: 60px;width: auto!important;width: 60px;display: inline-block;margin-top: 8px;border-radius: 2px;padding-left: 6px;padding-right: 6px;margin-right: 8px;"></?php echo $value['name'];?></li>-->  				 				
  				 			</ul>  				 			
  				 		</div>
  				 	</div>
  				 	<!--关闭    确定-->
  				 	<div style="width: 480px;height:54px ;margin: 0 auto;margin-top: 20px;">
  				 		<div style="width: 110px;height:40px ;font-size: 22px;background:#C9C9C9 ;text-align: center;line-height: 40px;color: #FFFFFF;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;display: inline-block;margin-left: 98px;" id="closeBox">关闭</div>
  				 		<div style="width: 110px;height:40px ;font-size: 22px;background:#ff9a9a ;text-align: center;line-height: 40px;color: #FFFFFF;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;margin-left: 106px;display: inline-block;" id="conmit">确定</div>
  				 	</div>
  				 </div>
  			</div>
  		</li>
  		
  		<?php if(in_array($item,$itemCon)){?>    		
  		<!--医生-->
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					<!--<em style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;">医生</em>-->
  					<label for="exampleInputEmail1" style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">医生</label>
  			</div>
  			 
  			<div style="width: 527px;height:60px ;float: left;">
  				<select id='Fstyle1' name='docId' style="width:82px;height: 34px;background: #FFFFFF!important;">
          				 <option>请选择医生</option>                    
   				</select >   
  			</div> 			  			  			
  		</li>
  		<!--城市-->
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					<label for="exampleInputEmail1" style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">城市</label>
  			</div>
  			<div style="width: 527px;height:60px ;float: left;">
  				<select id="province" name="province"  style="width:82px;height: 34px;background: #FFFFFF!important;" class="" onchange="showAttr(this.value);" > 
		    		<option value=''>请选择省</option> 
		             <?php                 
		               foreach ($provinces as $value)  {  
		                   
		                   echo  " <option value='".$value->id."'> ".$value->name." </option> "; 
		             }?>
		  		</select>
  		
		  		<select id="city" name="city" style="width:82px;height: 34px;background: #FFFFFF!important;margin-left: 14px;" class="">
		  			<option value=''>请选择市</option>
		  		</select>           
  			</div>
  		</li>
  		<?php }else {?>
  		
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					<!--<em style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;">医生</em>-->
  					<label for="exampleInputEmail1" style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">医生</label>
  			</div>
  			 
  			<div style="width: 527px;height:60px ;float: left;">
  				<select id='Fstyle1' name='docId' style="width:82px;height: 34px;background: #FFFFFF!important;">
          			<option>请选择医生</option>    
          			<?php foreach($docArr as $v){?>
                    <option value="<?php echo $v['Id'];?>"><?php echo $v['docName'];?></option>
                    <?php }?> 	                  
   				</select >   
  			</div> 			  			  			
  		</li>  		
  		
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					<label for="exampleInputEmail1" style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">城市</label>
  			</div>
  			<div style="width: 527px;height:60px ;float: left;">
  				<span><?php echo $hospitalArr[0]['name']; ?></span>	
        		<input type="hidden" name="city" value="<?php echo $hospitalArr[0]['hospSite']; ?>" />	          
  			</div>
  		</li>
		<?php }?> 
			 		
  		<!--上架时间-->
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					 <label for="dtp_input1" style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">上架时间</label>  
  			</div>
  			<div style="width: 527px;height:60px ;float: left;">
			    <input required="required" name="starttime"  class="laydate-icon" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" style="height:36px;">	             
  			</div>
  		</li>
  		<!--下架时间-->
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					 <label for="dtp_input1" style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">下架时间</label>  
  			</div>
  			<div style="width: 527px;height:60px ;float: left;">
			          <input required="required" name="endtime" class="laydate-icon" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" style="height:36px;">
	             
  			</div>
  		</li>
  		<!--消费有效期-->
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					 <label for="dtp_input1" style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">消费有效期</label>  
  			</div>
  			<div style="width: 527px;height:60px ;float: left;">
			          <input required="required" name="valitime" class="laydate-icon" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" style="height:36px;">
			          	<span style="font-size:13px ;color:#ff9191 ;"> 有效期：有效期为结束时间后的1~3个月</span>
	             
  			</div>
  		</li>
  		<li style="width:743px;height: 42px;background: #eeeeee;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;text-indent: 18px;font-size: 22px;line-height: 42px;color: #363636;margin-top: 6px;font-family: 'microsoft yahei';margin-left: -73px;">套餐及价格</li>
  		<!--项目原价-->
  		<li style="width: 100%;height:60px ;color: #5a5a5a;margin-top: 20px;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					 <label for="dtp_input1" style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">项目原价</label>  
  			</div>
  			<div style="width: 527px;height:60px ;float: left;">
			    <input name="lowPrice" style="width:176px;height: 38px;outline: none;border: 0;border: 1px solid #CDCDCD;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;text-indent: 25px;"  required="required"/>
			    <span style="font-size:13px ;color:#ff9191 ;"> 此项目原价为单规格市场价或院内价，大于颜小美平台价格</span>	             
  			</div>
  		</li>
  		<!--table表-->
  		<li style="width: 1090px;min-height:60px ;height: auto!important;height: 60px;color: #5a5a5a;margin-top: 20px;margin-left: -73px;margin-bottom: 96px;">
  			<table id="table" border="1px" width="87%"    align="center">
		            <tr  bgcolor="#eeeeee"  class="bgtable" align="center" height="50px">
		                <td style="font-size: 16px;color: #363636;">商品名称<span style="color:#ff5c77;font-size: 10px;"><b>(必填)</b></span></td>
		                <td style="font-size: 16px;color: #363636;">规格</td>
		                <td style="font-size: 16px;color: #363636;">小美价<span style="color:#ff5c77;font-size: 10px;"><b>(必填)</b></span></td>
		                <td style="font-size: 16px;color: #363636;">预付款<span style="color:#ff5c77;font-size: 10px;"><b>(必填)</b></span></td>
		                <td style="font-size: 16px;color: #363636;">到院付<span style="color:#ff5c77;font-size: 10px;"><b>(必填)</b></span></td>
		                <td style="font-size: 16px;color: #363636;">数量（一般商品默认0)<span style="color:#ff5c77;font-size: 10px;"><b>(必填)</b></span></td>
		                <td style="font-size: 16px;color: #363636;">套餐限购<span style="color:#ff5c77;font-size: 10px;"><b>(必填)</b></span></td>
		            </tr>
    		</table>
        	<input type="button" id="goodbutton" value="+添加" style="width: 80px;height: 40px;font-size: 18px;color: #FFFFFF;background: #ff9a9a;border: 0;outline: none;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;margin-left: 382px;margin-top: 20px;">
        	<p style="color: #ff9191;font-size:13px ;width: 300px;margin-left: 300px;margin-top: 10px;">单规格产品只需添加一次，多规格产品可添加多次</p>  			
  		</li>
	</ul>
	
	<!--详情页-->
	<div style="width:743px;height: 42px;background: #eeeeee;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;text-indent: 18px;font-size: 22px;line-height: 42px;color: #363636;margin-top: 40px;font-family: 'microsoft yahei';">
  		详情页
  	</div>	
  	<ul style="width: 675px;height: auto;margin-left: 70px;margin-top: 28px;">
  		<!--产品封面图片-->
  		<li style="width: 100%;min-height:60px ;height: auto!important;height: 60px;color: #5a5a5a;margin-top: 20px;display: inline-block;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					 <label style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">产品封面图片</label>
  			</div>
  			<div style="width: 527px;min-height:60px ;height: auto!important;height: 60px;float: left;">
	  				 	<div style="width: 800px;min-height:8px ;height: auto!important;height: 8px;" id='img'></div>   
				      	<input type="file" multiple="true" name="headimage[]" id='test' lay-method="post"  lay-ext="jpg|png|gif|jpeg" lay-title="上传" class="layui-upload-file" />
				      	<span style="font-size: 13px;color: #ff9191;">第一张图默认为预览图,最多为4张</span>			
  			</div>
  		</li>	
  		
  		<!--产品详情图1-->
  		<li style="width: 100%;min-height:60px ;height: auto!important;height: 60px;color: #5a5a5a;margin-top: 20px;display: inline-block;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					 <label style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">产品详情图一</label>
  			</div>
  			<div style="width: 527px;min-height:60px ;height: auto!important;height: 60px;float: left;">
	  				 	<div style="width: 800px;min-height:8px ;height: auto!important;height: 8px;" id='img111'></div>   
				      	<input type="file" multiple="true" name="headimage[]" id='test111' lay-method="post"  lay-ext="jpg|png|gif|jpeg" lay-title="上传" class="layui-upload-file" />
				      	<span style="font-size: 13px;color: #ff9191;">最多为4张</span>
				      	<div style="font-size: 16px;color: #151515;margin-top: 36px;">产品详情描述第一部分</div>	
				    	<textarea name="proDesc2" style="width:527px ;height: 114px;margin-top: 8px;resize: none;"></textarea>	
  			</div>
  		</li>
  			
  		<!--产品详情图2-->
  		<li style="width: 100%;min-height:60px ;height: auto!important;height: 60px;color: #5a5a5a;margin-top: 20px;display: inline-block;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					 <label style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">产品详情图二</label>
  			</div>
  			<div style="width: 527px;min-height:60px ;height: auto!important;height: 60px;float: left;">
	  				 	<div style="width: 800px;min-height:8px ;height: auto!important;height: 8px;" id='img2'></div>   
				      	<input type="file" multiple="true" name="headimage[]" id='test2' lay-method="post"  lay-ext="jpg|png|gif|jpeg" lay-title="上传" class="layui-upload-file" />
				      	<span style="font-size: 13px;color: #ff9191;">最多为4张</span>
				      	<div style="font-size: 16px;color: #151515;margin-top: 36px;">产品详情描述第二部分</div>	
				    	<textarea name="proDesc3" style="width:527px ;height: 114px;margin-top: 8px;resize: none;"></textarea>	
  			</div>
  		</li>
  		<!--产品详情图3-->
  		<li style="width: 100%;min-height:60px ;height: auto!important;height: 60px;color: #5a5a5a;margin-top: 20px;display: inline-block;">
  			<div style="width: 148px;height:52px ;float: left;position: relative;">
  					<img src="../assets/common/img/applicantDoctor-images/dot.png" style="position: absolute;left: 8px;top: 12px;"/>
  					 <label style="font-style: normal;font-size: 18px;position: absolute;left: 30px;top: 3px;font-weight: 100;">产品详情图三</label>
  			</div>
  			<div style="width: 527px;min-height:60px ;height: auto!important;height: 60px;float: left;">
	  				 	<div style="width: 800px;min-height:8px ;height: auto!important;height: 8px;" id='img3'></div>   
				      	<input type="file" multiple="true" name="headimage[]" id='test3' lay-method="post"  lay-ext="jpg|png|gif|jpeg" lay-title="上传" class="layui-upload-file" />
				      	<span style="font-size: 13px;color: #ff9191;">最多为4张</span>
				      	<div style="font-size: 16px;color: #151515;margin-top: 36px;">产品详情描述第三部分</div>	
				    	<textarea name="proDesc4" style="width:527px ;height: 114px;margin-top: 8px;resize: none;"></textarea>	
  			</div>
  		</li>
  		<!--返回 提交-->
	  		<li style="width: 100%;min-height:124px ;height: auto!important;height: 124px;">
	  			<div style="width: 148px;min-height:124px ;height: auto!important;height: 124px;float: left;position: relative;">
	  			</div>
	  			<div style="width: 527px;min-height:124px ;height: auto!important;height: 124px;float: left;position: relative;">
	  				<a onclick="history.go(-1)" style="width: 112px;height: 39px;background: #c9c9c9;border-radius: 10px;line-height: 39px;text-align: center;color: #FFFFFF;font-size:22px ;display: inline-block;cursor: pointer;margin-left:95px ;margin-top: 35px;margin-right: 106px;">返回</a>
	  				<input id="sub_form" type="submit" value="提交" style="width: 112px;height: 39px;background: #ff9a9a;border-radius: 10px;line-height: 39px;text-align: center;color: #FFFFFF;font-size:22px ;display: inline-block;outline: none;border: 0;cursor: pointer;"/>	  							
	  			</div>
	  		</li>	
  	</ul>   	
</form>

<script type="text/javascript" src="datepick/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="datepick/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="datepick/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="datepick/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
!function(){
	laydate.skin('danlan');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#demo'});//绑定元素
}();
//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};
var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，充值开始日的最大日期
    }
};
laydate(start);
laydate(end);
//自定义日期格式
laydate({
    elem: '#test1',
    format: 'YYYY年MM月DD日',
    festival: true, //显示节日
    choose: function(datas){ //选择日期完毕的回调
        alert('得到：'+datas);
    }
});
//日期范围限定在昨天到明天
laydate({
    elem: '#hello3',
    min: laydate.now(-1), //-1代表昨天，-2代表前天，以此类推
    max: laydate.now(+1) //+1代表明天，+2代表后天，以此类推
});
</script>
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
<script>
$("#sub_form").click(function(){ 
	var trLength = $("#table tr").length;
	if(trLength<2){
		alert("至少添加一个套餐！！！"); 
		event.preventDefault();
	}

	selectedL = $("#mbuyIdholder div").length;							
	if(selectedL<1){
		alert("至少选择一个项目类型！！！"); 
		event.preventDefault();
	}	

	docIdSelected = $("#Fstyle1 option:selected").val();
	if(docIdSelected == "请选择医生" ){
		alert("请选择医生！！！"); 
		event.preventDefault();
	}		
})
</script>
<script type="text/javascript">
	var shu=0;
    $('#goodbutton').unbind().bind('click', function (){
        
        var name = $('#goodone').val();
        
        var guige = $('#goodtwo').val();
        
        shu++;
        
        var tables = '';
        
        tables += '<tr align="center"><td><input type="hidden" name="skuShu" value="'+shu+'" /><input type="text" name="sku[skuName][skuName'+shu+']" style="border:0;height:43px;background:#f7f7f7;"></td>';
        tables += '<td height="50px" width="170px"><input type="text" name="sku[skuSpecification][skuSpecification'+shu+']" style="border:0;height:43px;background:#f7f7f7;"></td>';
        tables += '<td height="50px" width="170px"><input type="text" name="sku[gdPrice][gdPrice'+shu+']" style="border:0;height:43px;background:#f7f7f7;"></td>';
        tables += '<td  width="170px"><input type="text" name="sku[gdSetPrice][gdSetPrice'+shu+']" class="yufu" style="border:0;height:43px;background:#f7f7f7;"></td>';
        tables += '<td  width="170px"><input type="text" name="sku[gdHosPrice][gdHosPrice'+shu+']" class="daofu" style="border:0;height:43px;background:#f7f7f7;"></td>';
        tables += '<td width="170px"><input type="text" name="sku[gdNum][gdNum'+shu+']" value="0" style="border:0;height:43px;background:#f7f7f7;"></td>';
        tables += '<td width="170px" text-align="center"><input type="text" name="sku[gBuyLimit][gBuyLimit'+shu+']" value="0" style="border:0;height:43px;background:#f7f7f7;"></td>';
        tables += '<td  class="gooddetele" style="font-size: 18px;color: #FFFFFF;background: #bababa;border-right-style: none;width:80px;display:block;height:50px;line-height:50px;border-top-style:none;border-right-style:none;border-left-style:none;">删除</td>';
        tables += '</tr>';
            
        $('#table').last('tr').append(tables);
        $('.gooddetele').click(function(){		
			$(this).parent().remove();
		   	 
     	})
        $(".yufu").on("click",function(){
        	//console.log($(this).parent().prev().find("input").val()*0.1);
        	$(this).val($(this).parent().prev().find("input").val()*0.1);
        })
        $(".daofu").on("click",function(){
//         	console.log($(this).parent().parent().find("td:nth-child(4)").find("input").val());
        	$(this).val($(this).parent().parent().find("td:nth-child(3)").find("input").val()*0.9);
        })
        
        
    })
    
</script>
	
<script>
   var ls=0    	
    
   function onclickList(id){  

	   selectedML = $("#mbuyIdholder div").length;	   

	   if(selectedML>=3){
		   alert('Ooops!您已添加三个项目类型！');
	   }
	   
	    $("#xiangmuDetail").html("");                                                 	                
		$.ajax({
			type:"POST",
			url:"index.php?r=pgoods/findmbuy",
			data:"id="+id,
			dataType:'json',
			success: function(msg){
				typeInfo='';
				$.each(msg,function(key,array){
	                typeInfo=typeInfo+ '<li style="height: 25px;line-height: 25px;font-size: 14px;background: #FFFFFF;text-align: center;min-width: 60px;width: auto!important;width: 60px;display: inline-block;margin-top: 8px;border-radius: 2px;padding-left: 6px;padding-right: 6px;margin-right: 8px; "><input type="hidden" name="hidMbuyId" value="'+ array.id +'" />'+ array.mName +'</li>'; 
	            });
				$('#xiangmuDetail').append(typeInfo);					
				$("#xiangmuDetail  li").click(function(){	

					var selectedMbuyId = $(this).find("input").val(); 
					var selectedML = $("#mbuyIdholder div").length;							
    				var selectedL = $("#selected div").length;
    				if(selectedML+selectedL<3){
    					if(selectedL<=2){            				
        					if($("#selected input[type='hidden']").length > 0){  	        												            						
        	    				$("#selected input[type='hidden']").each(function(){           	    						      					            					
        	        				if(this.value == selectedMbuyId){
        	            				alert('Ooops!重复选择。');	
        	        					throw "Ooops!重复选择。";
        	        				}
        	        			})             							          						
    						}
        					if($("#mbuyIdholder input[type='hidden']").length > 0){
        						$("#mbuyIdholder input[type='hidden']").each(function(){  	        						  	                					
                					if(this.value == selectedMbuyId){
                						alert('Ooops!重复选择。');	
        	        					throw "Ooops!重复选择。";
                					}
            					})
        					}       						

    	    				ls++;
    	        	  		var content=$(this).text();        	        	  		
    	    				//var selectedMbuyId = $(this).find("input").val();    	  				
    	        	  		$("#selected").append('<div style="display: inline-block;margin-right: 15px;font-size: 13px;"><input type="hidden" name="M[selected][mbuy'+ls+']" value="'+selectedMbuyId+'" /><p style="display: inline-block;">'+content+'</p><img src="../assets/common/img/applicantDoctor-images/quxiao.png" style="width: 15px;height: 15px;margin-left: 6px;margin-top:-3px;" class="img-delete"/></div>');        	        	  		      						
    	        	  		$(".img-delete").click(function(){        	  				
    	        	  			$(this).parent().remove();    	  					
    	        	  		})  
    	    			} 	   					   												 							           				 						       				 	  				
        			}else{        						
        				alert('Ooops!您已添加三个项目类型！')
        			}
//					项目类型  验证
// 					var selectedML = $("#mbuyIdholder div").length;							
//     				var selectedL = $("#selected div").length;
//     				if(selectedML+selectedL<3){													
//     	    			if(selectedL<=2){
//     	    				ls++;
//     	        	  		var content=$(this).text();
//     	    				var selectedMbuyId = $(this).find("input").val();    	  				
//     	        	  		$("#selected").append('<div style="display: inline-block;margin-right: 15px;font-size: 13px;"><input type="hidden" name="M[selected][mbuy'+ls+']" value="'+selectedMbuyId+'" /><p style="display: inline-block;">'+content+'</p><img src="../assets/common/img/applicantDoctor-images/quxiao.png" style="width: 15px;height: 15px;margin-left: 6px;margin-top:-3px;" class="img-delete"/></div>');
//     	        	  			$(".img-delete").click(function(){        	  				
//     	        	  				$(this).parent().remove();    	  					
//     	        	  			})  
//     	    			} 	  				
//     				}else {        						
//     					alert('Ooops!您已添加三个项目类型！')
//     				}   				   								      												    				   	    	  				
    	  		})		
			}			
		});  
	}			            	                                           	   
</script>
<script type="text/javascript">
	function showAttr(id){

        var obj=document.getElementById('city');   
          
        var length = obj.options.length;
            
            for(var i = length; i > 0; i--){            
                obj.options.remove(i);      
        	}  
    
        $.ajax({
               type: "POST",
               url: "index.php?r=preferencegoods/findcitys", 
               data:  "id="+id,
               dataType:'json',
               success: function(msg){
            	   skuInfo="";                
                   $.each(msg,function(key,array){                      
                        skuInfo=skuInfo+   "<option value='" + array.id + "'>"+ array.name +"</option> "; 
                   });                                           
                   $("#city").append(skuInfo);       
              }     
        });  
	}

	//医院搜索

	 $(document).ready(function() {
	        $(document).keydown(function(e) {
	            e = e || window.event;
	            var keycode = e.which ? e.which : e.keyCode;
	            if (keycode == 38) {
	                if (jQuery.trim($("#append").html()) == "") {
	                    return;
	                }
	                movePrev();
	            } else if (keycode == 40) {
	                if (jQuery.trim($("#append").html()) == "") {
	                    return;
	                }
	                $("#kw").blur();
	                if ($(".item").hasClass("addbg")) {
	                    moveNext();
	                } else {
	                    $(".item").removeClass('addbg').eq(0).addClass('addbg');
	                }
	            } else if (keycode == 13) {
	                dojob();
	            }
	        });
	        var movePrev = function() {
	            $("#kw").blur();
	            var index = $(".addbg").prevAll().length;
	            if (index == 0) {
	                $(".item").removeClass('addbg').eq($(".item").length - 1).addClass('addbg');
	            } else {
	                $(".item").removeClass('addbg').eq(index - 1).addClass('addbg');
	            }
	        }
	        var moveNext = function() {
	            var index = $(".addbg").prevAll().length;
	            if (index == $(".item").length - 1) {
	                $(".item").removeClass('addbg').eq(0).addClass('addbg');
	            } else {
	                $(".item").removeClass('addbg').eq(index + 1).addClass('addbg');
	            }
	        }
	        var dojob = function() {
	            $("#kw").blur();
	            var value = $(".addbg").text();
	            $("#kw").val(value);
	            $("#append").hide().html("");
	        }
	    });
	    
	    function getContent(obj) {
	        var kw = jQuery.trim($(obj).val());
	        var url = 'index.php?r=pgoods/findhospital';
	        var datas = {'datas':kw};
	        $("#append").css("display","block")
	        if(kw == "") {
	            $("#append").hide().html("");
	            return false;
	        }

	        $.post(url,datas,function(data){
	            var html = "";
	            for (var i = 0; i < data.length; i++) {
	                if (data[i]['hospitalName'].indexOf(kw) >= 0) {
	                    html = html + "<div style='width:600px;' sid='"+data[i]['id']+"' class='item' onmouseenter='getFocus(this)' onClick='getCon(this);'>" + data[i]['hospitalName'] + "</div>"
	                }
	            }
	            if (html != "") {
	                $("#append").show().html(html);
	            } else {
	                $("#append").hide().html("");
	            }
	        },'json')	        
	          
	    }
	    
	    function getFocus(obj) {
	        $(".item").removeClass("addbg");
	        $(obj).addClass("addbg");
	    }
	    
	    function getCon(obj) {
		    
	        var value = $(obj).text();
	        var valueid = $(obj).attr('sid');
	        $("#kw").val(value);
	        $("#haha").val(valueid);
	        $("#append").hide().html("");
	        var url = 'index.php?r=pgoods/finddoc';
	        var data = {'did':valueid};
	        $.post(url,data,function(data){
	        	if (data) {
                    var html='';
                     html += '<option value="">请选择医生</option>';
                     for (var i = 0; i<data.length ;  i++) {
                         html += '<option value="' + data[i]['Id'] + '">' + data[i]['docName'] + '</option>';
                     }
                     $('#Fstyle1').html(html);
                 } 
	        },'json')	       	        
	    }
	    
	
</script>
<script>

    layui.use('form', function(){
      var form = layui.form();
    });
    
    layui.use('upload', function(){
        
      var a=0;
      var l=0
      var i=0;    
      var q=0; 
      
      layui.upload({
        url: 'index.php?r=pgoods/uploadcarouselimage&a='+a
        ,elem: '#test' //指定原始元素，默认直接查找class="layui-upload-file"
        ,method: 'post' //上传接口的http类型
        ,success: function(res){
			console.log(res);
			if(res.code == 2){
				//alert("oops ! 出错啦，图片多于3张");
				layer.msg('oops ! 出错啦，图片多于4张', {icon: 2});
			}else{   
				if(res.code == 0){
					layer.msg('oops ! 上传失败，请重试', {icon: 2});
				}else if(res.code == 1){

                  	layer.msg('图片添加成功', {icon: 6});                     	                  	                             

                  	for(var l=0; l<res.src.length; l++){

                  		if(a == 4){
                        	layer.msg('oops! 出错啦，已上传4张图片', {icon: 2});
                        	return false;
                      	}else{                          	                     	                     	
                          	var imgsrc = res.src;                 	
                            $("#img").append("<div class=ctDiv"+q+" style='width:150px!important;height:150px;display:inline-block;position:relative;'></div>");
                            $(".ctDiv"+q).append("<img src='../assets/common/img/quxiao.png' style='width:20px;height:20px;position:absolute;top:0px;right:0;cursor:pointer' class='imgclose' />");
                            $(".ctDiv"+q).append("<img src="+imgsrc[l]+" alt='' style='width:150px;height:150px;padding-left:6px;margin-bottom:12px;'>");
                            $(".ctDiv"+q).append("<input type='hidden' name=carouselimage"+a+" value="+imgsrc[l]+" />");   
                  		   		$(".imgclose").click(function(){
                    				$(this).parent().remove();
                    				var length=$("#img").find("div").length;
                    				for(var i=0;i<length;i++){
                    					$("#img").find("div:eq("+i+")").find("input").attr({name:"carouselimage"+i});
                    					a=i+1;
                    				}		
                    			})
                            a++;
                            q++;
                      	}
                  	}                    
				}
			}          
        }
                      
      });
     
    });
</script>
<script>

    layui.use('form', function(){
      var form = layui.form();
    });
    
    layui.use('upload', function(){
        
      var a=0;
      var l=0
      var i=0;    
      var q=0; 
      
      layui.upload({
        url: 'index.php?r=pgoods/uploadproimage1&a='+a
        ,elem: '#test111' //指定原始元素，默认直接查找class="layui-upload-file"
        ,method: 'post' //上传接口的http类型
        ,success: function(res){
			console.log(res);
			if(res.code == 2){
				//alert("oops ! 出错啦，图片多于3张");
				layer.msg('oops ! 出错啦，图片多于4张', {icon: 2});
			}else{   
				if(res.code == 0){
					layer.msg('oops ! 上传失败，请重试', {icon: 2});
				}else if(res.code == 1){

                  	layer.msg('图片添加成功', {icon: 6});                     	                  	                             

                  	for(var l=0; l<res.src.length; l++){

                  		if(a == 4){
                        	layer.msg('oops! 出错啦，已上传4张图片', {icon: 2});
                        	return false;
                      	}else{                          	                     	                     	
                          	var imgsrc = res.src;                 	
                            $("#img111").append("<div class=fctDiv"+q+" style='width:150px!important;height:150px;display:inline-block;position:relative;'></div>");
                            $(".fctDiv"+q).append("<img src='../assets/common/img/quxiao.png' style='width:20px;height:20px;position:absolute;top:0px;right:0;cursor:pointer' class='imgclose' />");
                            $(".fctDiv"+q).append("<img src="+imgsrc[l]+" alt='' style='width:150px;height:150px;padding-left:6px;margin-bottom:12px;'>");
                            $(".fctDiv"+q).append("<input type='hidden' name=fproimg"+a+" value="+imgsrc[l]+" />");   
                  		   		$(".imgclose").click(function(){
                    				$(this).parent().remove();
                    				var length=$("#img111").find("div").length;
                    				for(var i=0;i<length;i++){
                    					$("#img111").find("div:eq("+i+")").find("input").attr({name:"fproimg"+i});
                    					a=i+1;
                    				}		
                    			})
                            a++;
                            q++;
                      	}
                  	}                    
				}
			}          
        }
                      
      });
     
    });
</script>
<script>

    layui.use('form', function(){
      var form = layui.form();
    });
    
    layui.use('upload', function(){
        
      var a=0;
      var l=0
      var i=0;    
      var q=0; 
      
      layui.upload({
        url: 'index.php?r=pgoods/uploadproimage2&a='+a
        ,elem: '#test2' //指定原始元素，默认直接查找class="layui-upload-file"
        ,method: 'post' //上传接口的http类型
        ,success: function(res){
			console.log(res);
			if(res.code == 2){
				//alert("oops ! 出错啦，图片多于3张");
				layer.msg('oops ! 出错啦，图片多于4张', {icon: 2});
			}else{   
				if(res.code == 0){
					layer.msg('oops ! 上传失败，请重试', {icon: 2});
				}else if(res.code == 1){

                  	layer.msg('图片添加成功', {icon: 6});                     	                  	                             

                  	for(var l=0; l<res.src.length; l++){

                  		if(a == 4){
                        	layer.msg('oops! 出错啦，已上传4张图片', {icon: 2});
                        	return false;
                      	}else{                          	                     	                     	
                          	var imgsrc = res.src;                 	
                            $("#img2").append("<div class=sctDiv"+q+" style='width:150px!important;height:150px;display:inline-block;position:relative;'></div>");
                            $(".sctDiv"+q).append("<img src='../assets/common/img/quxiao.png' style='width:20px;height:20px;position:absolute;top:0px;right:0;cursor:pointer' class='imgclose' />");
                            $(".sctDiv"+q).append("<img src="+imgsrc[l]+" alt='' style='width:150px;height:150px;padding-left:6px;margin-bottom:12px;'>");
                            $(".sctDiv"+q).append("<input type='hidden' name=sproimg"+a+" value="+imgsrc[l]+" />");   
                  		   		$(".imgclose").click(function(){
                    				$(this).parent().remove();
                    				var length=$("#img2").find("div").length;
                    				for(var i=0;i<length;i++){
                    					$("#img2").find("div:eq("+i+")").find("input").attr({name:"sproimg"+i});
                    					a=i+1;
                    				}		
                    			})
                            a++;
                            q++;
                      	}
                  	}                    
				}
			}          
        }
                      
      });
     
    });
</script>
<script>

    layui.use('form', function(){
      var form = layui.form();
    });
    
    layui.use('upload', function(){
        
      var a=0;
      var l=0
      var i=0;    
      var q=0; 
      
      layui.upload({
        url: 'index.php?r=pgoods/uploadproimage3&a='+a
        ,elem: '#test3' //指定原始元素，默认直接查找class="layui-upload-file"
        ,method: 'post' //上传接口的http类型
        ,success: function(res){
			console.log(res);
			if(res.code == 2){
				//alert("oops ! 出错啦，图片多于3张");
				layer.msg('oops ! 出错啦，图片多于4张', {icon: 2});
			}else{   
				if(res.code == 0){
					layer.msg('oops ! 上传失败，请重试', {icon: 2});
				}else if(res.code == 1){

                  	layer.msg('图片添加成功', {icon: 6});                     	                  	                             

                  	for(var l=0; l<res.src.length; l++){

                  		if(a == 4){
                        	layer.msg('oops! 出错啦，已上传4张图片', {icon: 2});
                        	return false;
                      	}else{                          	                     	                     	
                          	var imgsrc = res.src;                 	
                            $("#img3").append("<div class=tctDiv"+q+" style='width:150px!important;height:150px;display:inline-block;position:relative;'></div>");
                            $(".tctDiv"+q).append("<img src='../assets/common/img/quxiao.png' style='width:20px;height:20px;position:absolute;top:0px;right:0;cursor:pointer' class='imgclose' />");
                            $(".tctDiv"+q).append("<img src="+imgsrc[l]+" alt='' style='width:150px;height:150px;padding-left:6px;margin-bottom:12px;'>");
                            $(".tctDiv"+q).append("<input type='hidden' name=tproimg"+a+" value="+imgsrc[l]+" />");   
                  		   		$(".imgclose").click(function(){
                    				$(this).parent().remove();
                    				var length=$("#img3").find("div").length;
                    				for(var i=0;i<length;i++){
                    					$("#img3").find("div:eq("+i+")").find("input").attr({name:"tproimg"+i});
                    					a=i+1;
                    				}		
                    			})
                            a++;
                            q++;
                      	}
                  	}                    
				}
			}          
        }
                      
      });
     
    });
</script>
<script>
  		$("#add").click(function(){
  			selectedML = $("#mbuyIdholder div").length;	   

   		   if(selectedML>=3){
   			    alert('Ooops!您已添加三个项目类型！');
   		   }else{
      	   		$("#tanchuang").css("display","block");  	   		   
   		   }	  		 			
  		})
  		$("#closeBox").click(function(){
  			$("#tanchuang").css("display","none");
  			$("#selected div").remove();
  		})
  		$("#conmit").click(function(){
			$("#tanchuang").css("display","none");
  			var content=$("#selected").html();
  			$("#mbuyIdholder").append(content);
  			$("#selected div").remove();
  			$(".img-delete").click(function(){
  					$(this).parent().remove();
  			})
  		})
  			$("#xiangmuList li").click(function(){
  				$("#xiangmuList li").css({color:"#000000",background:"#ffffff"});
  				$(this).css({color:"#30b5f8",background:"#f2f2f2"});
  			})
  			
</script>
