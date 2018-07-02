var d = new Date();
var month = d.getUTCMonth() + 1;
var year = d.getUTCFullYear();
newdate = month + "/" + year;
document.getElementById("tax_filing").innerHTML = newdate;

function date(date_settle,debt_period) {
  var d1 = new Date();
  var d2 = new Date();
  var date1 = document.getElementById("date_settle").value;
  var dateplus =  document.getElementById("debt_period").value;
  var date3 = parseInt(dateplus);
  var date2 = Date.parse(date1);
  var x = d1.setDate(d.getDate(date1)+date3);
  var y = d1.toJSON(x);
  document.getElementById("deadline_settle").innerHTML = y;
}

function calculate(total_settle,discount,tax,cash_receipt,total_deposit) {
  var total_settle = document.getElementById("total_settle").value;
  var discount = document.getElementById("discount").value;
  var tax = document.getElementById("tax").value;
  var cash_receipt = document.getElementById("cash_receipt").value;
  var total_deposit = document.getElementById("total_deposit").value;
  var tax_value = document.getElementById("tax_value");
  var total = document.getElementById("total");
  if (discount == "" && total_deposit == 0) {
    tax_value.value = (total_settle*tax)/100;
    total = total_settle+tax_value;
    document.getElementById("tax_value").innerHTML = tax_value;
  } else if (discount !== "" && discount.includes("%")) {
    var x = isNaN(discount);
    x = parseInt(discount);
    x = x/100;
    var y = total_settle*x;
    total = total_settle-y;
    var a = (total*tax)/100;
    tax_value.value = a.toFixed(2);
    document.getElementById("tax_value").innerHTML = tax_value;
  } else if(discount !== "" && discount.includes("")) {
    var x = parseInt(discount);
    total = total_settle-x;
    var y = (total*tax)/100;
    var tax_value = y.toFixed(2);
    document.getElementById("tax_value").innerHTML = tax_value;
  }
}