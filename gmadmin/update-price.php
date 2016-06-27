<?php
session_start();
require_once '../class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$lpgCylinderPrice = floatval(trim($_POST['txtlpgprice']));
$vatPercentage = floatval(trim($_POST['txtVatPercentage']));
$shippingCharge = floatval(trim($_POST['txtShippingCost']));	

$lpgUpdate = $user_home->runQuery("UPDATE tbl_product_prices SET gas_unit_price=:lpg_cylinder_price, vat_percent=:vat_percentage, shipping_cost=:shipping_charge WHERE 1");
$lpgUpdate->execute(array(":lpg_cylinder_price"=>$lpgCylinderPrice, ":vat_percentage"=>$vatPercentage, ":shipping_charge"=>$shippingCharge));

$user_home->redirect('dashboard.php?status=success');

?>

