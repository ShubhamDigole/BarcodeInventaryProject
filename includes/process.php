<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");

//For Registration Processsing
if (isset($_POST["username"]) AND isset($_POST["email"])) {
	$user = new User();
	$result = $user->createUserAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
	echo $result;
	exit();
}

//For Login Processing
if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
	$user = new User();
	$result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
	echo $result;
	exit();
}

//To get Category
if (isset($_POST["getCategory"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("categories");
	foreach ($rows as $row) {
		echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
	}
	exit();
}

//Fetch Brand
if (isset($_POST["getBrand"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("brands");
	foreach ($rows as $row) {
		echo "<option value='".$row["bid"]."'>".$row["brand_name"]."</option>";
	}
	exit();
}

//Add Category
if (isset($_POST["category_name"]) AND isset($_POST["parent_cat"])) {
	$obj = new DBOperation();
	$result = $obj->addCategory($_POST["parent_cat"],$_POST["category_name"]);
	echo $result;
	exit();
}

//Add Brand
if (isset($_POST["brand_name"])) {
	$obj = new DBOperation();
	$result = $obj->addBrand($_POST["brand_name"]);
	echo $result;
	exit();
}

//Add Product
if (isset($_POST["added_date"]) AND isset($_POST["product_name"])) {
	$obj = new DBOperation();
	$result = $obj->addProduct($_POST["select_cat"],
							$_POST["select_brand"],
							$_POST["product_code"],
							$_POST["product_name"],
							$_POST["product_price"],
							$_POST["product_price_sell"],
							$_POST["product_qty"],
							$_POST["added_date"]);
	echo $result;
	exit();
}

//Manage Category
if (isset($_POST["manageCategory"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("categories",$_POST["pageno"]);
	$rows = $result["rows"];
	$n=1;
	if (count($rows) > 0) {
	
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo $n; ?></td>
			        <td><?php echo $row["category"]; ?></td>
			        <td><?php echo $row["parent"]; ?></td>
			        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
			        <td>
			        	<a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
			        	<a href="#" eid="<?php echo $row['cid']; ?>" data-toggle="modal" data-target="#form_category" class="btn btn-info btn-sm edit_cat">Edit</a>
			        </td>
			      </tr>
			<?php
			$n++;
		}
		?>
		
		<?php
		exit();
	}
}


//Delete Category
if (isset($_POST["deleteCategory"])) {
	$m = new Manage();
	$result = $m->deleteRecord("categories","cid",$_POST["id"]);
	echo $result;
}

//Update Category
if (isset($_POST["updateCategory"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("categories","cid",$_POST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if (isset($_POST["update_category"])) {
	$m = new Manage();
	$id = $_POST["cid"];
	$name = $_POST["update_category"];
	$parent = $_POST["parent_cat"];
	$result = $m->update_record("categories",["cid"=>$id],["parent_cat"=>$parent,"category_name"=>$name,"status"=>1]);
	echo $result;
}

//------------------Brand---------------------


//Manage Brand
if (isset($_POST["manageBrand"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("brands",$_POST["pageno"]);
	$rows = $result["rows"];
	$n = 1;
	if (count($rows) > 0) {
		
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo $n; ?></td>
			        <td><?php echo $row["brand_name"]; ?></td>
			        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
			        <td>
			        	<a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>
			        	<a href="#" eid="<?php echo $row['bid']; ?>" data-toggle="modal" data-target="#form_brand" class="btn btn-info btn-sm edit_brand">Edit</a>
			        </td>
			      </tr>
			<?php
			$n++;
		}
		?>
		
		<?php
		exit();
	}
}

//Delete 
if (isset($_POST["deleteBrand"])) {
	$m = new Manage();
	$result = $m->deleteRecord("brands","bid",$_POST["id"]);
	echo $result;
}


//Update Brand
if (isset($_POST["updateBrand"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("brands","bid",$_POST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if (isset($_POST["update_brand"])) {
	$m = new Manage();
	$id = $_POST["bid"];
	$name = $_POST["update_brand"];
	$result = $m->update_record("brands",["bid"=>$id],["brand_name"=>$name,"status"=>1]);
	echo $result;
}

//----------------Products---------------------

if (isset($_POST["manageProduct"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("products",$_POST["pageno"]);
	$rows = $result["rows"];
	 $n = 1 ;
	if (count($rows) > 0) {
		
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo $n; ?></td>
			        <td><?php echo $row["product_name"]; ?></td>
			        <td><?php echo $row["category_name"]; ?></td>
			        <td><?php echo $row["brand_name"]; ?></td>
			        <td><?php echo $row["product_price"];?></td>
							<td><?php echo $row["added_date"]; ?></td>
			        <td><?php echo $row["product_stock"]; ?></td> 
							<td><?php echo $row["stock_shop"]; ?></td>
			        <td><?php echo $row["stock_shop"] + $row["product_stock"];?></td>
			        <td>
			        	<a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
			        	<a href="#" eid="<?php echo $row['pid']; ?>" data-toggle="modal" data-target="#form_products" class="btn btn-info btn-sm edit_product">Edit</a>
			        </td>
							<td><a href="#" sid="<?php echo $row['pid']; ?>" data-book-id='{"id":<?php echo $row['pid']; ?>, "remain":<?php echo $row['product_stock']; ?>, "sremain": <?php echo $row['stock_shop']; ?>}' data-toggle="modal" data-target="#update_shop" class="btn btn-info btn-sm Add_Shop">Add Stock to shop</a></td>
							<td><a href="#" data-book-id='{"id":<?php echo $row['pid']; ?>, "remain":<?php echo $row['product_stock']; ?>, "sremain": "<?php echo $row['product_name']; ?>"}' data-toggle="modal" data-target="#updates" class="btn btn-info btn-sm update_stock">Update Stock</a></td>

						</tr>
			<?php
			$n++;
		}
		?>
		
		<?php
		exit();
	}
}


// stco update details


if (isset($_POST["GetStock"])) {
	$m = new Manage();
	$result = $m->getStockRecord("stock_record");
	$rows = $result["rows"];
	$n = 0;
	
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo $n; ?></td>
			        <td><?php echo $row["pid"]; ?></td>
			        <td><?php echo $row["added_date"]; ?></td>
			        <td><?php echo $row["product_name"]; ?></td>
			        <td><?php echo $row["stock"];?></td>

						</tr>
			<?php
			$n++;
		}
		?>
			
		<?php
		exit();
	}

//stock report

if (isset($_POST["getVals"])) {
	$m = new Manage();
	$result = $m->getReport();

	
		exit();
	}


	if(isset($_POST["userData"])){
	$id = $_POST["pid"];
	$m = new manage(); 	
	$result = $m->getUser($id);
	$rows = $result["rows"]; 
	if (count($rows) > 0) {
		$n=1;
		foreach ($rows as $row) {
		
		?>
	  <img class="card-img-top mx-auto" style="width:60%;" src="./images/user.png" alt="Card image cap">
				  <div class="card-body">
				    <h4 class="card-title">Profile Info</h4>
					
				    <p class="card-text"><i class="fa fa-user">&nbsp;&nbsp;<?php echo $row["username"]?></i></p>
				    <p class="card-text"><i class="fa fa-user">&nbsp;&nbsp;<?php echo $row["usertype"]?></i></p>
				    <p class="card-text"><b><i class="fa fa-clock">&nbsp;&nbsp;Last Login :&nbsp;&nbsp;<?php echo $row["last_login"]?></i></b></p>
				    <br>
				  </div>
					<?php
			$n++;
	}

	}
}

	if(isset ($_POST["get_rdata"])){
		$date = $_POST["date"];

		$m = new Manage();
		$result = $m->reportdata($date);
		$rows = $result["rows"];
		if (count($rows) > 0) {
			$n=1;
			foreach ($rows as $row) {
			
			?>
					<tr>
							<td><?php echo $n; ?></td>
							<!-- <td><?php echo $row["pid"]; ?></td> -->
							
							<td><?php echo $row["product_name"]; ?></td>
							<td><?php echo $row["product_stock"]; ?></td>
							<td><?php echo $row["stock_shop"]; ?></td>
							<td><?php echo $row["stock_shop"] + $row["product_stock"]; ?></td>
							<td><?php echo $row["t_date"]; ?></td>
							<td><?php echo $row["yproduct_stock"];?></td>
							<td><?php echo $row["ystock_shop"]; ?></td>
							<td><?php echo $row["ystock_shop"] + $row["yproduct_stock"]; ?></td>
							
							
							
						 
						</tr>
			<?php
			$n++;
	}
	
	
		}
		else{

			echo "no record found";
		}
		
			exit();

	}
//Delete 
if (isset($_POST["deleteProduct"])) {
	$m = new Manage();
	$result = $m->deleteRecord("products","pid",$_POST["id"]);
	echo $result;
}

//Update Product
if (isset($_POST["updateProduct"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("products","pid",$_POST["id"]);
	echo json_encode($result);
	exit();
}


//Update shop stock

if (isset($_POST["psdata"])) {
	$m = new Manage();
	$id = $_POST["product_qty"];
	$qty = $_POST["psdata"];
	$remain = $_POST["remain"];
	$remains = $_POST["psdatao"];
	$date = $_POST["adate"];
	$stotal = $qty + $remains;
	$total = $remain - $qty;
	$result = $m->UpdateStoreStock($id,$stotal, $total);
	echo json_encode($result);
	exit();
}

//Update main stock

if (isset($_POST["msdata"])) {
	$m = new Manage();
	$id = $_POST["id"];
	$qty = $_POST["msdata"];
	$remain = $_POST["stock"];
	$remains = $_POST["msdatao"];
	$stotal = $qty + $remain;
	$date = $_POST["adate"];
	$result = $m->UpdateGodStock($id,$remains,$qty,$stotal,$date);
	echo json_encode($result);
	exit();
}


//Update Record after getting data
if (isset($_POST["update_product"])) {
	$m = new Manage();
	//$qcode = $_POST["code"];
	$id = $_POST["pid"];
	$name = $_POST["update_product"];
	$cat = $_POST["select_cat"];
	$brand = $_POST["select_brand"];
	$price = $_POST["product_price"];
	$prices = $_POST["product_price_sell"];
	$qty = $_POST["product_qty"];
	$qtys = $_POST["products_qty"];
	$date = $_POST["added_date"];
	$result = $m->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"=>$brand,"product_name"=>$name,"product_price"=>$price,"productsell"=>$prices,"product_stock"=>$qty,"stock_shop"=>$qtys,"added_date"=>$date]);
	echo $result;
}


// --------------------------------------Reports--------------------------------------
// Get Daily Report
if (isset($_POST["get_DData"])) {
	
		$date = $_POST["date"];	
		$m = new Manage();
		$result = $m->GetDataDaily("invoice",$date);
		$rows = $result["rows"];
		if (count($rows) > 0) {
			
				$n = 1;
				$total =0;
				$total2=0;
				foreach ($rows as $row) {
					$total = $total + $row["net_total"];
					$total2 = $total2 + $row["sell_total"];
					$num = $row["invoice_no"];
					$results = $m->	getAllRecordsAt($num);
					$ro = $results["rows"];				
        ?>
            <tr>
                <td><?php echo $n; ?></td>
								<td name="no[]">
								<?php 
								foreach ($ro as $roq){
								if ($roq["qty"] == 0) {
									
								}
								else{
								echo $roq["product_name"]."=".$roq["qty"]." ";
								}
								}
								?>
                <td name="date[]"><?php echo $row["order_date"]; ?></td>
								<td name="mtotal[]"><?php echo $row["sell_total"]; ?></td>
                <td name="total[]"><?php echo $row["net_total"]; ?></td>

								<td name="disc[]"><?php echo $row["discount"]; ?></td>
                <td name="type[]"><?php echo $row["payment_type"]; ?></td>
                
                
               
              </tr>
        <?php
        $n++;
		}
		?>
		<tr> <td></td><td></td><td></td><th>Total = <?php  echo $total2;?> Rs</th><th name="total">Total = <?php  echo $total;?>Rs</th><td></td><td></td></tr>
		<tr> <th colspan="7">Total Profit Of Day : <?php  echo $total - $total2;?> RS</th></tr>
		<?php
	}

	else{

		echo "no record found";
	}
    exit();
		
		
	}

	if(isset($_POST["getCustomReport"])){

		$date1 = $_POST["date1"];
		$date2 = $_POST["date2"];

		$m = new Manage();
		$result = $m->getCustData("invoice",$date1,$date2);
		$rows = $result["rows"];
		if (count($rows) > 0) {
			
				$n = 1;
				$total=0;
				$total2=0;
				foreach ($rows as $row) {
					$total = $total + $row["net_total"];
					$total2 = $total2 + $row["sell_total"];
					$num = $row["invoice_no"];
					$results = $m->	getAllRecordsAt($num);
					$ro = $results["rows"];				
        ?>
            <tr>
                <td><?php echo $n; ?></td>
								<td name="no[]">
								<?php 
								foreach ($ro as $roq){
								if ($roq["qty"] == 0) {
									
								}
								else{
								echo $roq["product_name"]."=".$roq["qty"]." ";
								}
								}
								?>
								</td>
                <td name="date[]"><?php echo $row["order_date"]; ?></td>
								<td name="mtotal[]"><?php echo $row["sell_total"]; ?></td>
                <td name="total[]"><?php echo $row["net_total"]; ?></td>

								<td name="disc[]"><?php echo $row["discount"]; ?></td>
                <td name="type[]"><?php echo $row["payment_type"]; ?></td>
                
                
            <?php   
        $n++;
		}
		?>
<tr> <td></td><td></td><td></td><th>Total = <?php  echo $total2;?> Rs</th><th name="total">Total = <?php  echo $total;?>Rs</th><td></td><td></td></tr>
	<tr> <th colspan="7">Total Profit Of Day : <?php  echo $total - $total2;?> RS</th></tr>	
		<?php
	}

	else{

		echo "no record found";
	}
    exit();
		
		
	}


//-------------------------Order Processing--------------

if (isset($_POST["getNewOrderItem"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("products");
	?>
	<tr style="text-align:center;">
			<td><b class="number">1</b></td>
			<td><input name="code[]" type="text" class="form-control form-control-sm code"></td>   
		    
			
			<td><input name="pid[]" readonly type="text" class="form-control form-control-sm pid"></td>
		       
		    <td><input name="qty[]"  class="form-control form-control-sm qty" ></td>
		    <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly>
				<input name="vals[]" type="hidden" readonly class="form-control form-control-sm prices"></td>
				
		    
			  <td>Rs.<span class="amt" id="amt">0</span> <span class="pmt" id="pmt" style="display:none" >0</span></td>
			
				<td><input type="button" id="remove" style="width:40px; padding-right:9px;" value="X" class="btn btn-danger" ></td>
				<td><input name="tqty[]" type="text" readonly type="text" class="form-control form-control-sm tqty"></td>
				<td><input name="pro_name[]" type="hidden" readonly class="form-control form-control-sm pro_name"></td>
				<td></td>
	</tr>
	<?php
	exit();
}


//Get price and qty of one item
if (isset($_POST["getPriceAndQty"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("products","code_id",$_POST["id"]);
	echo json_encode($result);
	exit();
}


if (isset($_POST["order_date"])) {
	
	$orderdate = date("Y-m-d");
	//Now getting array from 
	$ar_tqty = $_POST["tqty"];
	$ar_qty = $_POST["qty"];
	$ar_price = $_POST["price"];
	$ar_pro_name = $_POST["pro_name"];
	//$ar_pro_code = $_POST["code"];
	$sub_total = $_POST["sub_total"];
	$discount = $_POST["discount"];
	$net_total = $_POST["net_total"];
	$paid = $_POST["paid"];
	$due = $_POST["due"];
	$payment_type = $_POST["payment_type"];
	$m = new Manage();
	echo $result = $m->storeCustomerOrderInvoice($orderdate,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$discount,$net_total,$paid,$due,$payment_type);


}

?>