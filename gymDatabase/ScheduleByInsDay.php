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
<?php
echo "<h1> 🏋 Schedule  🏋 </h1>";
// Before using $_GET['value'] 
if (isset($_GET['surname'])) 
{ 
// Instructions if $_GET['value'] exist 
$ISurname = $_GET['surname'];
echo "<h2> Instructor Surname: $ISurname</h2>";
} else{
echo "<h1>Error!</h1>";
}
echo "<br>";
// Before using $_GET['value'] 
if (isset($_GET['WeekDay'])) 
{ 
// Instructions if $_GET['value'] exist 
$WeekDay = $_GET['WeekDay'];
echo "<h2> Day Requested : $WeekDay</h2>";
echo "<br>";
} else{
echo "<h1>Error!</h1>";
}

$connection = mysqli_connect('localhost','root','','gym');
if(mysqli_connect_errno())
{
	echo "<h1> FATAL ERROR : Connection Failed </h1>";
	die ('Failed to connect to MySQL : ' . mysqli_connect_error());
}

/* QUERY SQL FOR SCHEDULE OF THE RECEIVED INSTRUCTOR SURNAME AND DAY FROM THE FORM */
/* QUERY : show all the lessons held by trainers with the given surname and scheduled for the given week day. For
each lesson show the day of the week, the start time, the duration, the room, the name, type and
level of the course, and the SSN, name and surname of the trainer. Lessons should be listed
ordered by trainer SSN and by course name. If the selected trainer has no lessons scheduled for
the selected day, show the message “No lesson scheduled for the trainer <surname> on <week
day>”. */
	
$sql_query =   "SELECT DISTINCT s.WeekDay,s.StartTime,s.Duration,s.GymRoom,c.Name,c.CType,c.CLevel,t.SSN,t.Name,t.Surname
                FROM course c, schedule s , trainer t
				WHERE t.Surname = '$ISurname' AND t.SSN = s.SSN AND s.CID = c.CId AND s.WeekDay = '$WeekDay'
				ORDER BY t.SSN, c.Name";
				
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
else{
echo "<h2>No lesson scheduled for the trainer $ISurname on $WeekDay </h2>";
}
mysqli_close($connection);
echo "<br>";
echo "<br>";
?>
</div>

<div>
 <input type="button" onclick="window.location.href = 'https://localhost/gym.php';" value="Main menu"/>
</div>


</body>

</html>