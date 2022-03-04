<html>
<head>
<title> Insertion of new course </title>
<style>
   h1 
   {font-family: "Georgia", sanserif ;
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
// CHECKING AND STORING ALL VARIABLES //

// CHECK #1 : PARAMETERS CORRECTLY PASSED //
if (isset($_GET['CId'])) 
{ 
$CId = $_GET['CId'];
} else{
echo "<h2>Error! No CId set! </h2>";
}
if (isset($_GET['CName'])) 
{ 
$CName = $_GET['CName'];
} else{
echo "<h2>Error! No CName set! </h2>";
}
if (isset($_GET['CType'])) 
{ 
$CType = $_GET['CType'];
} else{
echo "<h2>Error! No CType set! </h2>";
}
if (isset($_GET['CLevel'])) 
{ 
$CLevel = $_GET['CLevel'];
} else{
echo "<h2>Error! No CLevel set! </h2>";
}
// CHECK #2 : CHECKING CORRECTNESS OF VALUES //
if(strlen($CId)!=5 && $CLevel<1 || $CLevel >4){
    echo "<h2> ⥽ Error! CId value does not follow the standard prototype suggested into the insertion form ⥼ </h2>";
    echo"<br>";
	echo "<h2> ⥽ Error! CLevel value is not between 1 and 4  ⥼ </h2>";
	 echo"<br>";
	die ('INSERTION FAILED : ABORTING DATABASE TRANSACTION ...');
}
else
	if(strlen($CId)!=5){
	echo "<h2> ⥽ Error! CId value does not follow the standard prototype suggested into the insertion form ⥼ </h2>";
	 echo"<br>";
	die ('Failed to insert new Course into database');
	}
else if($CLevel<1 || $CLevel >4){
	echo "<h2> ⥽ Error! CLevel value is not between 1 and 4 ⥼ </h2>";
	 echo"<br>";
	die ('INSERTION FAILED : ABORTING DATABASE TRANSACTION ...');
}

// CHECK #3 : CHECKING THAT THERE ARE DUPLICATED KEY (CId) //

// OPEN CONNECTION TO GET CIds ALREADY STORED IN THE DATABASE //
$connection = mysqli_connect('localhost','root','','gym');
if(mysqli_connect_errno())
{
	echo "<h2> FATAL ERROR : Connection Failed </h2>";
	 echo"<br>";
	die ('Failed to connect to MySQL : ' . mysqli_connect_error());
}
$sql_query =   " SELECT CId
                 FROM course";

$query_result = mysqli_query($connection,$sql_query);
if(!$query_result)
{
	die('Query error : ' . mysqli_error($connection));
}

while($row = mysqli_fetch_row($query_result))
{
if($CId ==$row[0])
{
	echo "<h2> ⥽ Error : CId ($CId) is already in the database ⥼ </h2>";
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

/* QUERY SQL FOR INSERTION OF NEW COURSE*/
/* The application should check that all the fields are filled and that the value for CLevel is an integer between 1 and
4. In case of missing data, duplicated key (CId) or values outside the allowed range for
CLevel, the application should generate an error message. Otherwise, if all values are
correct and the insert operation is successful, the application should show a confirmation
message. */
	
$sql_query =   "INSERT INTO COURSE(CId,Name,CType,CLevel)
               values('$CId','$CName','$CType',$CLevel)";

$query_result = mysqli_query($connection,$sql_query);

if(!$query_result)
{
	die('Query error : ' . mysqli_error($connection));
}
else
{
	echo "<h1> 🏋 Status transaction: SUCCESS 🏋  </h1>";
	echo "<h2> ➣➣ ($CId,$CName,$CType,$CLevel) HAS BEEN UPDATED INTO THE DATABASE </h2>";
}

?>
</div>
<div>
 <input type="button" onclick="window.location.href = 'https://localhost/gym.php';" value="Main menu"/>
</div>

</body>








</html>