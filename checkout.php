<?php
  ob_start();
  $pageTitle = 'Checkout Page';
  require "init.php";
  $maxbillId = getMaxBillId($db) + 1; 
  $cartID = GetCartIDFromBuyer($_SESSION["id"], $db)[0]['cartId'];
  $itemCount = 0;
  $result = 0;
  $cartitemgame = getNumberGameItems($db,$cartID); 
  $count = count($cartitemgame);
  $cnt = 0;
  for($i=0;$i<$count;$i++) {
    $cateName = getCategoryNameById($db, $cartitemgame[$i]['itemId']);
    $price = getPriceById($db, $cartitemgame[$i]['itemId']);
    if ($cateName != "GAME") {
        $itemCount = $itemCount + $cartitemgame[$i]['quantity'];
        $result = $result + $cartitemgame[$i]['quantity'] * $price['price'] * (1 - $price['discount']/100);
    }
  }  

  if (isset($_POST['done'])) {
    $_SESSION["firstname"] = "";
    $_SESSION["lastname"] = "";
    $_SESSION["isShip"] = "";
    $_SESSION["companyname"] = "";
    $_SESSION["address"] = "";
    $_SESSION["optional"] = "";
    $_SESSION["city"] = "";
    $_SESSION["coutry"] = "";
    $_SESSION["postcode"] = "";
    $_SESSION["email"] = "";
    $_SESSION['phone'] = "";
    $_SESSION['notes'] = "";
    $_SESSION['DBER'] = 0;
    //filter data

    $_SESSION["firstname"] = input_data($_POST['firstname']);
    $_SESSION["lastname"] = input_data($_POST['lastname']);
    $_SESSION["isShip"] = input_data($_POST['isShip']);
    $_SESSION["companyname"] = input_data($_POST['companyname']);
    $_SESSION["address"] = input_data($_POST['address']);
    $_SESSION["optional"] = input_data($_POST['optional']);
    $_SESSION["city"] = input_data($_POST['city']);
    $_SESSION["country"] = input_data($_POST['country']);
    $_SESSION["postcode"] = input_data($_POST['postcode']);
    $_SESSION["email"] = input_data($_POST['email']);
    $_SESSION['phone'] = input_data($_POST['phone']);
    $_SESSION['notes'] = input_data($_POST['notes']);
    $_SESSION['firstname_er'] = "";
    $_SESSION['lastname_er'] = "";
    $_SESSION["companyname_er"] = "";
    $_SESSION['address_er'] = "";
    $_SESSION["optional_er"] = "";
    $_SESSION["city_er"] = "";
    $_SESSION["country_er"] = "";
    $_SESSION["email_er"] = "";
    $_SESSION["phone_er"] = "";
    // updateTotalItems($_SESSION['childcategoryId'], $_SESSION['quantity_item'], $db);

    //validate title name
    if (strlen($_SESSION['firstname']) > 20) {
        $_SESSION['firstname_er'] = "* Title item is Longer 20 character";
    }
    if (strlen($_SESSION['lastname']) > 20) {
        $_SESSION['lastname_er'] = "* Title item is Longer 20 character";
    }
    //validate description
    if (strlen($_SESSION['companyname']) > 300) {
        $_SESSION['companyname_er'] = "* Description Item is Longer Than 300 character";
    }
    if (strlen($_SESSION['city_er']) > 30) {
        $_SESSION['city_er'] = "* City Name is Longer Than 30 character";
    }
    if (strlen($_SESSION['country_er']) > 30) {
        $_SESSION['country_er'] = "*Country Name is Longer Than 30 character";
    }

    if (strlen($_SESSION['address']) > 20) {
        $_SESSION['address_er'] = "* Title item is Longer 20 character";
    }
    if (strlen($_SESSION['optional']) > 20) {
        $_SESSION['optional_er'] = "* Title item is Longer 20 character";
    }
    //validate description
    if (strlen($_SESSION['email']) > 300) {
        $_SESSION['email_er'] = "* Description Item is Longer Than 300 character";
    }
    if (strlen($_SESSION['city_er']) > 30) {
        $_SESSION['phone_er'] = "* City Name is Longer Than 30 character";
    }

    
    for($i=0;$i<$count;$i++) {
        $cateName = getCategoryNameById($db, $cartitemgame[$i]['itemId']);
        if ($cateName != "GAME") {
            $orderPrice = $cartitemgame[$i]['quantity'] * $price['price'] * (1 - $price['discount']/100);
            insertOrder($cartID, $orderPrice, $cartitemgame[$i]['quantity'], $_SESSION["id"], $cartitemgame[$i]['itemId'], $_SESSION["isShip"], $maxbillId, $db);
            insertNotication($cartitemgame[$i]['itemId'], $_SESSION["id"],$orderPrice, $cartitemgame[$i]['quantity'],$db);
            deleteItemCart($cartID, $cartitemgame[$i]['itemId'], $db);
        }
      }      


    if ($_SESSION['firstname_er'] == "" && $_SESSION['lastname_er'] == "" && $_SESSION['companyname_er'] == "" && $_SESSION['address_er'] == "" && $_SESSION["optional_er"] == "" && $_SESSION["city_er"] == "" && $_SESSION["country_er"] == "" && $_SESSION["email_er"] == "" && $_SESSION["phone_er"] == "") {
        insertBill($cnt, $result, $cartID, $_SESSION['firstname'], $_SESSION['lastname'],$_SESSION['isShip'] , $_SESSION['companyname']
            , $_SESSION['address'], $_SESSION['optional'], $_SESSION['city'], $_SESSION['country'], $_SESSION['postcode'], $_SESSION['email'], $_SESSION['phone']
            , $_SESSION['notes'], $db);
            $_SESSION["firstname"] = "";
            $_SESSION["lastname"] = "";
            $_SESSION["isShip"] = "";
            $_SESSION["companyname"] = "";
            $_SESSION["address"] = "";
            $_SESSION["optional"] = "";
            $_SESSION["city"] = "";
            $_SESSION["coutry"] = "";
            $_SESSION["postcode"] = "";
            $_SESSION["email"] = "";
            $_SESSION['phone'] = "";
            $_SESSION['notes'] = "";
            $_SESSION['DBER'] = 1;
    } else {
        header("Location:checkout.php");
        return;

    }

    if ($_SESSION['DBER'] == 1) {
        $_SESSION["firstname"] = "";
        $_SESSION["lastname"] = "";
        $_SESSION["isShip"] = "";
        $_SESSION["companyname"] = "";
        $_SESSION["address"] = "";
        $_SESSION["optional"] = "";
        $_SESSION["city"] = "";
        $_SESSION["coutry"] = "";
        $_SESSION["postcode"] = "";
        $_SESSION["email"] = "";
        $_SESSION['phone'] = "";
        $_SESSION['notes'] = "";
        header("Location:cart.php?Ordersuccess=true");
        return;
    }
}
?>

    <main>
        <!-- checkout-area-start -->
        <section class="checkout-area pb-85">
            <div class="container">
                <form action="checkout.php" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkbox-form">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" placeholder="" name="firstname">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" placeholder="" name="lastname">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Company Name</label>
                                            <input type="text" placeholder="" name="companyname">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" placeholder="Street address" name="address">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <input type="text" placeholder="Apartment, suite, unit etc. (optional)" name="optional">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input type="text" placeholder="Town / City"  name="city">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>State / County <span class="required">*</span></label>
                                            <input type="text" placeholder="" name="country">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zip"  name="postcode">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input type="email" placeholder="" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zip" name="phone">
                                        </div>
                                    </div>

                                </div>
                                <div class="different-address">
                                    <div class="order-notes">
                                        <div class="checkout-form-list">
                                            <label>Order Notes</label>
                                            <textarea id="checkout-mess"  name="notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="your-order mb-30 ">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    Total Number Of Items <strong class="product-quantity"></strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount"><?php echo $itemCount ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount"><?php echo $result ?></span>$</strong>
                                                </td>
                                            </tr>
                                        <tfoot>
                                            <tr class="shipping">
                                                <th>Payment Method</th>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <input type="radio" name="isShip" value="0">
                                                            <label>
                                                                Pay Now: <span class="amount"><?php echo $result ?>$</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" name="isShip" value="1">
                                                            <label>Payment on delivery</label>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="payment-method">
                                    <div class="accordion" id="checkoutAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="checkoutOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bankOne" aria-expanded="true" aria-controls="bankOne">
                                            Direct Bank Transfer
                                            </button>
                                        </h2>
                                        <div id="bankOne" class="accordion-collapse collapse show" aria-labelledby="checkoutOne" data-bs-parent="#checkoutAccordion">
                                            <div class="accordion-body">
                                             <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="paymentTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment" aria-expanded="false" aria-controls="payment">
                                            Cheque Payment
                                            </button>
                                        </h2>
                                        <div id="payment" class="accordion-collapse collapse" aria-labelledby="paymentTwo" data-bs-parent="#checkoutAccordion">
                                            <div class="accordion-body">
                                            <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="paypalThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#paypal" aria-expanded="false" aria-controls="paypal">
                                            PayPal
                                            </button>
                                        </h2>
                                        <div id="paypal" class="accordion-collapse collapse" aria-labelledby="paypalThree" data-bs-parent="#checkoutAccordion">
                                            <div class="accordion-body">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                PayPal account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="order-button-payment mt-20">
                                        <button type="submit" name="done" class="tp-btn-h1">Place order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
<?php
include $tpl . "footer.php";
ob_end_flush(); ?>