<?php
	include_once('BrainStation.php');
	$bs23 = new BrainStation();

	//fetch data

	$sql = "SELECT SUM(A1.TotalItem) AS TotalItem , B1.Name AS CategoryName,
			
				(CASE WHEN A1.ParentcategoryId in 
						(SELECT Id FROM category WHERE NOT EXISTS ( SELECT categoryId FROM catetory_relations 
							WHERE catetory_relations.categoryId = category.Id)
						) THEN A1.ParentcategoryId
				ELSE (SELECT ParentcategoryId FROM catetory_relations WHERE categoryId = A1.ParentcategoryId)
				END) as ParentcategoryId
				FROM (			
				SELECT A.*, 
			
					(CASE WHEN B.ParentcategoryId in 
						(SELECT Id FROM category WHERE NOT EXISTS ( SELECT categoryId FROM catetory_relations 
							WHERE catetory_relations.categoryId = category.Id)
						) THEN B.ParentcategoryId
				ELSE (SELECT ParentcategoryId FROM catetory_relations WHERE categoryId = B.ParentcategoryId)
				END) as ParentcategoryId
		
			FROM (
					SELECT category.Name AS CategoryName, catetory_relations.ParentcategoryId AS SubCategoryId, COUNT(item_category_relations.categoryId) AS TotalItem
					FROM item_category_relations, category, catetory_relations
					WHERE item_category_relations.categoryId = catetory_relations.categoryId
					AND catetory_relations.ParentcategoryId = category.Id
					GROUP BY category.Name, catetory_relations.ParentcategoryId  
					) A, catetory_relations B 
				WHERE A.SubCategoryId = B.categoryId
			) A1, category B1 
			WHERE A1.ParentcategoryId = B1.Id
			GROUP BY B1.Name, A1.ParentcategoryId
			ORDER by TotalItem DESC";

			
	$result = $bs23->read($sql);
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
	<h2 class="page-header text-center">Brain Station 23 | Task 01</h2>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Sl.</th>
						<th>Category Name</th>
						<th>Total Items</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 1;
						foreach ($result as $key => $row) {
							?>
							<tr>
								<td><?php echo $counter; ?></td>
								<td><?php echo $row['CategoryName']; ?></td>
								<td><?php echo $row['TotalItem']; ?></td>
							</tr>
							<?php  
							$counter++;
					    }
					?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="stylesheet"></script>
</body>
</html>