<?php
	include_once('BrainStation.php');
	$bs23 = new BrainStation();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ecommerce</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.page-header {
			padding-bottom: 20px;
			margin: 40px 0 20px;
			border-bottom: none;
		}
	</style>
</head>
<body>
<div class="container">
	<h2 class="page-header text-center">Brain Station 23 | Task </h2>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Sl.</th>
						<th>Task</th>
						<th>Total Items</th>
					</tr>
				</thead>
				<tbody>
					
					<tr>
						<td>1</td>
						<td>Task 01</td>
						<td><a href="http://localhost/ecommerce/categories.php" target="_blank">click to view</a></td>
					</tr>
					<tr>
						<td>2</td>
						<td>Task 02</td>
						<td><a href="http://localhost/ecommerce/categories-tree.php" target="_blank">click to view</a></td>
					</tr>
							
					
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="stylesheet"></script>
</body>
</html>