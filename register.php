<?php
#Assign variables
$needtofix = "";
$username = $_GET["username"];
if ($username == "" || strlen($username) > 30)
{
	$needtofix = $needtofix ."un=y&";
}
$password = $_GET["password"];
if ($password == "" || strlen($password) > 30)
{
	$needtofix = $needtofix ."pw=y&";
}
$first = $_GET["firstname"];
if ($first == "" || strlen($first) > 30)
{
	$needtofix = $needtofix ."fname=y&";
}
$last = $_GET["lastname"];
if ($last == "" || strlen($last) > 30)
{
	$needtofix = $needtofix ."lname=y&";
}
$address1 = $_GET["address1"];
if ($address1 == "" || strlen($address1) > 50)
{
	$needtofix = $needtofix ."address1=y&";
}
$address2 = $_GET["address2"];
if (strlen($address2) > 50)
{
	$needtofix = $needtofix ."address2=y&";
}
$city = $_GET["city"];
if ($city == "" || strlen($city) > 30)
{
	$needtofix = $needtofix ."city=y&";
}
$zip = $_GET["zip"];
if (strlen($zip) !=5 || !is_numeric($zip))
{
	$needtofix = $needtofix ."zip=y&";
}
$state = $_GET["state"];
$country = $_GET["country"];
#Define mysql connection 
$link = @mysql_connect('localhost','root','Soccer1s'); 
#Define Database being use
$DBName= "`logindatabase`";
#Selecting the Database we are using
@mysql_select_db($DBName, $link);
#Define the tables name
$Table = "`members`";
$Table2 = "`login`";
$Table3 = "`create_date`";
$Table4 = "`credentials`";
#Defin Query to check if the user have an account already
$SQLCheck = "SELECT * FROM $DBName.$Table WHERE `m_first` = '$first' and `m_last` = '$last'";
#Run the query to see if any result came back 
$QueryCheck = @mysql_query($SQLCheck, $link);
#If more than 1 result, an alert is thrown and option to go back
if ($needtofix <> "")
	{
		$inputdata = 'fn='.$first.'&ln='.$last.'&ad1='.$address1.'&ad2='.$address2.'&city2='.$city.'&zip2='.$zip.'&st='.$state.'&un='.$username;
		header('Location: Login.html?'.$needtofix.$inputdata);
		exit();
	}
	elseif (@mysql_num_rows($QueryCheck) <> 0)
	{
		header('Location: Login.html?existed=1');
		exit();
	}
	else
{
	$InsertSQL = "INSERT INTO $DBName.$Table (member_id, m_first, m_last, address1, address2, city, state, country, zip) VALUES(NULL,'$first','$last','$address1','$address2','$city','$state','$country','$zip')";
	@mysql_query($InsertSQL, $link);
	$SelectSQL = "Select member_id from $DBName.$Table Where `m_first` = '$first' and `m_last` = '$last'";
	$QueryResult = @mysql_query($SelectSQL, $link);
	$Row = mysql_fetch_assoc($QueryResult);
	$member_id = $Row['member_id'];
	$InsertSQL2 = "INSERT INTO $DBName.$Table2 (member_id,login_date) VALUES('".$member_id."','".date('c')."')";
	$InsertSQL3 = "INSERT INTO $DBName.$Table3 (member_id,create_date) VALUES('".$member_id."','".date('c')."')";
	@mysql_query($InsertSQL2, $link);
	@mysql_query($InsertSQL3, $link);
	
	$InsertSQL4 = "INSERT INTO $DBName.$Table4 (member_id,user_id,password) VALUES('".$member_id."','".$username."','".$password."')";
	@mysql_query($InsertSQL4, $link);
	
		header('Location: confirmation.html?status=new&fname='.$first.'&lname='.$last.'&address1='.$address1.'&address2='.$address2.'&city='.$city.'&state='.$state.'&zip='.$zip);
		exit();
}
#If no result came back than the info gets inserted into the table as a new member

#Close connection
mysql_close($link); 

?>