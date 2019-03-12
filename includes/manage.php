<?php

/**
* 
*/
class Manage
{

	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getUser($id)
	{
		$sql = "SELECT * FROM user WHERE id= " . $id;
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows" => $rows];
	}

	public function manageRecordWithPagination($table, $pno)
	{

		if ($table == "categories") {
			$sql = "SELECT p.cid,p.category_name as category, c.category_name as parent, p.status FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cid ORDER BY p.category_name";
		} else if ($table == "products") {
			$sql = "SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_stock,p.stock_shop,p.added_date,p.p_status FROM products p,brands b,categories c WHERE p.bid = b.bid AND p.cid = c.cid ORDER BY p.product_name";
		} else {
			$sql = "SELECT * FROM " . $table . " ORDER BY brand_name";
		}
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows" => $rows];
	}


	public function getStockRecord($table)
	{
		$sql = "SELECT * FROM stock_record  ORDER BY product_name";
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows" => $rows];
	}

	public function GetDailyReport($table, $date)
	{
		?>

<script>
    alert(<?php echo $date; ?>);
</script>
<?php
$sql = "SELECT * FROM " . $table . " WHERE added_date=" . $date;
$result = $this->con->query($sql) or die($this->con->error);
$rows = array();
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
}
return ["rows" => $rows];
}
private function pagination($con, $table, $pno, $n)
{
	$query = $con->query("SELECT COUNT(*) as rows FROM " . $table);
	$row = mysqli_fetch_assoc($query);
	//$totalRecords = 100000;
	$pageno = $pno;
	$numberOfRecordsPerPage = $n;

	$last = ceil($row["rows"] / $numberOfRecordsPerPage);

	$pagination = "<ul class='pagination'>";

	if ($last != 1) {
		if ($pageno > 1) {
			$previous = "";
			$previous = $pageno - 1;
			$pagination .= "<li class='page-item'><a class='page-link' pn='" . $previous . "' href='#' style='color:#333;'> Previous </a></li></li>";
		}
		for ($i = $pageno - 5; $i < $pageno; $i++) {
			if ($i > 0) {
				$pagination .= "<li class='page-item'><a class='page-link' pn='" . $i . "' href='#'> " . $i . " </a></li>";
			}
		}
		$pagination .= "<li class='page-item'><a class='page-link' pn='" . $pageno . "' href='#' style='color:#333;'> $pageno </a></li>";
		for ($i = $pageno + 1; $i <= $last; $i++) {
			$pagination .= "<li class='page-item'><a class='page-link' pn='" . $i . "' href='#'> " . $i . " </a></li>";
			if ($i > $pageno + 4) {
				break;
			}
		}
		if ($last > $pageno) {
			$next = $pageno + 1;
			$pagination .= "<li class='page-item'><a class='page-link' pn='" . $next . "' href='#' style='color:#333;'> Next </a></li></ul>";
		}
	}
	//LIMIT 0,10
	//LIMIT 20,10
	$limit = "LIMIT " . ($pageno - 1) * $numberOfRecordsPerPage . "," . $numberOfRecordsPerPage;

	return ["pagination" => $pagination, "limit" => $limit];
}

public function deleteRecord($table, $pk, $id)
{
	if ($table == "categories") {
		$pre_stmt = $this->con->prepare("SELECT " . $id . " FROM categories WHERE parent_cat = ?");
		$pre_stmt->bind_param("i", $id);
		$pre_stmt->execute();
		$result = $pre_stmt->get_result() or die($this->con->error);
		if ($result->num_rows > 0) {
			return "DEPENDENT_CATEGORY";
		} else {
			$pre_stmt = $this->con->prepare("DELETE FROM " . $table . " WHERE " . $pk . " = ?");
			$pre_stmt->bind_param("i", $id);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "CATEGORY_DELETED";
			}
		}
	} else {
		$pre_stmt = $this->con->prepare("DELETE FROM " . $table . " WHERE " . $pk . " = ?");
		$pre_stmt->bind_param("i", $id);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "DELETED";
		}
	}
}

