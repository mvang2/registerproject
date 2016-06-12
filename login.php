<?php
$username = $_GET["username"];
$password = $_GET["password"];
#Define mysql connection 
$link = @mysql_connect('localhost','root','Soccer1s'); 
#Define Database being use
$DBName= "`logindatabase`";
#Selecting the Database we are using
@mysql_select_db($DBName, $link);
#Define the tables name
$Table = "`members`";
$Table2 = "`credentials`";
$SELECTSQL = "SELECT `member_id` FROM $DBName.$Table2 WHERE `user_id` = '$username' and `password` = '$password'";
$QueryRun = @mysql_query($SELECTSQL, $link);
if (@mysql_num_rows($QueryRun) <> 0)
	{
		$Row = mysql_fetch_assoc($QueryRun);
		$m_id = $Row['member_id'];
		$SELECTSQL2 = "SELECT * FROM $DBName.$Table WHERE `member_id` = '$m_id'";
		$QueryRun2 = @mysql_query($SELECTSQL2, $link);
		$Row2 = mysql_fetch_assoc($QueryRun2);
		$first= $Row2['m_first'];
		$last= $Row2['m_last'];
		$address1= $Row2['address1'];
		$address2= $Row2['address2'];
		$city= $Row2['city'];
		$state= $Row2['state'];
		$zip= $Row2['zip'];
		header('Location: homepage.php?status=return&fname='.$first.'&lname='.$last.'&address1='.$address1.'&address2='.$address2.'&city='.$city.'&state='.$state.'&zip='.$zip);
		exit();
		
	}
else
{
	header('Location: loginform.html?denial=y');
	exit();
}


mysql_close($link); 

?>