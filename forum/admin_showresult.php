
<html>
<head>


</head>
<body>
<?php


$q = $_GET['q'];
$r = $_GET['r'];
$page=intval($_GET['s']);


require_once 'connection.php';

$sql1="";          $sql2="";



$offset= $page*50;

if($r =="SHOWALL")
{
$sql1="SELECT * FROM issues ORDER BY I_D ".$q." LIMIT ".$offset.", 50";
}
elseif($r =="ID")
{
$sql1="SELECT * FROM issues ORDER BY I_D ".$q." LIMIT ".$offset.", 50";
}
elseif($r =="VOTES")
{
$sql1="SELECT * FROM issues ORDER BY VOTES ".$q." LIMIT ".$offset.", 50";
}
elseif($r =="ANSWER")
{
$sql1="SELECT * FROM issues ORDER BY ANSWERS ".$q." LIMIT ".$offset.", 50";
}
elseif($r =="KNOWLEDGE")
{
$sql1="SELECT * FROM issues ORDER BY KNOWLEDGE ".$q." LIMIT ".$offset.", 50";
}
elseif($r =="DATE")
{
$sql1="SELECT * FROM issues ORDER BY DATE ".$q." LIMIT ".$offset.", 50";
}


$sql2="SELECT COUNT(*) AS num FROM issues ";


$result1 = mysql_query($sql1);
if (!$result1) { // add this check.
    die('Invalid query: ' . mysql_error());
}


$result2 = mysql_query($sql2);
if (!$result1) { // add this check.
    die('Invalid query: ' . mysql_error());
}


$count = mysql_fetch_assoc($result2);
$numissue = $count['num'];
echo "<div style='position:absolute;top:682px;left:980px;'>Total number of ISSUES = $numissue</div>";


echo "<form action='admin_delete.php' method='POST'><input type='submit' value='Delete Selected' style='position:absolute;left:1215px;top:680px;'><br />
 <table class='table'>
<tr>
<th>I_D</th>
<th>NAME</th>
<th>GROUP</th>
<th>ISSUE</th>
<th title='This issue is genuine , clear and important'>VOTES</th>
<th title='Number Of Answers'>ANSWERS</th>
<th title='This Issue Contains Knowledge'>KNOWLEDGE</th>
<th>STATUS</th>
<th>DATE</th>
<th>DEL</th>
</tr>";


while($row = mysql_fetch_array($result1)) {
  echo "<tr>";
  echo "<td>" . $row['I_D'] . "</td>";
  echo "<td>" . $row['NAME'] . "</td>";
  echo "<td>" . $row['GROUP_NAME'] . "</td>";
  echo "<td><a href=admin_link.php?a=".$row['I_D']." target='_blank' title='".nl2br(htmlspecialchars($row['DETAILED_ISSUE']))."'><span style='font-family: Segoe;font-size:15px; '>" .nl2br(htmlspecialchars($row['ISSUE'])) . "</span></a></td>";
   echo "<td>" . $row['VOTES'] . "</td>";
    echo "<td>" . $row['ANSWERS'] . "</td>";
	echo "<td>" . $row['KNOWLEDGE'] . "</td>";
	if($row['STATUS']=="solved")
  {
  echo "<td title='Solved'><img src='greentick.png'></td>";
  }
  else{
  echo "<td title='Unsolved'><img src='redcross.png'></td>";
  }
  echo "<td>" . $row['DATE'] . "</td>";
  echo "<td><input type='checkbox' value='".$row['I_D']."' name='delete".$row['I_D']."'></td>";
  echo "</tr>";
}
echo "</table></form>";
                        // SETTING UP PAGING

$next=$page+1;
$previous=$page-1;
$first=0;
$last=($numissue/50);

echo "<div style='width:100%;height:40px;background:#292b30;margin-top:0px'>";
if($page!=0){

echo "<div style='position:absolute;width:30px;cursor:pointer;margin-top:10px;left:30%;background:;color:#cadae6;text-decoration:underline;'>
      <span onclick='showresult(\"$q\",\"$r\",\"$first\")'>First</span></div>";
	  
}
	  
	 
if($numissue >=($offset)+50)
{
echo "<div style='position:absolute;width:32px;cursor:pointer;margin-top:10px;left:40%;background:;color:#cadae6;text-decoration:underline;'>
      <span onclick='showresult(\"$q\",\"$r\",\"$next\")'>Next</span></div>";

}


if ($page!=0)
{
	  echo "<div style='position:absolute;width:55px;cursor:pointer;margin-top:10px;left:50%;background:;color:#cadae6;text-decoration:underline;'>
	  <span onclick='showresult(\"$q\",\"$r\",\"$previous\")'>Previous</span>
	  </div>";
	  
}


if($numissue >=($offset)+50)
{
echo "<div style='position:absolute;width:30px;cursor:pointer;margin-top:10px;left:61%;background:;color:#cadae6;text-decoration:underline;'>
      <span onclick='showresult(\"$q\",\"$r\",\"$last\")'>Last</span></div>";
	  
	  }
echo "</div>";	  
mysql_close($con);

?>
</body>
</html>