public function getReport()
{
	$dte = date("Y-m-d");


	$sdate = date('Y-m-d', strtotime('-1 days', strtotime($dte)));
	//echo $sdate;

	$sql = "SELECT * FROM products";
	$shots = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
	$sql2 = "SELECT t_date FROM stock_report ORDER BY id DESC LIMIT 1";

	$shots2 = mysqli_query($this->con, $sql2) or die(mysqli_error($this->con));
	$row2 = mysqli_fetch_assoc($shots2);
	
	$sql3 = "SELECT * FROM stock_report WHERE t_date='".$sdate."'";
	$shots3 = mysqli_query($this->con,$sql3) or die(mysqli_error($this->con));
	$row3 = mysqli_fetch_assoc($shots3);
	
//	var_dump($row2["t_date"]);
	if ($dte != $row2["t_date"]){
		
		
		while ($row = mysqli_fetch_assoc($shots)) {
				//echo "inserting day product";
				$insert_product = $this->con->prepare("INSERT INTO `stock_report`(`pid`, `product_name`, `product_stock`, `stock_shop`, `t_date`) VALUES (?,?,?,?,?)");
				$insert_product->bind_param("isiis", $row["pid"], $row["product_name"], $row["product_stock"], $row["stock_shop"], $dte);
				$insert_product->execute() or die($this->con->error);
			}
		
			while ($row3 = mysqli_fetch_assoc($shots3)) {
				//echo $row3["t_date"];
				//echo "updating day product";
				$insert_product = $this->con->prepare("UPDATE stock_report SET ystock_shop = ?, yproduct_stock= ? WHERE t_date = ? AND pid = ?");
				$insert_product->bind_param("iisi", $row3["stock_shop"], $row3["product_stock"], $dte, $row3["pid"]);
				$insert_product->execute() or die($this->con->error);
			}
	
	

	} 
	else {
		
		
		while ($row = mysqli_fetch_assoc($shots)) {
			//echo "updating";
				$insert_product = $this->con->prepare("UPDATE stock_report SET stock_shop = ?, product_stock= ? WHERE t_date = ? AND pid = ?");
				$insert_product->bind_param("iisi", $row["stock_shop"], $row["product_stock"], $dte, $row["pid"]);
				$insert_product->execute() or die($this->con->error);
			}
	}

}

public function reportdata($date)
{
	$sql3 = "SELECT * FROM stock_report WHERE t_date= '" . $date . "'  ORDER BY product_name";

	$result = $this->con->query($sql3) or die($this->con->error);

	$rows = array();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
	}
	return ["rows" => $rows];
}


public function getSingleRecord($table, $pk, $id)
{
	$pre_stmt = $this->con->prepare("SELECT * FROM " . $table . " WHERE " . $pk . "= ? LIMIT 1");
	$pre_stmt->bind_param("i", $id);
	$pre_stmt->execute() or die($this->con->error);
	$result = $pre_stmt->get_result();
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
	} else {

		return null;
	}
	return $row;
}

// update store stock
public function UpdateStoreStock($id, $qty, $total)
{
	$sql = "UPDATE products SET stock_shop ='" . $qty . "', product_stock='" . $total . "' WHERE pid=" . $id;
	$result = $this->con->query($sql) or die($this->con->error);
	return $result;
}

