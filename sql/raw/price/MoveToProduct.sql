INSERT INTO `tb_product`(`item_code`,`product_name`,`grade`,`normal_price`,`product_code`,`quantity`,brand) SELECT `ItemCode`, `Description`, `Grade`, `PriceList (New)`, `MegaCode`, `quatity`,"KK" FROM `tb_product_kk`;

INSERT INTO `tb_product`(`item_code`,`product_name`,`normal_price`,`product_code`,brand) SELECT `CODICE`, `DESCRIZIONE`, `Sale Price`, `CODE`,"SAU" FROM `tb_product_sau`;

INSERT INTO `tb_product`(`product_name`,`grade`,`item_code`,`normal_price`,`weight_in_lbs`,`price_1`,`product_code`,brand) SELECT `ORDER NUMBER`, `GRADE`, `GAL NUMBER`, `Sale Price`, `WEIGHT IN LBS`, `UNIT PRICE`, `CODE`, "TF1" FROM `tb_product_tf_sheet1`;

INSERT INTO `tb_product`(`product_name`,`grade`,`item_code`,`normal_price`,`weight_in_lbs`,`price_10_99`,`price_100`,`product_code`,brand) SELECT `ORDER NUMBER`, `GRADE`, `GAL NUMBER`, `Sale Price`, `WEIGHT IN LBS`, `10-99`, `100.00`, `CODE`, "TF2" FROM `tb_product_tf_sheet2`;

INSERT INTO `tb_product`(`product_name`,`grade`,`item_code`,`normal_price`,`weight_in_lbs`,`price_10_99`,`price_100`,`product_code`,brand) SELECT `ORDER NUMBER`, `GRADE`, `GAL NUMBER`, `Sale Price`, `WEIGHT IN LBS`, `10-99`, `100.00`, `CODE`, "TF3" FROM `tb_product_tf_sheet3`;

INSERT INTO `tb_product`(`product_code`,`product_name`,`product_unit`,`normal_price`,brand) SELECT`IDS`, `XDESC`, `UNIT`, `PRICE`, "TT" FROM `tb_product_tt`;

