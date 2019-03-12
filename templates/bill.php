<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../assets/jquery.min.js"></script>
	<script src="../assets/popper.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="../assets/font/js/fontawesome.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"  crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="../assets/font/css/all.min.css">
 	
</head>
<body>
    <div id="bill" class="bill" style="width:800px; border: 1px solid gray; padding:10px; margin:auto;position:absolute; right:0;left:0;font-family: 'Times New Roman', Times, serif;">
    <h1 align="center">Katke Bhavan</h1>
    <br>
    <br>
    <h6>Date:&nbsp;<?php echo $_GET["order_date"]?> </h6>

    
    <br>

    <table class="table table-bordered text-center" >
        <thead>
            <tr>
            <th>#</th> 
            <th>Product Name</th> 
            <th>Quantity</th> 
            <th>Price</th> 
            <th>Total (RS)</th> 
            
            </tr>
            
        </thead>

        <tbody>
        <?php
        for ($i=0; $i < count($_GET["pid"]) ; $i++) { 
            ?>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $_GET["pro_name"][$i] ?></td>
                <td><?php echo $_GET["qty"][$i] ?></td>
                <td><?php echo $_GET["price"][$i] ?></td>
                <td><?php echo $_GET["qty"][$i] * $_GET["price"][$i] ?></td>
            </tr>
                <?php
                }
           ?>
        </tbody>
    </table>
    <br>
    <h6>Sub Total :&nbsp;&nbsp;&nbsp;<?php echo $_GET["sub_total"] ?></h6>
    <h6> Discount :&nbsp;&nbsp;&nbsp;<?php echo $_GET["discount"] ?></h6>
    <h6>   Net Total :&nbsp;&nbsp;&nbsp; <?php echo $_GET["net_total"] ?></h6>
     <h6>   Paid :&nbsp;&nbsp;&nbsp; <?php echo $_GET["paid"] ?></h6>
      <h6>  Due Amount : &nbsp;&nbsp;&nbsp;<?php echo $_GET["due"] ?></h6>
      <h6>  Payment Type : <?php echo $_GET["payment_type"] ?></h6>
      <br>
      <br>
      <h6  style="float:right; margin-top:-60px; margin-right:50px;">  Signature</h6>
    </div>
   

<script>
var a = 0;
$(document).ready(function(){
 
 var DOMAIN = "http://localhost:8000/public_html";
 if (a === 0) {
   
var restorepage = $('body').html();
var printcontent = $('#bill').clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
a++;
 } else {
    window.location.href = DOMAIN+"/new_order.php";
 }


})



</script>
</body>
</html>