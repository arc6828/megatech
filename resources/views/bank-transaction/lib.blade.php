@php
function getTransactionCode($main){    
    switch($main){
        case "deposite" : 
            $main = "ฝากเงินเข้า ธ.";
            break;              
        case "withdraw" : 
            $main = "เบิกเงินจาก ธ.";
            break;              
        case "transfer" : 
            $main = "โอนเงินระหว่าง ธ.";
            break;         

        case "withdraw-cheque" : 
            $main = "เบิกเงินด้วยเช็ค";
            break;              
        case "interest" : 
            $main = "รายได้จาก ธ.";
            break;              
        case "fee" : 
            $main = "ค่าใช้จ่าย ธ.";
            break;       
        case "cash-transfer-in" : 
            $main = "ชำระโดยลูกค้า";
            break;       
        case "cash-transfer-out" : 
            $main = "ชำระเจ้าหนี้";
            break;
        case "" : 
            $main = "ทั้งหมด";
            break;
    }
    return $main;
}
@endphp