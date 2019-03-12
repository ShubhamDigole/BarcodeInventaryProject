<?php
include_once("./database/constants.php");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inventory Management System</title>
    <script src="./assets/jquery.min.js"></script>
    <script src="../assets/popper.min.js" crossorigin="anonymous"></script>
    <script src="./assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="./assets/font/js/fontawesome.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./assets/font/css/all.min.css">
    <script type="text/javascript" src="./js/order.js"></script>
</head>

<body>
    <div class="overlay">
        <div class="loader"></div>
    </div>
    <!-- Navbar -->
    <?php include_once("./templates/header.php"); ?>
    <br /><br />

    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
                    <div class="card-header">
                        <h4>New Orders</h4>
                    </div>
                    <div class="card-body">
                        <form id="get_order_data" onsubmit="return false">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" align="right">Order Date</label>
                                <div class="col-sm-6">
                                    <input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-d-m"); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="net_total" class="form-control form-control-sm" id="net_total" required />
                                </div>
                            </div>


                            <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
                                <div class="card-body">
                                    <h3 align="center">Make a order list</h3>
                                    <table align="center" style="width:800px;" id="dsTable" class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="text-align:center;">Code</th>
                                                <th style="text-align:center;">Name</th>
                                                <th style="text-align:center;">Quantity</th>
                                                <th style="text-align:center;">Price</th>
                                                <th style="text-align:center;">Total</th>
                                                <th style="text-align:center;">Remove</th>
                                                <th style="text-align:center;">Remain</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoice_item">
                                            <!--<tr>
		    <td><b id="number">1</b></td>
		    <td>
		        <select name="pid[]" class="form-control form-control-sm" required>
		            <option>Washing Machine</option>
		        </select>
		    </td>
		    <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm"></td>   
		    <td><input name="qty[]" type="text" class="form-control form-control-sm" required></td>
		    <td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td>
		    <td>Rs.1540</td>
		</tr>-->
                                        </tbody>
                                    </table> <!-- Table Ends-->
                                    <center style="padding:10px;">
                                        <input type="button" id="add" style="width:150px;" class="btn btn-success" value="Add">

                                    </center>
                                </div>
                                <!--Crad Body Ends-->
                            </div> <!-- Order List Crad Ends-->

                            <p></p>
                            <div class="form-group row">
                                <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="sub_total" class="form-control form-control-sm" id="sub_total" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="discount" class="col-sm-3 col-form-label" align="right">Discount %</label>
                                <div class="col-sm-6">
                                    <input type="text" name="discount" class="form-control form-control-sm" id="discount" required />
                                </div>
                            </div>

                    </div>
                    <div class="form-group row">
                        <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                        <div class="col-sm-6">
                            <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
                        </div>
                    </div>


                    <input type="hidden" readonly name="due" class="form-control form-control-sm" id="due" required />

                    <div class="form-group row">
                        <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                        <div class="col-sm-6">
                            <select name="payment_type" class="form-control form-control-sm" id="payment_type" required />
                            <option>Cash</option>
                            <option>Card</option>
                            <option>Draft</option>
                            <option>Cheque</option>
                            </select>
                        </div>
                    </div>

                    <center>
                        <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order">
                        <!-- <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice"> -->
                    </center>


                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>



</body>

</html> 