// update main stock
public function UpdateGodStock($id, $remains, $qty, $stotal, $date)
{
	$sql = "UPDATE products SET product_stock='" . $stotal . "' WHERE pid=" . $id;
	$pre_stmt = $this->con->prepare("INSERT INTO `stock_record`(`pid`, `added_date`, `product_name`, `stock`)
		 VALUES (?,?,?,?)");
	$status = 1;
	$pre_stmt->bind_param("issi", $id, $date, $remains, $qty);
	$pre_stmt->execute() or die($this->con->error);
	$result = $this->con->query($sql) or die($this->con->error);
	return $result;
}

public function update_record($table, $where, $fields)
{
	$sql = "";
	$condition = "";
	foreach ($where as $key => $value) {
		// id = '5' AND m_name = 'something'
		$condition .= $key . "='" . $value . "' AND ";
	}
	$condition = substr($condition, 0, -5);
	foreach ($fields as $key => $value) {
		//UPDATE table SET m_name = '' , qty = '' WHERE id = '';
		$sql .= $key . "='" . $value . "', ";
	}
	$sql = substr($sql, 0, -2);
	$sql = "UPDATE " . $table . " SET " . $sql . " WHERE " . $condition;
	if (mysqli_query($this->con, $sql)) {
		return "UPDATED";
	} else {

		return $this->con->error;
	}
}


public function storeCustomerOrderInvoice($orderdate, $ar_tqty, $ar_qty, $ar_price, $ar_pro_name, $sub_total, $discount, $net_total, $paid, $due, $payment_type)
{

	$pre_stmt = $this->con->prepare("INSERT INTO `invoice`( `order_date`, `sub_total`, `discount`, `net_total`, `paid`, `sell_total`, `payment_type`) VALUES (?,?,?,?,?,?,?)");


	$pre_stmt->bind_param("sddddds", $orderdate, $sub_total, $discount, $net_total, $paid, $due, $payment_type);
	$pre_stmt->execute() or die($this->con->error);
	$invoice_no = $pre_stmt->insert_id;
	if ($invoice_no != null) {
		for ($i = 0; $i < count($ar_price); $i++) {
			$pre_stmt = $this->con->prepare("SELECT * FROM products WHERE product_name = ? LIMIT 1");
			$pre_stmt->bind_param("s", $ar_pro_name[$i]);
			$pre_stmt->execute() or die($this->con->error);
			$result = $pre_stmt->get_result();
			$row = $result->fetch_assoc();
			$test = $row["stock_shop"];
			$rem_qty = 0;
			$rem_qty += ((int)$test - (int)$ar_qty[$i]);

			//echo $rem_qty."<br>";
			if ($rem_qty < 0) {
				return "ORDER_FAIL_TO_COMPLETE";
			} else {
				//Update Product stock
				$sql = "UPDATE products SET stock_shop = '$rem_qty' WHERE product_name = '" . $ar_pro_name[$i] . "'";
				$this->con->query($sql);
			}


			$insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`, `sdate`, `code`) VALUES (?,?,?,?,?,?)");
			$insert_product->bind_param("isddsi", $invoice_no, $ar_pro_name[$i], $ar_price[$i], $ar_qty[$i], $orderdate, $rem_qty);
			$insert_product->execute();
		}

		return "order successfull";
	}
}


// ---------------------------REPORTS---------------------------
public function getDataDaily($table, $date)
{
	if ($date === "1") {

		?>
<script>
    alert("<?php echo $date ?>")
</script>
<?php

	} 
else {


	$sql = "SELECT * FROM " . $table . " WHERE order_date = '" . $date . "'";
	$result = $this->con->query($sql) or die($this->con->error);

	$rows = array();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
	}
	return ["rows" => $rows];
}
}

public function getAllRecordsAt($number)
{
	$sql = "SELECT * FROM invoice_details WHERE invoice_no = '".$number."'";
	$result = $this->con->query($sql) or die($this->con->error);

	$rows = array();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
	}
	return ["rows" => $rows];
}


public function getCustData($table, $date1, $date2)
{
	$sql = "SELECT * FROM " . $table . " WHERE order_date BETWEEN '" . $date1 . "' AND '" . $date2 . "'";
	$result = $this->con->query($sql) or die($this->con->error);
	$rows = array();

	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
	}
	return ["rows" => $rows];
}
}

?> 