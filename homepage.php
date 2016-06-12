<?php
$status = $_GET["status"];
$fname = $_GET["fname"];
$lname = $_GET["lname"];
$address1 = $_GET["address1"];
$address2 = $_GET["address2"];
$city = $_GET["city"];
$zip = $_GET["zip"];
$state = $_GET["state"];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8" />
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>
<body>
<?php
if ($status == "return")
{
	echo "<h1>Welcome Back ".$fname."</h1>"; 
}
else 
{
	echo "<h1>Welcome ".$fname."</h1>";
}
?>

<form action="loginform.html">
<input type="submit" style="position: absolute;
    right: 700px;
    border: 3px solid #73AD21;
    padding: 10px;" value="Log out">
</form>
<?php
if ($fname == 'admin' && $lname == 'admin')
{
	echo '<form action="create_report.html">
	<input type="submit" style="position: absolute;
    right: 610px;
    border: 3px solid #73AD21;
    padding: 10px;" value="Report">
</form>';
}
?>
<div style="position: absolute;
    left: 400px;
    border: 3px solid #73AD21;
    padding: 10px;">
	
<label><b>First Name:</b></label><br>
<label><?php echo $fname; ?></label><br>
<label><b>Last Name:</b></label><br>
<label><?php echo $lname; ?></label><br>
<label><b>Address 1:</b></label><br>
<label><?php echo $address1; ?></label><br>
<label><b>Address 2:</b></label><br>
<label><?php echo $address2; ?></label><br>
<label><b>City:</b></label><br>
<label><?php echo $city; ?></label><br>
<label><b>Zip:</b></label><br>
<label><?php echo $zip; ?></label><br>
<label><b>State:</b></label><br>
<label><?php echo $state; ?></label><br>
<label><b>Country:</b></label><br>
<label>US</label>

</div>
</body>
</html>