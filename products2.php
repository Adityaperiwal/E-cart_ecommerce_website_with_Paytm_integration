<?php
	require_once('includes/function.php');
	//require '../phpmailer/class.phpmailer.php';

	//Session Start

	/*if(!isset($_SESSION['logged_in'])){
			redirect('login.php');
	}*/
?>
<?php
	$conn = coneect_db();
	if(isset($_REQUEST['action'])){
		switch ($_REQUEST['action']) {
		case "add":
			if($_REQUEST['product_name'] != ""){
				$targetFolder = '/E-cart/images';
				$file_name = "";
				if(isset($_FILES['image'])){
					$tempFile = $_FILES['image']['tmp_name'];
					$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
					$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
					$fileParts = pathinfo($_FILES['image']['name']);
					$old_file_name = $_FILES['image']['name'];
					$file_name = 'image_' . date('Y-m-d-H-i-s') . '_' . uniqid() .".". $fileParts['extension'];
					$targetFile = rtrim($targetPath,'/') . '/' . $file_name;
					
					// Validate the file type
					
					
					
					if (in_array($fileParts['extension'],$fileTypes)) {
						$uploaded = move_uploaded_file($tempFile,$targetFile);
						
					} else {
						echo 'Invalid file type.';
					}
				}

				$type=3;
				if($_REQUEST['sub_category_id']=="Necklace")
					$type=0;
				else if($_REQUEST['sub_category_id']=="Ring")
					$type=1;
				else if($_REQUEST['sub_category_id']=="Pendents")
					$type=2;
				$command="INSERT INTO products (name,cost,type,imagename) VALUES ('".$_REQUEST['product_name']."','".$_REQUEST['product_price']."','".$type."','".$file_name.");";
				$var=mysqli_query($conn,$command);
				echo($var);
			//	redirect('products2.php?inserted=1');
			}
			break;
		case "delete":

			if(isset($_REQUEST['id']) && $_REQUEST['id'] != ""){
				$sql = "DELETE FROM products WHERE pid=".$_REQUEST['id'];
				if ($conn->query($sql) === TRUE) {
					redirect('products2.php?deleted=1');
				} else {
					redirect('products2.php?deleted=0');
				}
			}

			break;
		
		default:
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Admin Panel</title>

	<!-- end: Meta -->

	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->


	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->

</head>

<body>
		<!-- start: Header -->
	<?php include('includes/header.php') ?>
		<!-- start: Header -->
		<div class="container-fluid-full">
		<div class="row-fluid">

			<!-- start: Main Menu -->
			<?php include('includes/left_menu.php') ?>
			<!-- end: Main Menu -->

			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>

			<!-- start: Content -->
			<div id="content" class="span10">

			<?php
				if(isset($_REQUEST['deleted']) && $_REQUEST['deleted'] == '1'){
			 ?>
				<div class="alert alert-success">
							<button data-dismiss="alert" class="close" type="button">×</button>
							Product deleted successfully.
				</div>
			 <?php
				}
			  ?>
			  <?php
				if(isset($_REQUEST['testsuccess']) && $_REQUEST['testsuccess'] == '1'){
			 ?>
				<div class="alert alert-success">
							<button data-dismiss="alert" class="close" type="button">×</button>
							Test message(s) successfully sent.
				</div>
			 <?php
				}
			  ?>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product Category</h2>

					</div>
					<div class="box-content">
						<form clsass="form-horizontal" method="post" action="products2.php" enctype="multipart/form-data">
							<input type="hidden" name="action" value="add">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Product Name</label>
							  <div class="controls">
								<input type="text" value="" id="product_name" class="input-xlarge" name="product_name">
							  </div>
							</div>
							 <div class="control-group">
							  <label class="control-label" for="typeahead">Price</label>
							  <div class="controls">
								<input type="number" value="" id="product_price" class="input-xlarge" name="product_price">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="product_image">Image</label>
								<div class="controls">
									<input type="file" name="image" id="image" >
								</div>	
							</div>
							<div class="control-group">
								<label class="control-label">Product Sub Category</label>
								<div class="controls">
									 <?php
										$sql = "SELECT * FROM category";
										$result = $conn->query($sql);

										?>
										<label for="product_cat">
										<select name="sub_category_id" id="sub_product_cat">
											<option value="0">Choose Product sub category</option>
										<?php
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()){
									?>
										<option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>
									
									<?php }} ?>
									</select>	
									</label>
								</div>
							 </div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Add Product</button>
							</div>
							</fieldset>
						</form>

					</div>
				</div><!--/span-->

			</div><!--/row-->

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Products</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>Product Name</th>
								  <th>Price</th>
								  <th>Image</th>
								  <th>Type</th>
								  <th>Actions</th>
							  </tr>
						  </thead>
						  <tbody>
							  <?php
								$sql = "SELECT p.*FROM products p";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()){

							  ?>
							<tr>
								<td><?php echo $row['name'] ?></td>
								<td><?php echo $row['cost'] ?></td>
								<td><img src="/jewellery/images/<?php echo $row['imagename'] ?>" height="100" width="100"></td>
								<td><?php if($row['type']==0)echo "Other Accessories";
								else if($row['type']==1)echo "Games";
								else if($row['type']==2)echo "ELECTRONICS";
								else echo "Others";
								 ?></td>
								
								
								<td class="center">
									
									<a class="btn btn-danger" href="?action=delete&id=<?php echo $row['pid'] ?>">
										<i class="halflings-icon white trash"></i>
									</a>
									
									
								</td>
							</tr>
							<?php }} ?>
						  </tbody>
					  </table>
					</div>
				</div><!--/span-->
			</div><!--/row-->
	</div><!--/.fluid-container-->

			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->

	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>

	<div class="clearfix"></div>

	<?php include('includes/footer.php') ?>

	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>

		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>

		<script src="js/jquery.ui.touch-punch.js"></script>

		<script src="js/modernizr.js"></script>

		<script src="js/bootstrap.min.js"></script>

		<script src="js/jquery.cookie.js"></script>

		<script src='js/fullcalendar.min.js'></script>

		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>

		<script src="js/jquery.chosen.min.js"></script>

		<script src="js/jquery.uniform.min.js"></script>

		<script src="js/jquery.cleditor.min.js"></script>

		<script src="js/jquery.noty.js"></script>

		<script src="js/jquery.elfinder.min.js"></script>

		<script src="js/jquery.raty.min.js"></script>

		<script src="js/jquery.iphone.toggle.js"></script>

		<script src="js/jquery.uploadify-3.1.min.js"></script>

		<script src="js/jquery.gritter.min.js"></script>

		<script src="js/jquery.imagesloaded.js"></script>

		<script src="js/jquery.masonry.min.js"></script>

		<script src="js/jquery.knob.modified.js"></script>

		<script src="js/jquery.sparkline.min.js"></script>

		<script src="js/counter.js"></script>

		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->

</body>
</html>





