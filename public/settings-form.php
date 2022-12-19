<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_POST['btnUpdate'])) {

    $whatsapp = $db->escapeString(($_POST['whatsapp']));
    $app = $db->escapeString(($_POST['app']));
    
    $error = array();
    
    if (empty($whatsapp)) {
        $error['whatsapp'] = " <span class='label label-danger'>Required!</span>";
    }
   
    if (empty($app)) {
        $error['app'] = " <span class='label label-danger'>Required!</span>";
    }
   
       
    
    if (!empty($app) && !empty($whatsapp) ) {
           
            $sql_query = "UPDATE settings SET app='$app',whatsapp='$whatsapp' WHERE id=1";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                
                $error['update'] = "<section class='content-header'>
                                                <span class='label label-success'>Setting Detail Updated Successfully</span> </section>";
            } else {
                $error['update'] = " <span class='label label-danger'>Failed</span>";
            }
        }
    }

    // create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM settings WHERE id = 1";
$db->sql($sql_query);
$res = $db->getResult();
?>
<section class="content-header">
<h1>Settings <small><a href='home.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Home</a></small></h1>  
  <?php echo isset($error['update']) ? $error['update'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form name="delivery_charge" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Whatsapp</label> <i class="text-danger asterik">*</i><?php echo isset($error['whatsapp']) ? $error['whatsapp'] : ''; ?>
                                <input type="text" class="form-control" name="whatsapp" value="<?= $res[0]['whatsapp']; ?>" required>
                            </div>
                        
                          
                        
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mobile Application (APK)</label> <i class="text-danger asterik">*</i><?php echo isset($error['app']) ? $error['app'] : ''; ?>
                                <input type="text" class="form-control" name="app" value="<?= $res[0]['app']; ?>" required>
                            </div>
                        
                           
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
                    </div>

                </form>

            </div><!-- /.box -->
        </div>
    </div>
</section>

<div class="separator"> </div>

<?php $db->disconnect(); ?>