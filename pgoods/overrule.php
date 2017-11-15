<br/>

<div>
    <form action="index.php?r=pgoods/overrule&gid=<?php echo $gid;?>" method="post">
        <label>审核未通过原因:</label>
        <div><textarea type="text" name="pro" cols="70" rows="5" ></textarea></textarea></div><br />
        
        <label>修改建议:</label>
        <div><textarea name="adv" cols="70" rows="5"></textarea></div><br />
        
        <input type="hidden" name="gids" value="<?php echo $gid;?>" />        
        
        <input class="btn btn-primary" style="margin-left:3%;" type="submit" value="保存" />
        <input class="btn btn-inverse" style="margin-left:8%;" type="button" value="返回" onclick="history.go(-1)">	
    </form>

</div>