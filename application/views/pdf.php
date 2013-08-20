<html>
<head>
	<title></title>
	<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="http://localhost/sajt/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://localhost/sajt/style/button.css" media="all" />
<link rel="stylesheet" media="all" href="http://localhost/sajt/style/type/folks.css" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="http://localhost/sajt/style/css/ie7.css" media="all" />
<![endif]-->
<script type="text/javascript" src="http://localhost/sajt/style/js/jquery-1.5.min.js"></script>
<script type="text/javascript" src="http://localhost/sajt/style/js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="http://localhost/sajt/style/js/scripts.js"></script>
<script type="text/javascript" src="http://localhost/sajt/style/js/jquery.jcarousel.js"></script>
 <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<style type="text/css">
	tr {
		border-left: 1px solid #c1c1c1;
		border-top: 1px solid #c1c1c1;
	}
	td {
		padding: 8px 10px;
	border-right: 1px solid #c1c1c1;
	}
	table {
		border-collapse: collapse;
		border-bottom: 1px solid #c1c1c1;
		border-top: 1px solid #c1c1c1;
		border-left: 1px solid #c1c1c1;
	}
	</style>
</head>
<body>
	
<div class="pdheader">
	<div class="pdlogo">

	</div>
</div>
<div class="pdcontent">
	<table>
		<thead><tr><td>Date</td><td>Hotel</td><td>Room</td><td>Days</td><td>Cost:</td></tr></thead>
		<tbody><tr><td><?php echo "From <br> " . $actual_data['from'] . "<br> To<br>     " . $actual_data['to'] ?></td><td><?php echo $actual_data['hotel'] ?></td><td><?php echo $actual_data['room'] ?></td><td><?php echo $actual_data['days'] ?></td><td><?php echo $actual_data['cost'] ?></td></tr></tbody>
	</table>
</div>
<div class="pdfooter">
	<br><br>
Thank you for being our guest! We look forward to accommodating you again in the future <br>
Stay connected with us for te latest offers
<?php //var_dump($proba); ?>
<?php// var_dump($booked[0]) ?>
<?php //var_dump($room) ?>
<?php //var_dump($action) ?>
<?php //var_dump($test) ?>
</div>
</body>
</html>