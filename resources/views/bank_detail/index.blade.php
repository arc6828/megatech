<h2>ยอดสุทธิต่อเดือน</h2>
<table class="table table-hover text-center" id="table-bank-detail">
<thead>
    <tr>
        <th class="text-center">เดือน</th>
        <th class="text-center">ยอดที่ยกมา</th>
        <th class="text-center">ยอดที่รับ</th>
        <th class="text-center">ยอดที่จ่าย</th>
        <th class="text-center">ยอดปลายงวด</th>
    </tr>
</thead>
<tbody>
    @foreach ($table_detail_bank as $row)
    <tr>
        <td class="m_date_table">{{ $row->m_date }}</td>
        <td class="bring_forword_table">{{ $row->bring_forword }}</td>
        <td class="income_table">{{ $row->income }}</td>
        <td class="outcome_table">{{ $row->outcome }}</td>
        <td class="balance">{{ $row->balance }}</td>  
    </tr>
    @endforeach
</tbody>
</table>

<script>
   function changeValue() {
       var current = parseInt(document.getElementById("bring_forword").value);
       var income = document.getElementsByClassName("income_table");
       var outcome = document.getElementsByClassName("outcome_table");
       var balance = document.getElementsByClassName("balance");
       var bring_forword = document.getElementsByClassName("bring_forword_table");
       var x;
        for(x=0;x<=income.length;x++) {
         var total = current + parseInt(income[x].innerHTML) - parseInt(outcome[x].innerHTML);
         bring_forword[x].innerHTML = current;
         balance[x].innerHTML = total;   
         total = 0;
        }         
   };
   var date = new Date();
   console.log(date.getMonth(date.setMonth(1))+1);
   var current = parseInt(document.getElementById("bring_forword").value);
   current = 0;
   var bring_forword_table = document.getElementsByClassName("bring_forword_table");
   var income = document.getElementsByClassName("income_table");
   var outcome = document.getElementsByClassName("outcome_table");
   var balance = document.getElementsByClassName("balance");
   var x;
   for(x= 0; x<income.length;x++) {
    var total = current+parseInt(income[x].innerHTML)-parseInt(outcome[x].innerHTML);
    bring_forword_table[x].innerHTML = current;
    balance[x].innerHTML = total;
    
    total = 0;
   }
   
</script>

