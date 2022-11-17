<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php

if (isset($_GET['id'])) {
    $ID = $db->escapeString($_GET['id']);
} else {
    // $ID = "";
    return false;
    exit(0);
}
if (isset($_POST['btnEdit'])) {

		$error = array();
		$title = $db->escapeString(($_POST['title']));
		$description = $db->escapeString($_POST['description']);

		
		 
		if (!empty($title) && !empty($description)) 
		{
			
             $sql_query = "UPDATE dashboard_info SET title='$title',description='$description' WHERE id =  $ID";
			 $db->sql($sql_query);
             $update_result = $db->getResult();
			if (!empty($update_result)) {
				$update_result = 0;
			} else {
				$update_result = 1;
			}

			// check update result
			if ($update_result == 1)
			{
			    $error['update_info'] = " <section class='content-header'><span class='label label-success'>Dashboard Info updated Successfully</span></section>";
			} else {
				$error['update_info'] = " <span class='label label-danger'>Failed to update</span>";
			}
		}
	} 


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM dashboard_info  WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();

if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "dashboard_info.php";
	</script>
<?php } ?>
<section class="content-header">
	<h1>
		Edit Dashboard Info<small><a href='dashboard_info.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Dashboard Info</a></small></h1>
	<small><?php echo isset($error['update_info']) ? $error['update_info'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<!-- Main row -->

	<div class="row">
		<div class="col-md-8">
		
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
					
				</div><!-- /.box-header -->
				<!-- form start -->
				<form id="edit_info_form" method="post" enctype="multipart/form-data">
					<div class="box-body">
						   <div class="row">
							    <div class="form-group">
									 <div class="col-md-8">
										<label for="exampleInputEmail1">Title</label><i class="text-danger asterik">*</i><?php echo isset($error['title']) ? $error['title'] : ''; ?>
										<input type="text" class="form-control" name="title" value="<?php echo $res[0]['title']; ?>">
									 </div>
								</div>
						   </div>
						   <br>
						   <div class="row">
								<div class="form-group">
									 <div class="col-md-12">
										<label for="exampleInputEmail1">Description</label><i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
										<textarea rows="3" type="text" class="form-control" name="description"><?php echo $res[0]['description']; ?></textarea>
									 </div>
									
								</div>
						   </div>
					</div>
					<!-- /.box-body -->
                       
					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="btnEdit">Update</button>
					
					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>

<div class="separator"> </div>
<?php $db->disconnect(); ?>
