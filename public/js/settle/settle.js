var d = new Date();
var month = d.getUTCMonth() + 1;
var year = d.getUTCFullYear();
newdate = month + "/" + year;
document.getElementById("tax_filing").innerHTML = newdate;

function date(date_settle,debt_period) {
  //var d1 = new Date();
  //var d2 = new Date();
  var date1 = document.getElementById("date_settle").value;
  var date2 =  parseInt(document.getElementById("debt_period").value);


  if (date1 !== "" || date2 !== ""){
    var d1 = moment(date1);
    console.log("d1 :" , d1);

    var y = d1.add(date2, 'days').format('YYYY-MM-DD');
    console.log("y : ",y);
    document.getElementById("deadline_settle").value = y;

  }

}

function calculate(total_settle,discount,tax,cash_receipt,total_deposit) {
  var total_settle = parseInt(document.getElementById("total_settle").value);
  var discount = document.getElementById("discount").value;
  var tax = parseInt(document.getElementById("tax").value);
  var cash_receipt = document.getElementById("cash_receipt").value;
  var total_deposit = document.getElementById("total_deposit").value;
  var tax_value = document.getElementById("tax_value").value;
  var total = document.getElementById("total").value;
  if (discount == "" || total_deposit == null) {
    if (total_deposit == 0) {
    var x = (total_settle*tax)/100;
    document.getElementById("tax_value").innerHTML = x;
    total = total_settle + x;
    document.getElementById("total").value = total;
  } else if (total_deposit !== 0) {
    total = total_settle - total_deposit;
    var x = (total*tax)/100;
    document.getElementById("tax_value").innerHTML = x;
    total = total + x;
    console.log(total);
    document.getElementById("total").value = total;
  }
    if (cash_receipt !== null) {
      total = total - cash_receipt;
      total = total.toFixed(2);
      document.getElementById("total").value = total;
    } 
  } else if (discount.includes("%")) {
    if (total_deposit == 0) {
    var x = isNaN(discount);
    x = parseInt(discount);
    x = x/100;
    var y = total_settle*x;
    y = total_settle-y;
    var a = (y*tax)/100;
    tax_value = a.toFixed(2);
    document.getElementById("tax_value").innerHTML = tax_value;
    total = y + a;
    total = total.toFixed(2);
    document.getElementById("total").value = total;
    } else if (total_deposit !==0) {
      var x = isNaN(discount);
      x = parseInt(discount);
      x = x/100;
      var y = total_settle*x;
      y = total_settle-y;
      y = y - total_deposit;
      var a = (y*tax)/100;
      tax_value = a.toFixed(2);
      console.log(a);
      document.getElementById("tax_value").innerHTML = tax_value;
      total = y + a;
      total = total.toFixed(2);
      document.getElementById("total").value = total;
    }
    if (cash_receipt !== 0) {
      total = total - cash_receipt;
      total = total.toFixed(2);
      document.getElementById("total").value = total;
    } 
  } else if(!discount.includes("%")) {
    if (total_deposit == 0) {
    var x = parseInt(discount);
    total = total_settle-x;
    var y = (total*tax)/100;
    var tax_value = y.toFixed(2);
    document.getElementById("tax_value").value = tax_value;
    total = total + y;
    total = total.toFixed(2);
    document.getElementById("total").value = total; 
    } else if (total_deposit !== 0) {
      var x = parseInt(discount);
      total = total_settle - total_deposit - x ;
      var y = (total*tax)/100;
      var tax_value = y.toFixed(2);
      document.getElementById("tax_value").value = tax_value;
      total = total + y;
      total = total.toFixed(2);
      document.getElementById("total").value = total;
    }
    if (cash_receipt !== 0) {
      var total = total - cash_receipt;
      total = total.toFixed(2);
      document.getElementById("total").value = total;
   }
  }
}