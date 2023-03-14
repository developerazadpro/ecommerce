<?php
	//start session
	session_start();

	//crud with database connection
	include_once('BrainStation.php');

	$bs23 = new BrainStation();

	//fetch data
	// $sql = "SELECT A.*, B.ParentcategoryId FROM (
	// 			SELECT category.Name AS CategoryName, catetory_relations.ParentcategoryId AS SubCategoryId, COUNT(item_category_relations.categoryId) AS TotalItem
	// 			FROM item_category_relations, category, catetory_relations
	// 			WHERE item_category_relations.categoryId = catetory_relations.categoryId
	// 			AND catetory_relations.ParentcategoryId = category.Id
	// 			GROUP BY category.Name, catetory_relations.ParentcategoryId  
	// 			) A, catetory_relations B 
	// 		WHERE A.SubCategoryId = B.categoryId
	// 		ORDER BY A.TotalItem DESC";
			
	// $result = $bs23->read($sql);

?>

<?php 
function renderSql($sql){
	$bs23 = new BrainStation();
	$generatedSql = $bs23->read($sql);
	return $generatedSql;
}
function renderSigleSql($sql){
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
	<!-- <h2 class="page-header text-center">Brain Station 23 | Task 02</h2> -->
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			
			<table class="table table-bordered table-striped">
			
			<!-- categories tree -->
			<?php 
				// 	$db = new mysqli('localhost', 'root', '', 'ecommerce-custome');
				// Connect to database (replace "database_name", "username", and "password" with your own values)
				// $conn = new mysqli("localhost", "root", "", "ecommerce-custome");

				// // Check for errors
				// if ($conn->connect_error) {
				// 	die("Connection failed: " . $conn->connect_error);
				// }

				// function generateCategoryTree($parent_id = 1, $depth = 0, $conn) {
				// 	// Prepare a SQL query to retrieve all categories/subcategories with the given parent_id
				// 	$stmt = $conn->prepare("SELECT * FROM categories WHERE parent_id = ?");
				// 	$stmt = $conn->prepare("SELECT * FROM catetory_relations WHERE ParentcategoryId = ?");
				// 	$stmt->bind_param("i", $parent_id);
					
				// 	$stmt->execute();

				// 	// Get the result set
				// 	$result = $stmt->get_result();

				// 	// If there are no categories/subcategories, return
				// 	if ($result->num_rows == 0) {
				// 		return;
				// 	}

				// 	// Output a UL tag for the current level
				// 	echo '<ul>';

				// 	// Loop through each category/subcategory and output its name and any subcategories
				// 	while ($row = $result->fetch_assoc()) {
				// 		// Output a LI tag with the category/subcategory name
				// 		echo '<li>' . $row['categoryId'];

				// 		// Recursively output subcategories
				// 		generateCategoryTree($row['categoryId'], $depth + 1, $conn);

				// 		// Close the LI tag
				// 		echo '</li>';
				// 	}

				// 	// Close the UL tag for the current level
				// 	echo '</ul>';

				// 	// Free up the result set
				// 	$result->free();

				// 	// Close the prepared statement
				// 	$stmt->close();
				// }

				// // Usage example
				// generateCategoryTree(0, 0, $conn);

				// // Close database connection
				// $conn->close();
				

				##############################
				
				// $categorySql = "SELECT category.Id as id, category.Name as name, catetory_relations.ParentcategoryId as parent 
				// FROM catetory_relations, category
				// WHERE catetory_relations.categoryId = category.Id";
				// $catresult = renderSql($categorySql);


				// $subCategorySql = "SELECT category.Id as id, category.Name as name, catetory_relations.ParentcategoryId as parent 
				// FROM catetory_relations, category
				// WHERE catetory_relations.categoryId = category.Id";
				// $subCatresult = renderSql($subCategorySql);
				
				// function generatePageTree($subCatresult, $parent = 1, $limit=0){
				// 	if($limit > 1000) return ''; // Make sure not to have an endless recursion

				// 	$tree = '<ul>';
				// 	//echo count($subCatresult);exit();
				// 	// for($i = 1; $i < 5; $i++){

				// 	// }
				// 	for($i=0; $i < count($subCatresult); $i++){
				// 		//echo $i.'<br>';
				// 		if($subCatresult[$i]['parent'] == $parent){
				// 			//echo $i.'<br>';exit();
				// 			$tree .= '<li>';
				// 			$tree .= $subCatresult[$i]['name'].'=> '.$parent;
				// 			$tree .= generatePageTree($subCatresult, $subCatresult[$i]['id'], $limit++);
				// 			$tree .= '</li>';
				// 		}
				// 		//echo $i.'<br>';
				// 	}
				// 	$tree .= '</ul>';
				// 	return $tree;
				// }
				
				// echo(generatePageTree($subCatresult));
				###############################







				// $categorySql = "SELECT * FROM category WHERE NOT EXISTS ( SELECT categoryId FROM catetory_relations 
				// WHERE catetory_relations.categoryId = category.Id 
				// )";
				// $catresult = renderSql($categorySql);


				// $subCategorySql = "SELECT category.Id as id, category.Name as name, catetory_relations.ParentcategoryId as parent 
				// FROM catetory_relations, category
				// WHERE catetory_relations.categoryId = category.Id";
				// $subCatresult = renderSql($subCategorySql);
				
				// function generatePageTree($catresult,$parent = 1, $limit=0){
				// 	if($limit > 1000) return ''; // Make sure not to have an endless recursion
					
				// 	$tree = '<ul>';					
				// 	//echo '<pre>';print_r($catresult[0]['Id']);exit();
				// 	for($j = 0; $j < count($catresult); $j++){
				// 		//echo '<pre>';print_r($catresult[$j]['Id']);exit;
				// 		//for($i=0; $i < count($subCatresult); $i++){
				// 			//echo $i.'<br>';
				// 			if($catresult[$j]['Id'] == $parent){
				// 				//echo $i.'<br>';exit();
				// 				$tree .= '<li>';
				// 				$tree .= $catresult[$j]['Name'].'=> '.$parent;
				// 				$tree .= generatePageTree($catresult, $catresult[$j]['Id'], $limit++);
				// 				$tree .= '</li>';
				// 			}
				// 			//echo $i.'<br>';
				// 		//}
						
				// 	}
				// 	$tree .= '</ul>';
				// 	return $tree;
				// }
				
				// echo(generatePageTree($catresult));



				function getCategoriesByParentID($parent_id){
					//$subCategorySql = "SELECT * FROM catetory_relations WHERE catetory_relations.ParentcategoryId = $parent_id";
					// $subCategorySql = "SELECT category.Id, category.Name FROM catetory_relations, category 
					// WHERE catetory_relations.categoryId = category.Id
					// AND catetory_relations.ParentcategoryId = $parent_id";

					$subCategorySql = "SELECT category.Id, category.Name, catetory_relations.ParentcategoryId FROM category, catetory_relations
					WHERE category.Id = catetory_relations.categoryId
					and catetory_relations.ParentcategoryId = $parent_id";
					//echo $subCategorySql;exit();
					$subCatresult = renderSql($subCategorySql);
					return $subCatresult;
				}

				function getCategories(){
					$categorySql = "SELECT category.Id, category.Name FROM category WHERE NOT EXISTS ( SELECT categoryId FROM catetory_relations 
					 WHERE catetory_relations.categoryId = category.Id)";
					//echo $categorySql;exit();
					$catresult = renderSql($categorySql);
					return $catresult;
				}



				// function outputCategories($parent_id = 1, $level = 0) {
				// 	// Retrieve the categories with the given parent ID from the database
				// 	$categories = getCategories();
				// 	//echo '<pre>';print_r($categories);exit;
					
				// 	for($i = 0; $i < sizeof($categories); $i++){
				// 		//echo $categories[$i]['Id'].'<br>';
				// 		//echo ($categories[$i]['Id']).'<br>';
				// 		$subCategories = getCategoriesByParentID($categories[$i]['Id']);
				// 		for($j = 0; $j < sizeof($subCategories); $j++){
				// 			//echo '<pre>';print_r($subCategories);exit;
				// 			$indentation = str_repeat('&nbsp;&nbsp;', $level);
				// 			echo $indentation . $subCategories[$j]['Name'] . '<br>';
				// 			//outputCategories($subCategories[$j]['Id'], $level + 1);
				// 		}
						
				// 	}					
					
				// }
				
				  
				//   // Example usage: output all top-level categories and their subcategories
				//   outputCategories();
				


				// function printCategories($parent_id = 1, $indent = 0) {
				// 	// Get all categories with the given parent ID
				// 	$categories = getCategories();
				// 	for($i = 0; $i < sizeof($categories); $i++){
				// 		//echo $categories[$i]["Name"] . "<br>";
				// 		$scategories = getCategoriesByParentID($categories[$i]["Id"]);				
				// 		// Print out each category
				// 		foreach ($scategories as $scategory) {
							
				// 				// Indent based on the category's level in the hierarchy
				// 				echo str_repeat("&nbsp;", $indent * 4);
													
				// 				// Print the category name
				// 				echo $scategory["Name"] . "<br>";

				// 				// Recursively print out any subcategories
				// 				printCategories($scategory["Id"], $indent + 1);
							
							
				// 		}
				// 	}
					
				// }
				
				// // Call the function to print out all categories and subcategories
				// printCategories();



				$categorySql = "SELECT category.Id as id, category.Name as name, catetory_relations.ParentcategoryId as parent 
				FROM catetory_relations, category
				WHERE catetory_relations.categoryId = category.Id";
				$catresult = renderSql($categorySql);


				// $subCategorySql = "SELECT category.Id as id, category.Name as name, catetory_relations.ParentcategoryId as parent 
				// FROM catetory_relations, category
				// WHERE catetory_relations.categoryId = category.Id";
				// $subCatresult = renderSql($subCategorySql);
				
				// function generatePageTree($subCatresult, $parent = 1, $limit=0){
				// 	if($limit > 1000) return ''; // Make sure not to have an endless recursion

				// 	$tree = '<ul>';
				// 	//echo count($subCatresult);exit();
				// 	 for($i = 0; $i < 4; $i++){
				// 		//$tree .= '1234';
				// 		for($i=0; $i < count($subCatresult); $i++){
				// 			//echo $i.'<br>';
							
				// 			if($subCatresult[$i]['parent'] == $i){
				// 				//echo $i.'<br>';exit();
				// 				$tree .= '<li>';
				// 				$tree .= $subCatresult[$i]['name'];
				// 				$tree .= generatePageTree($subCatresult, $subCatresult[$i]['id'], $limit++);
				// 				$tree .= '</li>';
				// 			}
				// 			//echo $i.'<br>';
				// 		}
				// 	 }
					
				// 	$tree .= '</ul>';
				// 	return $tree;
				// }
				
				// echo(generatePageTree($subCatresult));

				
				
				  
				
			?>
			<!-- end -->
			</table>

			
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="stylesheet"></script>



</body>
</html>