<!DOCTYPE html>
<html>
<form action="closefairfax.php" method="post">
<input type="submit" name="formpred" value="Opened" />
<input type="submit" name="formpred" value="Delay" />
<input type="submit" name="formpred" value="Close" /> </form>
<body>
<?php 
$username="root";
$password="root";
$database="CloseFairfax";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");


if($_POST){
	$prediction=$_POST['formpred'];
	if($prediction=='Opened')
{
	$submitquery = "INSERT INTO predictions(preddate,opened) VALUES (CURRENT_DATE,1) ON DUPLICATE KEY UPDATE opened=opened+1;";

	
}
 
elseif($prediction=='Delay')
{
	$submitquery = "INSERT INTO predictions(preddate,delay) VALUES (CURRENT_DATE,1) ON DUPLICATE KEY UPDATE delay=delay+1;";

	
}

if($prediction=='Close')
{
	$submitquery = "INSERT INTO predictions(preddate,close) VALUES (CURRENT_DATE,1) ON DUPLICATE KEY UPDATE close=close+1;";

	
}
mysql_query($submitquery);

}












$query = "SELECT * FROM predictions WHERE preddate=CURDATE()";
$resultq= mysql_query($query);

while ($row = mysql_fetch_assoc($resultq)) {
echo $row['opened'];
echo "           ";
echo $row['delay'];
echo "           ";
echo $row['close'];
echo "           ";
echo "<br> Prediction <br>";
$finalpred=(($row['opened']*1)+($row['delay']*2)+($row['close']*3))/($row['opened']+$row['delay']+$row['close']);
echo $finalpred;






}


mysql_close();

?>
</body>

</html>