$(document).ready(function () {
	var DOMAIN = "http://localhost:8000/public_html";
	//var productScanComplete;
	var isProductScanned = false;
	
	addNewRow();
	removeRow();

	$("#add").click(function () {
		addNewRow();
	})

	function removeRow() {
		var rowCount = $('#dsTable tr').length;
		if (rowCount <= 2) {

		}
		else {
			$("#invoice_item").children("tr:last").remove();
			calculate(0, 0);
		}
	}

	$("#invoice_item").delegate("#remove", "click", function () {
		var rowCount = $('#dsTable tr').length;
		if (rowCount <= 2) {

		}
		else {
			$(this).parent().parent("tr").remove();
			calculate(0, 0);
		}

	})
	function addNewRow() {
		$.ajax({
			url: "./includes/process.php",
			method: "POST",
			data: { getNewOrderItem: 1 },
			success: function (data) {
				$("#invoice_item").append(data);
				var n = 0;
				$(".number").each(function () {
					$(this).html(++n);
				})
				$(".code").focus();
				console.log("added");

			}
		})
	}

	var timeout = null;
	function changePrice(qty , index) {
		if (qty > ($("#dsTable tr:nth-child("+index+") .tqty").val() - 0)  ) {
			
			$("#dsTable tr:nth-child("+index+") .qty").val(0);
		} else {

		
		$("#dsTable tr:nth-child("+index+") .amt").html(qty * $("#dsTable tr:nth-child("+index+") .price").val());
		$("#dsTable tr:nth-child("+index+") .pmt").html(qty * $("#dsTable tr:nth-child("+index+") .prices").val());
		calculate(0, 0);
		}
	}
	
	$("#invoice_item").delegate(".code", "keyup", function (e) {
		isProductScanned = false;
		if (timeout != null) {
			clearTimeout(timeout);
		}

		var a = this;
		var pid = $(this).val();
		var tr = $(this).parent().parent();

		timeout = setTimeout(function () {
			
			if(pid.length != 8 && pid.length != 13 ){
					$(a).focus();
					$(a).val("");
					return;
				
				}
				var indes = 0;
				$("#dsTable tr").each(function(){
					console.log("index is = " + indes);
				index = indes - 1;
				if(pid === $("#dsTable tr:nth-child(" + index + ") .code").val()){
					//debugger;
				var k = parseInt($("#dsTable tr:nth-child("+ index +") .qty").val()) + 1;
				$("#dsTable tr:nth-child(" + index + ") .qty").val(k);
				$(a).focus();
				$(a).val("");
				isProductScanned = true;
				changePrice(k,index);
				removeRow();	
				}	
				indes++;
				//return false;
				});
				$(a).prop('disabled', true);
			
				$(".overlay").show();
				
				$.ajax({
					url: "./includes/process.php",
					method: "POST",
					dataType: "json",
					data: { getPriceAndQty: 1, id: pid },
					success: function (data) {
						if(!data){
							$(a).prop('disabled', false);
							$(a).focus();
							$(a).val("");
							alert("product not found for id = " + pid);
						}
						tr.find(".code").val(data["code_id"]);
						tr.find(".pid").val(data["product_name"]);
						if (data["stock_shop"] === 0) {

							alert("Sorry ! This much of quantity is not available");
							tr.find(".qty").val(0);
						}
						else {
							tr.find(".qty").val(1);
						}
						tr.find(".pro_name").val(data["product_name"]);
						tr.find(".tqty").val(data["stock_shop"]);
						tr.find(".price").val(data["productsell"]);
						tr.find(".prices").val(data["product_price"]);
						tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
						tr.find(".pmt").html(tr.find(".qty").val() * tr.find(".prices").val());
						calculate(0, 0);
						addNewRow();
						console.log("a");
						isProductScanned = true;
					}



				});


				

		}, 100);

	})

	$("#invoice_item").delegate(".qty", "keyup", function () {
		var qty = $(this);
		var tr = $(this).parent().parent();
		if (isNaN(qty.val())) {
			alert("Please enter a valid quantity");
			qty.val(1);
		} else {
			if ((qty.val() - 0) > (tr.find(".tqty").val() - 0)) {
				alert("Sorry ! This much of quantity is not available");
				qty.val(0);
			} else {
				tr.find(".amt").html(qty.val() * tr.find(".price").val());
				tr.find(".pmt").html(qty.val() * tr.find(".prices").val());
				calculate(0, 0);
			}
		}

	})

	function calculate(dis, paid) {
		var sub_total = 0;
		var gst = 0;
		var net_total = 0;
		var discount = dis;
		var paid_amt = paid;
		var due = 0;
		var amt = 0;
		$(".amt").each(function () {
			sub_total = sub_total + ($(this).html() * 1);
		})
		$(".pmt").each(function () {
			due = due + ($(this).html() * 1);
		})
		// gst = 0.18 * sub_total;

		sub_total = sub_total - discount;

		$("#gst").val(gst);
		$("#sub_total").val(sub_total);
		$("#discount").val(discount);
		$("#net_total").val(sub_total);
		$("#paid").val(sub_total);
		$("#due").val(due);

	}

	$("#discount").keyup(function () {
		var sub_total = 0;
		$(".amt").each(function () {
			sub_total = sub_total + ($(this).html() * 1);
		})

		var discount = $(this).val();
		if (discount > sub_total) {
			alert("enter proper amount");
		}
		calculate(discount, 0);

	})

	$("#paid").keyup(function () {

		var paid = $(this).val();
		var discount = $("#discount").val();
		calculate(discount, paid);
	})


	/*Order Accepting*/

	$("#order_form").click(function (e) {

		if (!isProductScanned) {
			return;
		} 

		if ($("#paid").val() === "") {
			alert("Plaese enter paid amount");
			$(".code").fucus();
		}

	
		else {
			if ($("#dsTable tr:last-child .pid").val() === "") {
				
			//	alert("alert last row is empty");
				removeRow();
			} 
			console.log($("#dsTable tr:last-child .pid").val());
			
			$.ajax({
				url: "./includes/process.php",
				method: "POST",
				data: $("#get_order_data").serialize(),

				success: function (data) {

					if (data < 0) {
						alert(data);
					} else {

						$("#get_order_data").trigger("reset");
						$(".amt").html(0);
						$(".code").prop('disabled', false);
						$(".code").focus();
						$("tr").each(function (i) {
							var rowCount = $('#dsTable tr').length;
							if (rowCount > 2) {
								$("#invoice_item").children("tr:last").remove();

							}
						});
						$(".code").focus();
						window.location.href = "new_order.php";
						alert(data);
					}

				}
			});
		}
		
	});

});