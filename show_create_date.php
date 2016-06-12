<?php
echo'
<form action="create_report.html">
<input type="submit" style=" float: left;" value="Go Back">
</form><br><br>';
#Assign variables
$all;
$start;
$end;
if (isset($_GET["all"]))
{
$all = $_GET["all"];
}
else
{
$start = $_GET["start"];
$end = $_GET["end"];
}
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
#If more than 1 result, an alert is thrown and option to go back
$SelectSQL;

if (isset($_GET["all"]))
{
	$SelectSQL = "Select mdetails.`m_first`,mdetails.`m_last`,mdetails.`address1`,mdetails.`address2`,mdetails.`city`,mdetails.`state`,mdetails.`zip`, cdate.`create_date`
from $DBName.$Table mdetails
join $DBName.$Table3 cdate on cdate.`member_id` = mdetails.`member_id`
order by cdate.`create_date`,mdetails.`m_first` desc";
}
else
{
	$SelectSQL = "Select mdetails.`m_first`,mdetails.`m_last`,mdetails.`address1`,mdetails.`address2`,mdetails.`city`,mdetails.`state`,mdetails.`zip`, cdate.`create_date`
from $DBName.$Table mdetails
join $DBName.$Table3 cdate on cdate.`member_id` = mdetails.`member_id`
Where cdate.`create_date` >= '$start' and cdate.`create_date` <= '$end'
order by cdate.`create_date`,mdetails.`m_first` desc";
}
	$QueryResult = @mysql_query($SelectSQL, $link);
	
	$totalerow = @mysql_num_rows($QueryResult);
	$rowreturn = array();
for ($x=0; $x < $totalerow; $x++)
{
	$Row = mysql_fetch_assoc($QueryResult);
					$rowreturn[$x][0] = $Row['m_first'];
					$rowreturn[$x][1] = $Row['m_last'];
					$rowreturn[$x][2] = $Row['address1'];
					$rowreturn[$x][3] = $Row['address2'];
					$rowreturn[$x][4] = $Row['city'];
					$rowreturn[$x][5] = $Row['state'];
					$rowreturn[$x][6] = $Row['zip'];
					$rowreturn[$x][7] = $Row['create_date'];
}


#Close connection
mysql_close($link); 
?>

<table style="border-style: solid;">
	<tr>
		<th style="background-color: SteelBlue;">First Name</th>
		<th style="background-color: SteelBlue;">Last Name</th>
		<th style="background-color: SteelBlue;">Address 1</th>
		<th style="background-color: SteelBlue;">Address 2</th>
		<th style="background-color: SteelBlue;">City</th>
		<th style="background-color: SteelBlue;">State</th>
		<th style="background-color: SteelBlue;">Zip</th>
		<th style="background-color: SteelBlue;">Country</th>
		<th style="background-color: SteelBlue;">Date</th>
	</tr>
	<?php
	for ($x=0; $x < $totalerow; $x++)
{
	if ($x % 2 == 0) 
	{
		$coloris = 'lightblue';
	}
	else
	{
		$coloris = 'white';
	}
	echo '<tr style="background-color: '.$coloris.';">
		<td>'.$rowreturn[$x][0].'</td>
		<td>'.$rowreturn[$x][1].'</td>
		<td>'.$rowreturn[$x][2].'</td>
		<td>'.$rowreturn[$x][3].'</td>
		<td>'.$rowreturn[$x][4].'</td>
		<td>'.$rowreturn[$x][5].'</td>
		<td>'.$rowreturn[$x][6].'</td>
		<td>US</td>
		<td>'.$rowreturn[$x][7].'</td>
	</tr>';
}
	?>
</table>