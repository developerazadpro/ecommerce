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
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<h2 class="page-header text-center">Brain Station 23 | Task 02</h2>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			
			<table class="table table-bordered table-striped">
			
			<!-- categories tree -->
			<?php 
			
				

				$con=mysqli_connect('localhost','root','','ecommerce');
				
				$res=mysqli_query($con,"SELECT category.Id as id, category.Name as name, catetory_relations.ParentcategoryId as parent_id 
				FROM catetory_relations, category
				WHERE catetory_relations.categoryId = category.Id
				
				UNION ALL
                
                SELECT category.Id as id, category.Name as name, 0 as parent_id FROM category WHERE NOT EXISTS ( 
					SELECT categoryId FROM catetory_relations WHERE catetory_relations.categoryId = category.Id)   ORDER BY name ASC
				");

				
				
				$arr=[];
				while($row=mysqli_fetch_assoc($res)){
					//echo '<pre>'; print_r($row);exit();
					$arr[$row['id']]['name']=$row['name'];
					$arr[$row['id']]['parent_id']=$row['parent_id'];
				}
				buildTreeView($arr,0);
				
				function buildTreeView($arr,$parent,$level = 0,$prelevel = -1){
					
					foreach($arr as $id=>$data){
						if($parent==$data['parent_id']){
							if($level>$prelevel){
								echo "<ol>";
							}
							if($level==$prelevel){
								echo "</li>";
							}
							echo "<li>".$data['name'];
							if($level>$prelevel){
								$prelevel=$level;
							}
							$level++;
							buildTreeView($arr,$id,$level,$prelevel);
							$level--;	
						}
					}
					if($level==$prelevel){
						echo "</li></ol>";
					}
					
				}
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