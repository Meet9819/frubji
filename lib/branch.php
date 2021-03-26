<?php
namespace Branch;

require_once '../db.php';

class BranchDetails
{

    private static $branch_details_query = "SELECT
            `b`.`id` `branch`,
            `b`.`companyid` `company`,
            `b`.`branchcode` `branch_code`,
            `b`.`prifix` `branch_prefix`,
            `b`.`branchname_english` `branch_name`,
            `b`.`img`,
            `b`.`address`,
            `b`.`email`,
            `b`.`mobile`,
            `b`.`locationlatitude`,
            `b`.`locationlongitude`,
            `b`.`status`,
            `p`.`pincode`
        FROM
            `branch` `b`
        INNER JOIN
            `branchpincode` `p`
        ON
            `b`.`id` = `p`.`branchid` ";

    // get branch details by branch ID
    public static function get_branch_details_branchID($branch_id, $connection = null)
    {
        $branch_details = array();
        $con_started = false;

        try {
            if (empty($connection)) {
                $connection = $con;

                if ($connection->connect_error) {
                    throw new \Exception("{$connection->connect_errno} : {$connection->connect_error}");
                }

                $con_started = true;
            }

            $query = BranchDetails::$branch_details_query . " WHERE `b`.`id` = ?";

            $branch_details_query_stmt = $connection->prepare($query);

            $branch_details_query_stmt->bind_param("i", $branch_id);

            $branch_details_query_stmt->execute();

            $result = $branch_details_query_stmt->get_result();

            $branch_details = $result->fetch_assoc();

            if (!empty($branch_details["branch"])) {
                $branch_details["price"] = BranchPrice::get_price_master($branch_details["branch"], $connection);
            }
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            if ($con_started) {
                $con->close();
            }
        }

        return $branch_details;
    }

    // get branch details by pin code
    public static function get_branch_details_pincode($pincode, $connection = null)
    {
        $branch_details = array();
        $con_started = false;

        try {
            if (empty($connection)) {
                $connection = $con;

                if ($connection->connect_error) {
                    throw new \Exception("{$connection->connect_errno} : {$connection->connect_error}");
                }

                $con_started = true;
            }

            $query = BranchDetails::$branch_details_query . " WHERE `p`.`pincode` = ?";

            $branch_details_query_stmt = $connection->prepare($query);

            $branch_details_query_stmt->bind_param("i", $pincode);

            $branch_details_query_stmt->execute();

            $result = $branch_details_query_stmt->get_result();

            $branch_details = $result->fetch_assoc();

            if (!empty($branch_details["branch"])) {
                $branch_details["price"] = BranchPrice::get_price_master($branch_details["branch"], $connection);
            }
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            if ($con_started) {
                $con->close();
            }
        }

        return $branch_details;
    }
}

class BranchPrice
{
    private static $price_master_branch_query = "SELECT
            `P`.`id` `product_id`,
            `P`.`maincat` `product_cat`,
            `P`.`categoryid` `product_cat_id`,
            `P`.`productcode` `product_code`,
            `P`.`name` `product_name`,
            `P`.`shortdescription` `desc_short`,
            `P`.`description` `desc`,
            `P`.`img` `image`,
            `P`.`sale` `sale_status`,
            `P`.`newold` `newold_status`,
            `P`.`hsncode` `hsn`,
            `P`.`pr` `tag`,
            `PV`.`id` `product_variant_id`,
            CONCAT(`PV`.`qty`, `PV`.`units`) `variant`,
            `PP`.`branchid` `branch`,
            `PP`.`price` `retail_price`,
            `P`.`gst` `tax`
        FROM
            `products` `P`
        LEFT JOIN
            `productvariant` `PV`
        ON
            `PV`.`productid` = `P`.`id`
        LEFT JOIN
            `productsprice` `PP`
        ON
            `PP`.`productid` = `P`.`id`  AND `PP`.`variantid` = `PV`.`id`
        WHERE
            `P`.`status` = 1
        AND
            `PP`.`branchid` = ?
        ORDER BY `PV`.`id`";

    public static function get_price_master($branch_id, $connection = null)
    {
        $price_master = array();
        $con_started = false;

        try {
            if (empty($connection)) {
                $connection = $con;

                if ($connection->connect_error) {
                    throw new \Exception("{$connection->connect_errno} : {$connection->connect_error}");
                }

                $con_started = true;
            }

            $price_master_query_stmt = $connection->prepare(BranchPrice::$price_master_branch_query);

            $price_master_query_stmt->bind_param("i", $branch_id);

            $price_master_query_stmt->execute();

            $result = $price_master_query_stmt->get_result();

            while ($data = $result->fetch_assoc()) {
                $product_id = $data["product_id"];
                $product_cat_id = $data["product_cat_id"];
                $branch = $data["branch"];
                $product_variant_id = $data["product_variant_id"];
                $product_cat = $data["product_cat"];
                $product_code = $data["product_code"];
                $product_name = $data["product_name"];
                $desc_short = $data["desc_short"];
                $desc = $data["desc"];
                $image = $data["image"];
                $sale_status = $data["sale_status"];
                $newold_status = $data["newold_status"];
                $hsn = $data["hsn"];
                $tag = $data["tag"];
                $variant = $data["variant"];
                $retail_price = $data["retail_price"];
                $tax = $data["tax"];

                $variant = array(
                    "id" => $product_variant_id,
                    "variant" => $variant,
                    "branch" => $branch,
                    "retail_price" => $retail_price,
                );

                if (!array_key_exists($product_id, $price_master)) {
                    $price_master[$product_id] = array(
                        "product_id" => $product_id,
                        "product_cat" => $product_cat,
                        "product_cat_id" => $product_cat_id,
                        "product_code" => $product_code,
                        "product_name" => $product_name,
                        "desc_short" => $desc_short,
                        "desc" => $desc,
                        "image" => $image,
                        "sale_status" => $sale_status,
                        "newold_status" => $newold_status,
                        "hsn" => $hsn,
                        "tag" => $tag,
                        "tax" => $tax,
                        "variants" => array(),
                    );
                }

                $price_master[$product_id]["variants"][$product_variant_id] = $variant;
            }
        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            if ($con_started) {
                $con->close();
            }
        }

        return $price_master;
    }
}
