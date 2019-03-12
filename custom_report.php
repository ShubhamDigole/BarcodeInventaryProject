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
      margin-left:10px;
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
<input type="date" class="form-control dates" id="date-input2" value="<?php echo date("Y-m-d");?>" required />

<button id="submit" class="btn btn-primary">Search</button>
</div>
<div id="vals">
    <table border="1" cellspacing="0" class="table table-striped table-inverse" style="width:100%; text-align:center" >
        <thead class="thead-inverse"> 
            <tr>
            <th>#</th>
                <th>Products</th>
                <th>Date</th>
                <th>MRP Total</th>
                <th>Sell Total</th>
                <th> Discount </th>
                <th> Payment Type</th>
            </tr>
            </thead>
            <tbody id="CustData">
                
            </tbody>
    </table>
    </div>
  <button class="btn btn-primary" style="margin:10px;" id="generate">Generate PDF</button>
  
<script>
$(document).ready(function(){

var DOMAIN = "http://localhost:8000/public_html";

var  month, year;

$('#submit').on('click', function(){

    var date = new Date($('#date-input').val());
    var date2= new Date($('#date-input2').val());  
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
      
      if(date2.getDate() < 10){

        day2 = "0" + date2.getDate(); 
        }
        else{

        day2 = date2.getDate();
        }

        if(date2.getMonth() < 10){

        month2 = "0" + (date2.getMonth() + 1); 
        }
        else{

        month2 = date.date2.getMonth() + 1;
        }
        

        year = date.getFullYear();
        year2 = date2.getFullYear();

        dates = [year,month, day ].join('-');
        dates2 = [year2,month2, day2 ].join('-');

        getCustomReport(dates, dates2);
 
        function getCustomReport(dates){
		$.ajax({
			url :"./includes/process.php",
			method : "POST",
			data : {getCustomReport:1,date1:dates,date2:dates2},
			success : function(data){
                $('#CustData').html(data)
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