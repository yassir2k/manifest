<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/manifest-css.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap4-toggle.css">
	  <script src="js/bootstrap-input-spinner.js"></script>
  <title>Manifesta</title>
</head>

<body>
<div id="container">
<input id="entryNO" style="width: 300px" placeholder="Enter the number of entries" required type="number" value="" min="0" max="100"/>
<br />
<br />
<?php date_default_timezone_set("Africa/Lagos");
$bc = "FCT-15072020005344-RGO-BATCH-132";
$substring ='-';
$l= strripos($bc, $substring);
echo substr($bc,$l+1);
?>	  
<div class="inner" id="tblS">
</div>
	<button disabled id="submitR" type="button" class="btn btn-success btn-sm"><i class="fa fa-send-o"></i>
		Submit to Registry
	</button>
	<div class="outer" id="outcome">
	</div>
</div>
</body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="js/bootstrap4-toggle.js"></script>
  <script src="js/mindmup-editabletable.js"></script>

<html>