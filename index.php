<?php

define('CLIENT_LONG_PASSWORD', 1);
$connection = mysql_connect([host], [user], [password], false, CLIENT_LONG_PASSWORD)
or die(mysql_error());
$db = mysql_select_db([database], $connection) or
die(mysql_error());

$username;
$password;
if(isset($_POST["insert"])){
	if($_POST["insert"]=="yes"){
	$username=$_POST["username"];
	$password=$_POST["password"];

$query="insert into members(username, password) values('$username', '$password')";
if(mysql_query($query))
echo "<center>Record Inserted!</center><br>";
	}
}

if(isset($_POST["update"])){
	if($_POST["update"]=="yes"){
	$username=$_POST["username"];
	$password=$_POST["password"];

$query="update members set username='$username' , password='$password' where id=".$_POST['id'];
if(mysql_query($query))
echo "<center>Record Updated</center><br>";
	}
}

if(isset($_GET['operation'])){
    if($_GET['operation']=="delete"){
        $query="delete from members where id=".$_GET['id'];	
        if(mysql_query($query))
            echo "<center>Record Deleted!</center><br>";
    }
}
?>
<!--
<html>
<body>
<form method="post" action="index.php">
<table align="center" border="0">
<tr>
<td>username:</td>
<td><input type="text" name="username" /></td>
</tr>
<tr>
<td>password:</td>
<td><input type="password" name="password" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="right">
<input type="hidden" name="insert" value="yes" />
<input type="submit" value="Insert Record"/>
</td>
</tr>
</table>
</form>
-->
<?php

if(isset($_GET['operation'])){
if($_GET['operation']=="edit"){
?>
<!--
<form method="post" action="index.php">
<table align="center" border="0">
<tr>
<td>username:</td>
<td><input type="text" name="username" value="<?php echo $_GET['username']; ?>" /></td>
</tr>
<tr>
<td>password:</td>
<td><input type="text" name="password" value="<?php echo $_GET['password']; ?>"/></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="right">
<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
<input type="hidden" name="update" value="yes" />
<input type="submit" value="update Record"/>
</td>
</tr>
</table>
</form>
-->
<?php
}}
?>

<?php
$query="select * from members";
$result=mysql_query($query);
if(mysql_num_rows($result)>0){
    echo $result;
//	echo "<table align='center' border='1'>";
//	echo "<tr>";
//	echo "<th>Id</th>";
//	echo "<th>Username</th>";
//	echo "<th>Password</th>";
//	echo "</tr>";
//	while($row=mysql_fetch_array($result)){
//	echo "<tr>";
//	echo "<td>".$row['id']."</td>";	
//	echo "<td>".$row['username']."</td>";	
//	echo "<td>".$row['password']."</td>";
//	echo "<td><a href='index.php?operation=edit&id=".$row['id']."&username=".$row['username']."&password=".$row['password']."'>edit</a></td>";
//	echo "<td><a href='index.php?operation=delete&id=".$row['id']."'>delete</a></td>";	
//	echo "</tr>";
//	}
//	echo "</table>";
}
else{
//echo "<center>No Records Found!</center>";	
}

?>
<!--
</body>
</html>-->
