UPDATE `return_invoices` SET `staff_id`=`user_id` WHERE `staff_id` IS NULL;
UPDATE `tb_delivery_temporary` SET `staff_id`=`user_id` WHERE `staff_id` IS NULL;
UPDATE `tb_invoice` SET `staff_id`=`user_id` WHERE `staff_id` IS NULL;
UPDATE `tb_order` SET `staff_id`=`user_id` WHERE `staff_id` IS NULL;
UPDATE `tb_quotation` SET `staff_id`=`user_id` WHERE `staff_id` IS NULL;