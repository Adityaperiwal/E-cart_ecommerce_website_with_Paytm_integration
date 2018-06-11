<?php
	require_once('includes/function.php');
	//require '../phpmailer/class.phpmailer.php';


?>
<?php
	$conn = coneect_db();
	if(isset($_REQUEST['action'])){
		switch ($_REQUEST['action']) {
		case "add":
			if($_REQUEST['category_name'] != ""){
				
				$stmt = $conn->prepare("INSERT INTO category (category_name) VALUES (?)");
				
				$stmt->bind_param("s", $_REQUEST['category_name']);
				$stmt->execute();
				$stmt->close();
				redirect('product_category.php?inserted=1');
			}
			break;
		case "delete":

			if(isset($_REQUEST['id']) && $_REQUEST['id'] != ""){
				$sql = "DELETE FROM category WHERE category_id=".$_REQUEST['id'];
				if ($conn->query($sql) === TRUE) {
					redirect('product_category.php?deleted=1');
				} else {
					redirect('product_category.php?deleted=0');
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
	<link id="base-style" href="css/style2.css" rel="stylesheet">
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
							Product category deleted successfully.
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
						<form class="form-horizontal" method="post" action="product_category.php">
							<input type="hidden" name="action" value="add">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Category Name</label>
							  <div class="controls">
								<input type="text" value="" id="category_name" class="input-xlarge" name="category_name">
							  </div>
							</div>
							 
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Add Product Category</button>
							</div>
							</fieldset>
						</form>

					</div>
				</div><!--/span-->

			</div><!--/row-->

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Users</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>Category Name</th>
								  <th>Actions</th>
							  </tr>
						  </thead>
						  <tbody>
							  <?php
								$sql = "SELECT c.*FROM category c";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()){

							  ?>
							<tr>
								<td><?php echo $row['category_name'] ?></td>
								
								<td class="center">
									
									<a class="btn btn-danger" href="?action=delete&id=<?php echo $row['category_id'] ?>">
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





