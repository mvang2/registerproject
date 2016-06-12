<!DOCTYPE html>
<html>
<body>
<?php
$PE='';
if (isset($_GET["PE"]))
{
	$PE = $_GET["PE"];
}
?>
<h2>Did you miss type?</h2>

<form action="rec.php" method="get">
  Phone or Email: 
  <input type="text" name="PE" value="<?php echo $PE;?>">
  <br>
  <input type="submit" name = "submit">
</form>
<br>
<br>
<p>_________________________________________________________________________________________</p>
<h2>Or Are you new?</h2>
<p>Must have email or phone or both</p>
<script>

function validateForm() {

	var good = 0;
	var good1 = 0;
    var x = document.forms["myForm"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
	if (x != "")
	{
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			good1 = good1-1;
			document.getElementById("email").innerHTML = "Invalid email";
		}
		else
		{
			good = good+1;
		}
	}
	var y = document.forms["myForm"]["phone"].value;
	var yp = y.replace("(", "");
	var yp = yp.replace(")", "");
	var yp = yp.replace(" ", "");
	var yp = yp.replace("-", "");
	if (y != "")
	{
		if (yp.length == 10 && isNaN(yp) == false) {
			good1 = good1+1;
			document.getElementById("pn").value = yp;
		}
		else
		{
			good = good-1;
			document.getElementById("phone").innerHTML = "Invalid Phone Number";
		}
	}
	if  (y == "" && x == "")
	{
		alert("One have to be fill in");
	}
	if (good > 0 || good1 > 0)
	{
		document.getElementById("myForm").submit();
	}
}
</script>
<form action="register.php" name="myForm" id="myForm" method="get"><!--action="register.php"-->
  Email:<br>
  <input type="text" name="email"><p id="email" style="color:red;"></p>
  <br>
  Phone:<br>
  <input id="pn" type="text" name="phone"><p id="phone" style="color:red;"></p>
  <br>
  <button  type="button" id="myAnchor" onclick="validateForm()">New</button>
  
</form>

<p></p>

</body>
</html>