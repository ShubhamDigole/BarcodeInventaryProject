<?php
include_once("./database/constants.php");
if (!isset($_SESSION["userid"])) {
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inventory Management System</title>
    <script src="./assets/jquery.min.js"></script>
    <script src="./assets/popper.min.js" crossorigin="anonymous"></script>
    <script src="./assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="./assets/font/js/fontawesome.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./assets/font/css/all.min.css">
    <script type="text/javascript" src="./js/manage.js"></script>
</head>

<body>
    <!-- Navbar -->
    <?php include_once("./templates/header.php"); ?>
    <br /><br />
    <div class="container">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="get_brand">
                <!--<tr>
		        <td>1</td>
		        <td>Electronics</td>
		        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
		        <td>
		        	<a href="#" class="btn btn-danger btn-sm">Delete</a>
		        	<a href="#" class="btn btn-info btn-sm">Edit</a>
		        </td>
		      </tr>-->
            </tbody>
        </table>
    </div>


    <?php
		include_once("./templates/update_brand.php");
		?>


</body>

</html> 