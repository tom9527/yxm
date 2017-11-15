<?php 
    use yii\helpers\Url;
?>

<br/>

<div>
    <form action="index.php?r=pgoods/recommend" method="post">
        
        <div class="form-group" >
        	<label for="exampleInputEmail1">推荐项目Id</label>
        	<input type="text" name="rec" style="width:550px;" required class="form-control rg1" id="exampleInputEmail1">
    		<div class="rg1notify" style="width: 200px;display: inline;color: red"></div>
    	</div><br />    	   	
                      
        <input type="hidden" name="rg" value="<?php echo $gl;?>" />        
        
        <input id="sub" class="btn btn-primary" style="margin-left:3%;" type="submit" value="保存" />
        <input class="btn btn-inverse" style="margin-left:8%;" type="button" value="返回" onclick="history.go(-1)">	
    </form>

</div>
<script>
	$('.rg1').blur(function(){
		var rg1 = $('.rg1').val();
		
		var r = /^\+?[1-9][0-9]*$/;

		var rgurl = "<?=Url::to(['pgoods/checkstatus'])?>";

		var rgdata = {"gid":rg1,"gl":<?php echo $gl; ?>}

		if(!r.test(rg1)){
			$("#sub").attr('disabled','true')
			$(".rg1notify").html("请填写数字!");
		}else{				
			$.post(rgurl,rgdata,function(data){
				if(data.status == 1){
					$(".rg1notify").html("");
					$("#sub").removeAttr("disabled");
				}else if(data.status == 2){
					$(".rg1notify").html("项目已推荐!请重新选择");
					$("#sub").attr('disabled','true')
				}else{
					$(".rg1notify").html("请填写已上架项目Id!");
					$("#sub").attr('disabled','true')
				}				
			},'json')						
		}				
	})
</script>