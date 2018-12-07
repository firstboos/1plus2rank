<?
// 외부에서 호출이 가능하도록 테스트를 위해서 추가
header("Access-Control-Allow-Origin: *");

$name = isset($_POST['name']) ? $_POST['name'] : null;
$score = isset($_POST['score']) ? $_POST['score'] : null;

// DB 연결
$G5_MYSQL_HOST='localhost';
$G5_MYSQL_DB='game_db';
$G5_MYSQL_USER='MYSQLUSER';
$G5_MYSQL_PASSWORD='MYSQLPASSWD';
$G5_MYSQL_SET_MODE=false;

$connect_db = @mysql_connect($G5_MYSQL_HOST, $G5_MYSQL_USER, $G5_MYSQL_PASSWORD) or die('MySQL Connect Error!!!');
$select_db  = @mysql_select_db($G5_MYSQL_DB, $connect_db) or die('MySQL DB Error!!!');

@mysql_set_charset('utf8', $connect_db);

if ($name == null)
    $name = "_UNKNOWN_USER_";

$sql = "INSERT INTO game_1plus2 (name,score,reg_time) VALUES ('".$name."',".$score.",'".date("Y-m-d H:i:s")."')";
$result = @mysql_query($sql);
//echo "result = ".$result;

mysql_close($connect_db);

?>
