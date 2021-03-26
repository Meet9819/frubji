<?php

namespace Constants\Database;

define('DATABASE_HOSTNAME', 'localhost');
define('DATABASE_PORT', 3306);
define('DATABASE_NAME', 'frubji');
define('DATABASE_CONNECTION_USERNAME', 'root');
define('DATABASE_CONNECTION_PASSWORD', '');

define('LAST_INSERT_ID', 'SELECT LAST_INSERT_ID() AS ID;');

define('SEQ_BRANCH_REQUEST_ORDER', 'SELECT MAX(`order_id`) FROM `br_request_order`;');

define('QUERY_BRANCH_REQUEST_ORDER_INSERT', 'INSERT INTO `br_request_order`
(`order_no`, `branchreferenceno`, `requestorderprifix`, `requestfrom`, `requestto`, `order_total_before_tax`, `order_total_after_tax`, `remarks`, `whichcompany`)
VALUES (:order_no, :branchreferenceno, :requestorderprifix, :requestfrom, :requestto, :order_total_before_tax, :order_total_after_tax, :remarks, :whichcompany);');

define('QUERY_BRANCH_REQUEST_ORDER_UPDATE', 'UPDATE `br_request_order`
SET `order_no`=:order_no, `branchreferenceno`=:branchreferenceno, `requestorderprifix`=:requestorderprifix, `order_date`=:order_date, `requestfrom`=:requestfrom,
`requestto`=:requestto, `order_total_before_tax`=:order_total_before_tax, `order_total_after_tax`=:order_total_after_tax, `remarks`=:remarks, 
`whichcompany`=:whichcompany WHERE `order_id`=:order_id;');

define('QUERY_BRANCH_REQUEST_ORDER_DELETE', 'DELETE FROM `br_request_order` WHERE `order_id` = :order_id');

define('QUERY_BRANCH_REQUEST_ORDER_ITEM_INSERT', 'INSERT INTO `br_request_order_item`
(order_id, itemcode, item_name, pendingqty, units, packing, order_item_quantity, order_item_price, order_item_actual_amount, order_item_final_amount, requestfromm, requesttoo, whichcompany)
VALUES (:order_id, :itemcode, :item_name, :pendingqty, :units, :packing, :order_item_quantity, :order_item_price, :order_item_actual_amount, :order_item_final_amount, :requestfromm, :requesttoo, :whichcompany);');

define('QUERY_BRANCH_REQUEST_ORDER_ITEM_UPDATE', 'UPDATE `br_request_order_item`
SET `item_name`=[value-4],`pendingqty`=[value-5],`units`=[value-6],`packing`=[value-7],`order_item_quantity`=[value-8],`order_item_price`=[value-9],`order_item_actual_amount`=[value-10],`order_item_final_amount`=[value-11],`requestfromm`=[value-12],`requesttoo`=[value-13],`whichcompany`=[value-14] WHERE `order_id`=[value-2] AND `itemcode`=[value-3]');

define('QUERY_BRANCH_REQUEST_ORDER_ITEM_DELETE', 'DELETE FROM `br_request_order_item` WHERE `order_id` = :order_id');
