<?php
include '../p.php';
require_once "../../lib/encdec.php";

extract($_POST);
$user_id = $db->real_escape_string($id);
$status = $db->real_escape_string($status);

if ($status == "1") {
    // link generation
    $referral_code = "FRUBJIR_{$user_id}";

    $referral_link_base = "www.frubji.com/register.php?referral=";

    $encr_code = Utility\EncryptDecrypt::encrypt_data($referral_code);

    $referral_link = "{$referral_link_base}{$encr_code}";

    $referral_code_update_query = "UPDATE `representative` SET `referral_code` = '{$referral_code}', `referral_link` = '{$referral_link}' WHERE id = {$user_id}";

    $db->query($referral_code_update_query);
} else {
    $referral_code_remove_query = "UPDATE `representative` SET `referral_code` = NULL, `referral_link` = NULL WHERE id = {$user_id}";

    $db->query($referral_code_remove_query);
}

$sql = $db->query("UPDATE representative SET status='$status' WHERE id='$id'");

echo $sql;
//echo 1;
header('location:../allrepresentative.php');
