<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

define('CLIENT_LONG_PASSWORD', 1);
$connection = @mysql_connect(myHost, myUserName, myPassword, false, CLIENT_LONG_PASSWORD)
or die(mysql_error());
$db  = @mysql_select_db(myDatabase, $connection) or
die(mysql_error());


$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

switch ($method) {
    
    case 'PUT' :
        //do_something_with_put($request);  
        break;

    
    case 'POST':
        //do_something_with_post($request);  
        break;
    
    case 'GET':
        
        $query = "SELECT *";
        if (isset($_GET["table"])) {
            $query .= " FROM ".$_GET["table"];
        }
        if (isset($_GET["where_field"]) && isset($_GET["where_value"])) {
            $query .= " WHERE ".$_GET["where_field"]." = ".$_GET["where_value"];
        }
        if (isset($_GET["and"])) {
            $query .= " AND ".$_GET["and"];
        }
        
        if (isset($_GET["sort_field"])) {
            $query .= " ORDER BY `".$_GET["sort_field"]."`";
        }
        if (isset($_GET["sort_dir"])) {
            $query .= " ".$_GET["sort_dir"];
        }
        $result=mysql_query($query);
        if(mysql_num_rows($result)>0){
            header('Content-type: application/json');
            $rows = array();
            while($r = mysql_fetch_assoc($result)){
                $rows[] = $r;
            }
            echo json_encode($rows);            
        };

        break;

    case 'HEAD':
        //do_something_with_head($request);  
        break;

    case 'DELETE':
    //do_something_with_delete($request);  
    break;
    
    case 'OPTIONS':
    //do_something_with_options($request);    
    break;
    
    default:
    //handle_error($request);  
    break;
}



//$username;
//$password;
//
//if(isset($_POST["insert"])){
//	if($_POST["insert"]=="yes"){
//	$username=$_POST["username"];
//	$password=$_POST["password"];
//
//    $query="insert into members(username, password) values('$username', '$password')";
//    if(mysql_query($query))
//        echo "<center>Record Inserted!</center><br>";
//	}
//}
//
//if(isset($_POST["update"])){
//	if($_POST["update"]=="yes"){
//	   $username=$_POST["username"];
//	   $password=$_POST["password"];
//
//        $query="update members set username='$username' , password='$password' where id=".$_POST['id'];
//        if(mysql_query($query))
//            echo "<center>Record Updated</center><br>";
//   }
//}
//
//if(isset($_GET['operation'])){
//    if($_GET['operation']=="delete"){
//        $query="delete from members where id=".$_GET['id'];	
//        if(mysql_query($query))
//            echo "<center>Record Deleted!</center><br>";
//    }
//}
//
//if(isset($_GET['operation'])){
//    if($_GET['operation']=="edit"){
//    }
//}

//$query="select * from members";
//$result=mysql_query($query);
//if(mysql_num_rows($result)>0){
//    header('Content-type: application/json');
//    //echo "{".mysql_num_rows."}";
//    //echo json_encode("{foo:".mysql_num_rows($result)."}");
//
//    $row = mysql_fetch_row($result);
//    if($row)    
//        echo json_encode("{foo:".$row[1]."}");
//}
