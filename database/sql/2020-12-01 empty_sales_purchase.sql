-- SALES --
TRUNCATE TABLE  tb_quotation;
TRUNCATE TABLE  tb_quotation_detail;

TRUNCATE TABLE  tb_order;
TRUNCATE TABLE  tb_order_detail;
TRUNCATE TABLE  tb_order_detail2;

TRUNCATE TABLE  tb_invoice;
TRUNCATE TABLE  tb_invoice_detail;

TRUNCATE TABLE  tb_delivery_temporary;
TRUNCATE TABLE  tb_delivery_temporary_detail;

TRUNCATE TABLE  return_invoices;
TRUNCATE TABLE  return_invoice_details;

-- PURCHASE --
TRUNCATE TABLE  tb_purchase_requisition;
TRUNCATE TABLE  tb_purchase_requisition_detail;

TRUNCATE TABLE  tb_purchase_order;
TRUNCATE TABLE  tb_purchase_order_detail;

TRUNCATE TABLE  tb_purchase_receive;
TRUNCATE TABLE  tb_purchase_receive_detail;

TRUNCATE TABLE  return_orders;
TRUNCATE TABLE  return_order_details;

-- GAURD STOCK --
TRUNCATE TABLE  adjust_stocks;
TRUNCATE TABLE  adjust_stock_details;

TRUNCATE TABLE  issue_stocks;
TRUNCATE TABLE  issue_stock_details;

TRUNCATE TABLE  receive_finals;
TRUNCATE TABLE  receive_final_details;

-- CLEAR pending-in pending-out -- 
UPDATE `tb_product` SET  `pending_in` = 0 , `pending_out`=0, `amount_in_stock_default` = `amount_in_stock

