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
 <input type="button" onclick="window.location.href = 'https://localhost/gym.php';" value="Main menu"/>
</div>

<div>
<?php
// CHECK #1 : PARAMETERS CORRECTLY PASSED //
if (isset($_GET['SSN'])) 
{ 
$SSN = $_GET['SSN'];
} else{
echo "<h2>Error! No SSN set! </h2>";
}
if (isset($_GET['WeekDay'])) 
{ 
$WeekDay = $_GET['WeekDay'];
} else{
echo "<h2>Error! No WeekDay set! </h2>";
}
if (isset($_GET['StartTime'])) 
{ 
$StartTime = $_GET['StartTime'];
} else{
echo "<h2>Error! No StartTime set! </h2>";
}
if (isset($_GET['Duration'])) 
{ 
$Duration = $_GET['Duration'];
} else{
echo "<h2>Error! No Duration set! </h2>";
}
if (isset($_GET['CId'])) 
{ 
$CId = $_GET['CId'];
} else{
echo "<h2>Error! No CId set! </h2>";
}
if (isset($_GET['Room'])) 
{ 
$Room = $_GET['Room'];
} else{
echo "<h2>Error! No Room set! </h2>";
}
// CHECK #2 :  The application should check that the user does not insert lessons lasting more than 60 minutes and that the day is between Monday and Friday//
// The insertion of a new lesson should be allowed and executed only if no other lesson is scheduled for the same course in the same day of week. //
if((!is_numeric($Duration)) || ($Duration > 60) || ($Duration <= 0)){
    echo "<h2> ⥽ Error! *Duration* parameter entered is incorrect : use only a digits (from 0 to 60) ⥼ </h2>";
	echo"<br>";
	die ('Failed to insert new Lesson into database');
}
else
{
}
// OPEN CONNECTION TO GET CIds ALREADY STORED IN THE DATABASE //
$connection = mysqli_connect('localhost','root','','gym');
if(mysqli_connect_errno())
{
	echo "<h2> FATAL ERROR : Connection Failed </h2>";
	 echo"<br>";
	die ('Failed to connect to MySQL : ' . mysqli_connect_error());
}
$sql_query =   " SELECT CId,WeekDay
                 FROM schedule";

$query_result = mysqli_query($connection,$sql_query);
if(!$query_result)
{
	die('Query error : ' . mysqli_error($connection));
}

while($row = mysqli_fetch_row($query_result))
{
if($CId == $row[0] && $WeekDay == $row[1])
{
	echo "<h2> ⥽ Error : This course ($CId) already has a lesson planned for the chosen day ⥼ </h2>";
	echo"<br>";
    die ('INSERTION FAILED : ABORTING DATABASE TRANSACTION ...');
}
}
mysqli_close($connection);

// OPEN CONNECTION TO BEGIN THE TRANSACTION //
$connection = mysqli_connect('localhost','root','','gym');
if(mysqli_connect_errno())
{
	echo "<h2> FATAL ERROR : Connection Failed </h2>";
	die ('Failed to connect to MySQL : ' . mysqli_connect_error());
}

/* QUERY SQL FOR INSERTION OF NEW LESSON*/
	
$sql_query =   "INSERT INTO SCHEDULE(SSN,WeekDay,StartTime,Duration,CId,GymRoom)
                values('$SSN','$WeekDay','$StartTime','$Duration','$CId','$Room');";

$query_result = mysqli_query($connection,$sql_query);

if(!$query_result)
{
	die('Query error : ' . mysqli_error($connection));
}
else
{
	echo "<h1> 🏋 Status transaction: SUCCESS 🏋  </h1>";
	echo "<h2> ➣➣ ($SSN,$WeekDay,$StartTime,$Duration,$CId,$Room) HAS BEEN UPDATED INTO THE DATABASE </h2>";
}
mysqli_close($connection);
?>




</div>




<div>
 <input type="button" onclick="window.location.href = 'https://localhost/gym.php';" value="Main menu"/>
</div>


</body>

</html>