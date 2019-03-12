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


    <div class="container-fluid">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Added Date</th>
                    <th>Stock in Godown</th>
                    <th>Stock in Shop</th>
                    <th>Total Stock</th>
                    <th>Action</th>
                    <th>Add Stock To Shop</th>
                    <th>Update Stock</th>
                </tr>
            </thead>
            <tbody id="get_product">
                <!--<tr>
		        <td>1</td>
		        <td>Electronics</td>
		        <td>Root</td>
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
		include_once("./templates/update_products.php");
		?>


</body>

</html> 