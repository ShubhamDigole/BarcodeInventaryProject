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

<div class="container date" style="margin:10px;">
<input type="date" class="form-control dates" id="date-input" value="<?php echo date("Y-m-d");?>" required />
<button id="submit" class="btn btn-primary">Search</button>
</div>
<div id="vals">
    <table border="1" cellspacing="0" class="table table-striped table-inverse" style="width:100%; text-align:center" >
        <thead class="thead-inverse"> 
            <tr>
            <th>#</th>
                <!-- <th>Product Id </th> -->
                <th>Name</th>
                <th>Today Stock In Godown</th>
                <th>Today Stock In Shop</th>
                <th> Today Total Stock </th>
                <th> Date Today</th>
                <th>Yesterday Stock In Godown</th>
                <th>Yesterday Stock In Shop</th>
                <th> Yesterday Total Stock </th>
            </tr>
            </thead>
            <tbody id="get_data">
                
            </tbody>
    </table>
    </div>
  <button class="btn btn-primary" style="margin:10px;" id="generate">Generate PDF</button>
  
<script>
$(document).ready(function(){

var DOMAIN = "http://localhost:8000/public_html";

var  month, year;


getVals();
function getVals() {

    
		$.ajax({
			url : "./includes/process.php",
			method : "POST",
			data : {getVals:1},
			success : function(data){
                $('#get_data').html(data)
			}
		})
	}
    



$('#submit').on('click', function(){

    var date = new Date($('#date-input').val());
      
      if(date.getDate() < 10){

        day = "0" + date.getDate(); 
      }
      else{

        day = date.getDate();
      }

      if(date.getMonth() < 10){

        month = "0" + (date.getMonth() + 1); 
      }
      else{

        month = date.date.getMonth() + 1;
      }
     
      year = date.getFullYear();
      
      dates = [year,month, day ].join('-');
 get_rdata(dates);
 
function get_rdata(dates){
		$.ajax({
			url : "./includes/process.php",
			method : "POST",
			data : {get_rdata:1,date:dates},
			success : function(data){
                $('#get_data').html(data)
			}
		})
	}
 
 

});

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