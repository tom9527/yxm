<?php 

use yii\bootstrap\Alert;
use yii\helpers\Url;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>跳转提示</title>
	<style type="text/css">
		.infomess{
			margin:300px auto;
			width:300px;
			height:100px;
           
           border:1px solid #ccc;
		}

	</style>
</head>
<body>
	<div class="container">
		<div class="infomess">
			<div class="errormess" style="text-align:center;">
				<h2 class="page-header">
					<?php 
						echo Alert::widget([
								'body' => Yii::$app->getSession()->getFlash('success'),
							]);
					 ?>
				</h2>
			</div>
			
			<div style="text-align:center;" class="timeinfo">页面将自动跳回<a id="href" href="javascript:history.go(-1);" ></a>&nbsp;&nbsp;&nbsp;&nbsp;等待时间:<span id="wait">3</span></div>
		
		</div>
	</div>
</body>
<script>
		wait=document.getElementById('wait');
		href=document.getElementById('href');
		totaltime=wait.innerHTML;
		interval= setInterval(function(){
			time=--totaltime;
			wait.innerHTML=time;
			if(time == '0'){
				location.href=href;
				clearInterval();
			}
		},1000);
</script>
</html>