<?php include APP_PATH."/view/echoTable.php";?>

<!DOCTYPE html>
<html>
<?php echotable($_REQUEST['aaa']) ; ?>
<form action="<?php echo ROOT_FILE;?>/login/login" method="get">
	<input type="type" name="str" >
	<input type="submit" value="submit" name="doSubmit">
</form>

<form action="login/mod" method="post">
	<input type="submit" value="submit1" name="doSubmit">
</form>

<a href="mod">submit</a>

</html>
