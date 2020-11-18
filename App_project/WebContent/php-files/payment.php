<?php
$email = $_GET["eid"];
session_start();
require_once ("dbcontroller.php");
$db_handle = new DBController();

?>

<html>
<head>
<TITLE>Shopping Cart</TITLE>
<link rel="stylesheet" type="text/css" href="../style-sheet/style.css" />

<link rel="stylesheet" type="text/css"
	href="../style-sheet/payment-style.css" />
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css"
	href="../style-sheet/htmlfooter.css" />
<script type="text/javascript" src="../myScript.js"></script>
</head>
<body>
	<div id="shopping-cart">
		<a href="logout.php" id="logouticon"><img src="../images/signout.jpg"
			alt="logout" /></a>

  <?php
if (isset($_SESSION["cart_product"])) {
    $total_quantity = 0;
    $total_price = 0;
    ?>	
<h3>Review Order</h3>
		<table class="tbl-cart" cellpadding="10" cellspacing="1">
			<tbody>
				<tr>
					<th style="text-align: left;">Name</th>

					<th>Quantity</th>
					<th>Unit Price</th>
					<th style="text-align: right; width: 10%">Price</th>

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

				</tr>
				<?php
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"] * $item["quantity"]);
    }
    ?>

<tr>
					<td align="right">Total:</td>
					<td align="right"><?php echo $total_quantity; ?></td>
					<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>

				</tr>
			</tbody>
		</table>

		<div class="contain">

			<div class="wrapper">
				<div class="contacts">
					<h3>Contacts us</h3>

					<ul>
						<li>SYS_OL</li>
						<li>+1 292 111 1111</li>
						<li>mycart@gmail.com</li>
					</ul>
				</div>

				<div class="form">
					<h3>Shipping Address</h3>
					<form method="post" action=" mail.php?eid=<?php echo $email; ?>">

						<p>
							<label>Full Name</label> <input type="text" id="fn" required />
						</p>
						<p>
							<label>Email Address</label> <input type="email" id="eil"
								value="<?php echo "$email" ?>" required>
						</p>
						<p>
							<label>Mobile Number</label> <input type="text" pattern="\d*" id="mn"
								maxlength="10" required />
						</p>
						<p>
							<label>Adress Line</label> <input type="text" id="al" required />
						</p>
						<p>
							<label>Zip Code</label> <input type="text" pattern="\d*" id="zc"
								maxlength="5" required>
						</p>
						<p>
							<label>State</label> <input type="text" id="st" required>
						</p>

						<h3>Payment Option</h3>
						<p></p>
						<p>
							<label>Name on card</label> <input type="text" id="nca" required>
						</p>
						<p>
							<label>Credit card number</label> <input type="text" pattern="\d*" maxlength="3" SSSSid="ccno"
								required>
						</p>

						<p>
							<label for="txtList">Exp Month:</label> <input type="text"
								placeholder="Select a month" list="months" id="mnt" required />
							<datalist id="months">
								<option value="01">
								
								
								<option value="02">
								
								
								<option value="03">
								
								
								<option value="04">
								
								
								<option value="05">
								
								
								<option value="06">
								
								
								<option value="07">
								
								
								<option value="08">
								
								
								<option value="09">
								
								
								<option value="10">
								
								
								<option value="11">
								
								
								<option value="12">
							
							</datalist>
						</p>
						<p>
							<label>Exp Year </label> <input type="text" pattern="\d*" id="ey"
								maxlength="4" required />
						</p>
						<p>
							<label>CVV </label> <input type="text" pattern="\d*" id="cvv" maxlength="3"
								required />
						</p>

						<button id="paybtn" class="paybtn">Pay</button>


					</form>

				</div>
			</div>
		</div>

		

<?php
}
?>
</div>
	<footer id="footer"></footer>
	</div>


</body>
</html>