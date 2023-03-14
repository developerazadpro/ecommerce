<?php
	//start session
	session_start();

	//crud with database connection
	include_once('BrainStation.php');

	$bs23 = new BrainStation();

	//fetch data
	$sql = "SELECT A.*, B.ParentcategoryId FROM (
				SELECT category.Name AS CategoryName, catetory_relations.ParentcategoryId AS SubCategoryId, COUNT(item_category_relations.categoryId) AS TotalItem
				FROM item_category_relations, category, catetory_relations
				WHERE item_category_relations.categoryId = catetory_relations.categoryId
				AND catetory_relations.ParentcategoryId = category.Id
				GROUP BY category.Name, catetory_relations.ParentcategoryId  
				) A, catetory_relations B 
			WHERE A.SubCategoryId = B.categoryId
			ORDER BY A.TotalItem DESC";
			
	$result = $bs23->read($sql);


	// $parentCategorySql = "SELECT * FROM category WHERE NOT EXISTS ( SELECT categoryId FROM catetory_relations 
	// 																WHERE catetory_relations.categoryId = category.Id 
	// 					) LIMIT 1";
	// $parentresult = $bs23->read($parentCategorySql);

	
?>

<?php 
function renderSql($sql){
	$bs23 = new BrainStation();
	$generatedSql = $bs23->read($sql);
	return $generatedSql;
}

function renderSingleData($sql){
	$bs23 = new BrainStation();
	$generatedSql = $bs23->getRecord($sql);
	return $generatedSql;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ecommerce</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.page-header {
			padding-bottom: 20px;
			margin: 40px 0 20px;
			border-bottom: none;
		}
		.just-padding {
			padding: 15px;
		}

		.list-group.list-group-root {
			padding: 0;
			overflow: hidden;
		}

		.list-group.list-group-root .list-group {
			margin-bottom: 0;
		}

		.list-group.list-group-root .list-group-item {
			border-radius: 0;
			border-width: 1px 0 0 0;
		}

		.list-group.list-group-root > .list-group-item:first-child {
			border-top-width: 0;
		}

		.list-group.list-group-root > .list-group > .list-group-item {
			padding-left: 30px;
		}

		.list-group.list-group-root > .list-group > .list-group > .list-group-item {
			padding-left: 45px;
		}
		.list-group.list-group-root > .list-group > .list-group > .list-group > .list-group-item {
			padding-left: 60px;
		}

		.list-group.list-group-root > .list-group > .list-group > .list-group > .list-group > .list-group-item {
			padding-left: 75px;
		}
	</style>
</head>
<body>
<div class="container">
	<h2 class="page-header text-center">Brain Station 23 | Task 02</h2>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			
			<table class="table table-bordered table-striped">
			
			<!-- categories tree -->
			<div class="just-padding">

				<div class="list-group list-group-root well">
					<?php 
					$parentCategorySql = "SELECT * FROM category WHERE NOT EXISTS ( SELECT categoryId FROM catetory_relations 
					WHERE catetory_relations.categoryId = category.Id 
					)";
					$parentresult = renderSql($parentCategorySql);

					foreach($parentresult as $category){ ?>
					<!-- 1st level -->
					<a href="#" class="list-group-item">1. <?php echo $category['Name']; ?></a>
					<div class="list-group">
						<!-- 2nd level -->
						<?php  
							$subCategorySql = "SELECT category.Id, category.Name 
							FROM catetory_relations, category
							WHERE parentCategoryId = '".$category['Id']."'
							AND catetory_relations.categoryId = category.Id";
							$subCatresult = renderSql($subCategorySql);
							foreach($subCatresult as $subcategory){ 

							$totalItem = "SELECT COUNT(ItemNumber) as TotalItem
							FROM item_category_relations
							WHERE item_category_relations.categoryId = '".$subcategory['Id']."'";
							$NoOftotalItem = renderSingleData($totalItem);	

							?>

						<a href="#" class="list-group-item">2. <?php echo $subcategory['Name']; ?>(<?php echo $NoOftotalItem['TotalItem']; ?>)</a>
						<div class="list-group">
							<!-- 3rd level -->
							<?php  
							$subCategorySql = "SELECT category.Id, category.Name 
							FROM catetory_relations, category
							WHERE parentCategoryId = '".$subcategory['Id']."'
							AND catetory_relations.categoryId = category.Id";
							$subCatresult = renderSql($subCategorySql);
							if(sizeof($subCatresult) > 0){
								
								foreach($subCatresult as $subcategory){ ?>
									<?php 
									$totalItem = "SELECT COUNT(ItemNumber) as TotalItem
									FROM item_category_relations
									WHERE item_category_relations.categoryId = '".$subcategory['Id']."'";
									$NoOftotalItem = renderSingleData($totalItem);
									
									//echo '<pre>';print_r($NoOftotalItem);exit;
									?>
									<a href="#" class="list-group-item">3. <?php echo $subcategory['Name']; ?>(<?php echo $NoOftotalItem['TotalItem']; ?>)</a>
									<div class="list-group">
										<!-- 4th level -->
		
										<?php  
										
										$childSubCategorySql = "SELECT category.Id, category.Name 
										FROM catetory_relations, category
										WHERE parentCategoryId = '".$subcategory['Id']."'
										AND catetory_relations.categoryId = category.Id";
										$childSubCatresult = renderSql($childSubCategorySql);
										//print_r($childSubCatresult);exit();
										if(sizeof($childSubCatresult) > 0){
											foreach($childSubCatresult as $subcategory){
												$totalItem = "SELECT COUNT(ItemNumber) as TotalItem
												FROM item_category_relations
												WHERE item_category_relations.categoryId = '".$subcategory['Id']."'";
												$NoOftotalItem = renderSingleData($totalItem); 
												?>
												<a href="#" class="list-group-item">4. <?php echo $subcategory['Name']; ?>(<?php echo $NoOftotalItem['TotalItem']; ?>)</a>	
												
											<?php } 
										}  ?>
										<!-- end of 4th level -->
										
									</div>
									
								<?php } 
								
							} ?>
							<!-- end of 3rd level -->
							
						</div>
						<!-- end of 2nd level -->
						<?php } ?>
					</div>
					<?php }  ?>
					<!-- end of 1st level -->


					
				
				</div>
			
			</div>
			<!-- end -->
			</table>

			
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="stylesheet"></script>



</body>
</html>