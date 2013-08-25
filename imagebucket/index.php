<?php
echo "<br/>";
include_once("header.php");
?>



<div id="content">
<form  action="results.php" method="POST">
<input type='text' class='textbox' name='path' placeholder=" Type the pathname of folder" style="width:280px;" />

<select class='textbox' name='size'>
	<option value="Size">Size</option>
	<option value="low" >Low</option>
	<option value ="medium">Medium</option>
	<option value="high">High</option>
</select>

<input type='text' class='textbox' name='faces' placeholder=" No. of Faces" style="width:150px;" />

<select class='textbox' name='color'>
	<option value"null">Color</option>
	<option value="red" >Red</option>
	<option value ="blue">Blue</option>
	<option value="green">Green</option>
	<option value="white">Bright</option>
	<option value="black">Dark</option>
</select>
<input type="text" class='textbox' id="datepicker" placeholder="Start Date"  name ="sdate" style:"width:50px;"/>
<input type="text" class='textbox' id="datepicker2" placeholder="End Date"  name ="edate" style:"width:50px;"/>



<input class='textbox' type='submit' value='Search'>

</form>




</div>

<?php

include_once("footer.php")
?>