<html>

<head>
<title> Gym Database </title>
<style>
h1 {font-family: "Georgia", sanserif ;
   color : blue;
   }
body {

  height: 120px;
  background-color: #36FF4C; /* For browsers that do not support gradients */
  background-image: linear-gradient(-90deg, #DDF832,white); /* Standard syntax (must be last) */
}
	p.selection{
		font-family: "Courier", serif;
		font-style : italic;
		font-weight : bold;
		color : blue;
	}
	p.subsel{
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

<h1 style = "color:red; display:inline"> 🏋 FITNESS GYM 🏋 </h1>
<h1> DATABASE INTERACTIONS MENU  </h1>

<div>
<p class= "selection"> ☆ SEARCH SCHEDULE (by course code): ☆</p>
<form action = "ScheduleByCCode.php" method = "get">
<?php
/*---------------- CREATION OF THE DYNAMIC SELECTION MENU ----------------*/
$connection = mysqli_connect('localhost','root','','gym');
if(mysqli_connect_errno())
{
	echo "<h1> FATAL ERROR : Connection Failed </h1>";
	die ('Failed to connect to MySQL : ' . mysqli_connect_error());
}

$sql_query = "SELECT CId,Name
              FROM course";
$query_result = mysqli_query($connection,$sql_query);

/* COUNT TOTAL NUMBER OF ROWS */

$rowCount = mysqli_num_rows($query_result);
mysqli_close($connection);
?>
<p class = "subsel">Course Code ➠</p>
<select name = "CCode"> 
<option value = "">Select Course</option>
<?php
if($rowCount > 0){
   while($row = mysqli_fetch_row($query_result)){
	echo '<option value = "'.$row[0].'">'.$row[0]." -".$row[1]." -".'</option>';
	}
} else{
	echo '<option value = "">Course not available</option>';
}
/*----------- END OF DYNAMIC SELECTION CREATION -----------*/

?>
</select>
<?php
echo "<br>";
echo "<br>";
?>
<input type = "submit" value = "Search">
</form>
</div>

<div>
<p class= "selection"> ☆ SEARCH SCHEDULE (by instructor's surname and day): ☆</p>
<form action = "ScheduleByInsDay.php" method = "get">
<?php
/*---------------- CREATION OF THE DYNAMIC SELECTION MENU ----------------*/
$connection = mysqli_connect('localhost','root','','gym');
if(mysqli_connect_errno())
{
	echo "<h1> FATAL ERROR : Connection Failed </h1>";
	die ('Failed to connect to MySQL : ' . mysqli_connect_error());
}

$sql_query = "SELECT surname
              FROM trainer t";
$query_result = mysqli_query($connection,$sql_query);

/* COUNT TOTAL NUMBER OF ROWS */

$rowCount = mysqli_num_rows($query_result);
mysqli_close($connection);
?>
<p class = "subsel">Surname ➠ </p>
<select name = "surname">
<option value = "">Select surname</option>
<?php
if($rowCount > 0){
   while($row = mysqli_fetch_row($query_result)){
	echo '<option value = "'.$row[0].'">'.$row[0].'</option>';
	}
} else{
	echo '<option value = "">Surname not available</option>';
}
/*----------- END OF DYNAMIC SELECTION CREATION -----------*/
?>
</select>

<?php
echo "<br>";
?>
<p class = "subsel">Day   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   ➠ </p>
<select name= "WeekDay">
<option value ="">Select day</option>
<option value = "Monday"> Monday </option>
<option value = "Tuesday"> Tuesday </option>
<option value = "Wednesday"> Wednesday </option>
<option value = "Thursday"> Thursday</option>
<option value = "Friday"> Friday </option>
<option value = "Saturday"> Saturday </option>
<option value = "Sunday"> Sunday </option>
</select>
<?php
echo "<br>";
?>
<?php
echo "<br>";
?>

<input type = "submit" value = "Search">

</form>
</div>

<div>
<form action = "InsertNewCourse.php" method = "get">
 <p class= "selection"> ☆ INSERT NEW COURSE : ☆</p>
 
   <p class = "subsel">
   CId   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;➠
   <input type = "text" name = "CId" size = "30" placeholder = "CT1XX" >
   
   &nbsp;&nbsp;&nbsp; CName  ➠
   <input type = "text" name = "CName" size = "30" placeholder = "Course name" >
   </p>
   
   <p></p>
   
    <p class = "subsel">
	CType  ➠
	<input type = "text" name = "CType" size = "30" placeholder = "Course type" >
	
    &nbsp;&nbsp;&nbsp; CLevel  ➠
	<input type = "text" name = "CLevel" size = "30" placeholder = "Value from 1 to 4" >
	</p>
	
   <p></p>
<input type = "submit" value = "Confirm">

</form>
</div>

<div>
<form action = "InsertNewLesson.php" method = "get">
 <p class= "selection"> ☆ INSERT NEW LESSON : ☆</p>
<?php
/*---------------- CREATION OF THE DYNAMIC SELECTION MENU ----------------*/
$connection = mysqli_connect('localhost','root','','gym');
if(mysqli_connect_errno())
{echo "<h1> FATAL ERROR : Connection Failed </h1>";
die ('Failed to connect to MySQL : ' . mysqli_connect_error());
}
$sql_query = "SELECT name,surname,SSN
              FROM trainer t";
$query_result = mysqli_query($connection,$sql_query);

/* COUNT TOTAL NUMBER OF ROWS */

$rowCount = mysqli_num_rows($query_result);
mysqli_close($connection);
?>
<p class = "subsel">Instructor &nbsp;&nbsp;➠ </p>
<select name = "SSN">
<option value = "">Select instructor</option>
<?php
if($rowCount > 0){
   while($row = mysqli_fetch_row($query_result)){
	echo '<option value = "'.$row[2].'">'.$row[0].' '.$row[1].' '.'('.$row[2].')'.'</option>';
	}
} else{
	echo '<option value = "">Surname not available</option>';
}
/*----------- END OF DYNAMIC SELECTION CREATION -----------*/
?>
</select>
<p></p>
<p class = "subsel">Day  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;    ➠ </p>
<select name= "WeekDay">
<option value ="">Select day</option>
<option value = "Monday"> Monday </option>
<option value = "Tuesday"> Tuesday </option>
<option value = "Wednesday"> Wednesday </option>
<option value = "Thursday"> Thursday</option>
<option value = "Friday"> Friday </option>
</select>
<p></p>
<p class = "subsel">Start Time &nbsp;➠ </p>
<select name= "StartTime">
<option value ="">Select Start Time</option>
<option value = "8:00"> 8:00</option>
<option value = "8:30"> 8:30</option>
<option value = "9:00"> 9:00</option>
<option value = "9:30"> 9:30</option>
<option value = "10:00"> 10:00</option>
<option value = "10:30"> 10:30</option>
<option value = "11:00"> 11:00</option>
<option value = "11:30"> 11:30</option>
<option value = "12:00"> 12:00</option>
<option value = "12:30"> 12:30</option>
<option value = "13:00"> 13:00</option>
<option value = "13:30"> 13:30</option>
<option value = "14:00"> 14:00</option>
<option value = "14:30"> 14:30</option>
<option value = "15:00"> 15:00</option>
<option value = "15:30"> 15:30</option>
<option value = "16:00"> 16:00</option>
<option value = "16:30"> 16:30</option>
<option value = "17:00"> 17:00</option>
<option value = "17:30"> 17:30</option>
<option value = "18:00"> 18:00</option>
<option value = "18:30"> 18:30</option>
<option value = "19:00"> 19:00</option>
<option value = "19:30"> 19:30</option>
<option value = "20:00"> 20:00</option>
<option value = "20:30"> 20:30</option>
<option value = "21:00"> 21:00</option>
<option value = "21:30"> 21:30</option>
<option value = "22:00"> 22:00</option>
</select>
<p></p>
<p class = "subsel">Duration &nbsp;&nbsp;&nbsp; ➠ </p>
<input type = "text" name = "Duration" placeholder = "Ex : '45' (minutes)">
<p></p>
<?php
/*---------------- CREATION OF THE DYNAMIC SELECTION MENU ----------------*/
$connection = mysqli_connect('localhost','root','','gym');
if(mysqli_connect_errno())
{echo "<h1> FATAL ERROR : Connection Failed </h1>";
die ('Failed to connect to MySQL : ' . mysqli_connect_error());
}
$sql_query = "SELECT Name,CId
              FROM course c";
$query_result = mysqli_query($connection,$sql_query);

/* COUNT TOTAL NUMBER OF ROWS */

$rowCount = mysqli_num_rows($query_result);
mysqli_close($connection);
?>
<p class = "subsel">Course &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ➠ </p>
<select name = "CId">
<option value = "">Select course</option>
<?php
if($rowCount > 0){
   while($row = mysqli_fetch_row($query_result)){
	echo '<option value = "'.$row[1].'">'.$row[0].' '.'('.$row[1].')'.'</option>';
	}
} else{
	echo '<option value = "">Course not available</option>';
}
/*----------- END OF DYNAMIC SELECTION CREATION -----------*/
?>
</select>
<p></p>
<p class = "subsel">Gym Room ➠ </p>
<input type = "text" name = "Room" placeholder = "Ex : 'S4'">
<p></p>
<input type = "submit" value = "Confirm">
</form>


</div>
</body>
</html>