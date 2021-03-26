<?php
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "frubji";

$prefix = "";

$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Could not connect database");

if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])) {

        $variant = strtoupper(trim($_REQUEST['variant']));
        $productID = $_REQUEST['id'];
        $order_qty = (int) $_REQUEST["qty"] ?? 1;
        $branch = $_SESSION["branch"]["branch"];
        $remove_from_wishlist = (bool) $_REQUEST["movecart"];

        if ($user_home->is_logged_in() && $remove_from_wishlist)  {
            $query = $bd->query("DELETE FROM `wishlist` WHERE `user_id` = {$_SESSION["userSession"]} AND `product_id` = {$productID} AND `variant_id` = {$variant}");
        }

        // get product details
        $query = '';
        if (empty($variant)) {
            $query = $bd->query("SELECT * FROM products WHERE id = " . $productID);
        } else {
            $query = $bd->query("SELECT
                    `p`.`img` `image`,
                    `p`.`id` `product_id`,
                    `p`.`name` `product_name`,
                    `p`.`productcode` `product_code`,
                    `pp`.`price` `retail_price`,
                    `p`.`hsncode` `hsn`,
                    `p`.`gst` `tax`
                FROM
                    `products` `p`
                INNER JOIN
                    `productsprice` `pp`
                ON
                    `p`.`id` = `pp`.`productid`
                WHERE
                    `p`.`id` = {$productID}
                AND
                    `pp`.`branchid` = {$branch}
                AND
                    `pp`.`variantid`= {$variant} ");
        }

        $row = $query->fetch_assoc();

        if ($query->num_rows) {
            $itemData = array(
                'imagurl' => !empty($row['image']) ? "media/products/{$row['image']}" : "media/products/noimage.jpg",
                'id' => $row['product_id'],
                'name' => $row['product_name'],
                'productcode' => $row['product_code'],
                'price' => (empty($variant) || !empty($row['retail_price'])) ? $row['retail_price'] : $row['retail_price'],
                'hsncode' => $row['hsn'],
                'qty' => $order_qty,
            );

            $itemData["variant"] = $variant;

            $insertItem = $cart->insert($itemData);
            $redirectLoc = $insertItem ? 'viewcart.php' : 'index.php';
            header("Location: " . $redirectLoc);
        } else {

        }
    } elseif ($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])) {
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty'],
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem ? 'ok' : 'err';die;
    } elseif ($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])) {
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: viewcart.php");
    } elseif ($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])) {
        // insert order details into database
        $insertOrder = $db->query("INSERT INTO orders (customer_id, total_price, created, modified) VALUES ('" . $_SESSION['sessCustomerID'] . "', '" . $cart->total() . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "')");

        if ($insertOrder) {
            $orderID = $db->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach ($cartItems as $item) {
                $sql .= "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('" . $orderID . "', '" . $item['id'] . "', '" . $item['qty'] . "');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);

            if ($insertOrderItems) {
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            } else {
                header("Location: checkout.php");
            }
        } else {
            header("Location: checkout.php");
        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
