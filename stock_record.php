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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daily Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="./assets/jquery.min.js"></script>
    <script src="./js/manage.js"></script>

    <style>
   .dates {
    display: block;
    float: left;
      
    }
    .date input{
      width: 170px;
    }
    .date button{

      margin-left: 20px;
    }
    
    </style>
</head>
<body>
<?php include_once("./templates/header.php"); ?>


<div id="vals">
    <table border="1" cellspacing="0" class="table table-striped table-inverse" style="width:100%; text-align:center" >
        <thead class="thead-inverse"> 
            <tr>
            <th>#</th>
                <th>Product Id</th>
                <th>Date</th>
                <th>Product Name</th>
                <th>Added Number Of Bottles</th>
               
            </tr>
            </thead>
            <tbody id="get_stock">
                
            </tbody>
    </table>
    </div>
  <button class="btn btn-primary" style="margin:10px;" id="generate">Generate PDF</button>
  
<script>
$(document).ready(function(){

var DOMAIN = "http://localhost:8000/public_html";

GetStock(1);
	function GetStock(){
		$.ajax({
			url : "./includes/process.php",
			method : "POST",
			data : {GetStock:1},
			success : function(data){
                console.log(data);
                
				$("#get_stock").html(data);		
			}
		})
	}



$("#generate").click(function(){
restorepage = $('body').html();
var printcontent = $('#vals').clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);

});
});

</script>
</body>
</html>