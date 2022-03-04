<html>

<head>
<title> SCHEDULE </title>
<style>
h1 {font-family: "Georgia", sanserif ;
   color : blue;
   }
body {

  height: 120px;
  background-color: #36FF4C; /* For browsers that do not support gradients */
  background-image: linear-gradient(-90deg, #DDF832,white); /* Standard syntax (must be last) */
}
	h2{
		font-family: "Times New Roman", serif;
		font-style : normal;
		font-weight : light;
		color : red;
		display: inline;
	}
	div {
    padding: 10px;
    border-width: 1px;
    border-style: solid;
    border-radius: 8px;
    border-color: black;
  }
</style>
</head>

<body>

<div>
<p>
<?php

// Before using $_GET['value'] 
if (isset($_GET['CCode'])) 
{ 
// Instructions if $_GET['value'] exist 
$CCode = $_GET['CCode'];
echo "<h1> 🏋  Schedule  🏋 </h1>";
echo "<br>";
echo "<h2> Course Code Requested : $CCode</h2>";
} else{
echo "<h1>Error!</h1>";
}

$connection = mysqli_connect('localhost','root','','gym');
if(mysqli_connect_errno())
{
	echo "<h1> FATAL ERROR : Connection Failed </h1>";
	die ('Failed to connect to MySQL : ' . mysqli_connect_error());
}

/* QUERY SQL FOR SCHEDULE OF THE RECEIVED COURSE CODE FROM THE FORM */
/* QUERY : For the CCode received show all weekly lessons and for each
   lesson show day, start time, duration , room and the name and surname
    of the trainer */
	
$sql_query =   "SELECT DISTINCT s.WeekDay,s.StartTime,s.Duration,s.GymRoom,t.Name, t.Surname
                FROM course c, schedule s , trainer t
				WHERE s.CId = '$CCode' AND s.SSN = t.SSN
				ORDER BY s.WeekDay, s.StartTime";

$query_result = mysqli_query($connection,$sql_query);

if(!$query_result)
{
	die('Query error : ' . mysqli_error($connection));
}

/* CREATION OF A TABLE */
if(mysqli_num_rows($query_result) > 0)
{
	echo "<table border = 1 cellpadding = 10>";
	echo "<tr>";
	for($i = 0; $i < mysqli_num_fields($query_result); $i++){
	$title = mysqli_fetch_field($query_result);
	$name = $title -> name;
	echo "<th> $name </th>";
	}
	echo "</tr>";
	
/* FILLING THE TABLE */
while($row = mysqli_fetch_row($query_result))
{
 echo "<tr>";
 for($i = 0; $i < mysqli_num_fields($query_result); $i++){
	 echo "<td>$row[$i]</td>";
 }
 echo "</tr>";
}
}
mysqli_close($connection);
echo "<br>";
echo "<br>";
?>
</p>
</div>
<p></p>
<div>
 <input type="button" onclick="window.location.href = 'https://localhost/gym.php';" value="Main menu"/>
 </div>
</body>

</html>