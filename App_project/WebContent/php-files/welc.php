<?php
$email = $_GET["eid"];
session_start();
require_once ("dbcontroller.php");
$db_handle = new DBController();

if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (! empty($_POST["quantity"])) {
                $getProductCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
                $totalItems = array(
                    $getProductCode[0]["code"] => array(
                        'name' => $getProductCode[0]["name"],
                        'code' => $getProductCode[0]["code"],
                        'quantity' => $_POST["quantity"],
                        'price' => $getProductCode[0]["price"],
                        'image' => $getProductCode[0]["image"]
                    )
                );

                if (! empty($_SESSION["cart_product"])) {
                    if (in_array($getProductCode[0]["code"], array_keys($_SESSION["cart_product"]))) {
                        foreach ($_SESSION["cart_product"] as $k => $v) {
                            if ($getProductCode[0]["code"] == $k) {
                                if (empty($_SESSION["cart_product"][$k]["quantity"])) {
                                    $_SESSION["cart_product"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_product"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_product"] = array_merge($_SESSION["cart_product"], $totalItems);
                    }
                } else {
                    $_SESSION["cart_product"] = $totalItems;
                }
            }
            break;
        case "remove":
            if (! empty($_SESSION["cart_product"])) {
                foreach ($_SESSION["cart_product"] as $k => $v) {
                    if ($_GET["code"] == $k)
                        unset($_SESSION["cart_product"][$k]);
                    if (empty($_SESSION["cart_product"]))
                        unset($_SESSION["cart_product"]);
                }
            }
            break;
    }
}
if (isset($_POST['emptycart'])) {
    makeEmptyCart();
}

function makeEmptyCart()
{
    unset($_SESSION["cart_product"]);
}

?>

<html>
<head>
<title>Shopping Cart</title>
<link rel="stylesheet" type="text/css" href="../style-sheet/style.css" />
<link rel="stylesheet" type="text/css"
	href="../style-sheet/htmlfooter.css" />
<link rel="stylesheet" type="text/css"
	href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
	integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
	crossorigin="anonymous" />
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../myScript.js"></script>
</head>

<body>

	<div id="page-container">
		<div class="container-bg">
			<div id="content-wrap">
				<div id="shopping-cart">
					<a href="logout.php" id="logouticon"><img
						src="../images/signout.jpg" alt="logout" /></a> <img id="crtImg"
						src="../images/cart.png" alt="cart" onclick="openNav()" />
					<div id="mySidenav" class="sidenav">

						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <?php
if (isset($_SESSION["cart_product"])) {
    $total_quantity = 0;
    $total_price = 0;
    ?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
							<tbody>
								<tr>
									<th style="text-align: left;">Name</th>

									<th>Quantity</th>
									<th>Unit Price</th>
									<th style="text-align: right; width: 10%">Price</th>
									<th>Remove</th>
								</tr>	
<?php
    foreach ($_SESSION["cart_product"] as $item) {
        $item_price = $item["quantity"] * $item["price"];
        ?>
				<tr>
									<td><img src="<?php echo $item["image"]; ?>"
										class="cart-item-image" /><?php echo $item["name"]; ?></td>

									<td><?php echo $item["quantity"]; ?></td>
									<td style="text-align: left; width: 30%"><?php echo "$ ".$item["price"]; ?></td>
									<td style="text-align: left; width: 30%"><?php echo "$ ". number_format($item_price,2); ?></td>
									<td><a
										href="welc.php?eid=<?php echo $email ?>&action=remove&code=<?php echo $item["code"]; ?>"
										class="btnRemoveAction"><img src="../images/icon-delete.png"
											alt="Remove Item" /></a></td>
								</tr>
				<?php
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"] * $item["quantity"]);
    }
    ?>

<tr>
									<td colspan="1" align="right">Total:</td>
									<td align="right"><?php echo $total_quantity; ?></td>
									<td align="right" colspan="3"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>

								</tr>
							</tbody>
						</table>
						<a href="payment.php?eid=<?php echo $email; ?>" class="chkbtn">Check
							Out</a>


						<form method="post">
							<input type="submit" name="emptycart" id="btnEmpty"
								value="Empty Cart" />
						</form>

  <?php
} else {
    ?>
<div class="no-records">Your Cart is Empty</div>
<?php
}
?>
</div>

				</div>

				<div id="product-grid">
					<div class="txt-heading">Products</div>
	<?php
$product_array = $db_handle->runQuery("SELECT * FROM tblproduct");
if (! empty($product_array)) {
    foreach ($product_array as $key => $value) {
        ?>
		<div class="product-item">
						<form method="post"
							action="welc.php?eid=<?php echo $email ?>&action=add&code=<?php echo $product_array[$key]["code"]; ?>">
							<div class="product-image">
								<img src="<?php echo $product_array[$key]["image"]; ?>">
							</div>
							<div class="product-tile-footer">
								<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
								<div class="product-price">price :<?php echo "$".$product_array[$key]["price"]; ?></div>
								<div class="cart-action">
									<input type="text" class="product-quantity" name="quantity"
										value="1" size="2" />
									<p>
										<input type="submit" value="Add to Cart" class="btnAddAction" />
									</p>
								</div>
							</div>
						</form>
					</div>
	<?php
    }
}

?>

</div>
			</div>
		</div>
		<footer id="footer"> </footer>

	</div>
</body>
</html>

