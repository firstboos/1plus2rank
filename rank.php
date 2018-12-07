<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<style type = "text/css">
body {
	font-family: 'Lato', Arial, sans-serif;
	color: #989c9b;
}

.container > header {
	margin: 0 auto;
	padding: 1em;
	text-align: center;
}

.container > header h1 {
  font-weight: 600;
	font-size: 3em;
	margin: 0;
}

.wrapper {
	line-height: 1.5em;
	margin: 0 auto;
	padding: 2em 0 3em;
	width: 90%;
	max-width: 2000px;
	overflow: hidden;
}

table {
    border-collapse: collapse;
    width: 100%;
    background: #fff;
}

th {
    background-color: #326295;
    font-weight: bold;
    color: #fff;
    white-space: nowrap;
}

td, th {
    padding: 1em 1.5em;
    text-align: left;
}

tbody th {
	background-color: #2ea879;
}
tbody tr:nth-child(2n-1) {
    background-color: #f5f5f5;
    transition: all .125s ease-in-out;
}
tbody tr:hover {
    background-color: rgba(50,98,149,.3);
}

td.rank {
	text-transform: capitalize;
}

</style>

</head>

<body>
<div class="container">
    <header>
        <h1>Ranking Top 20</h1>
    </header>
    <div class="wrapper">
        <table>
          <thead>
            <tr>
              <th>Rank</th>
              <th>Name</th>
              <th>Score</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
<?php
  $MYSQL_HOST='localhost';
  $MYSQL_DB='game_db';
  $MYSQL_USER='MYSQLUSER';
  $MYSQL_PASSWORD='MYSQLPASSWD';

  $connect_db = @mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD) or die("MySQL Connect Error!!!!");
  @mysql_select_db($MYSQL_DB, $connect_db);

  // 최대 30 위까지 데이터만 유지한다. 데이터 많이 쌓고 싶지 않다.
  // 30 위의 score 점수를 가지고 온다.
  $query = "select score from game_1plus2 order by score desc limit 30,1";
  $result = @mysql_query($query);
  $row = mysql_fetch_row($result);
  // 30 위 이하 데이터를 삭제한다.
  $query = "delete from game_1plus2 where score < " . $row[0];
  @mysql_query($query);

  $query = "select name, score, @curRank := @curRank+1 as rank, reg_time from game_1plus2 g, (select @curRank := 0) r order by score desc, reg_time limit 20";
  $result = @mysql_query($query);
  while ($row = mysql_fetch_array($result)) {
//      print_r($row);
    echo '<tr>';
      echo '  <td class=\"rank\">'.$row['rank'].'</td>';
      echo '  <td class=\"name\">'.$row['name'].'</td>';
      echo '  <td class=\"score\">'.$row['score'].'</td>';
      echo '  <td class=\"date\">'.$row['reg_time'].'</td>';
    echo '</tr>';
  }
  mysql_close($connect_db);
?>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>
