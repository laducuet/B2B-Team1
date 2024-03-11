<?php
  ob_start();
  $pageTitle = 'Checkout Page';
  require "init.php";
  $cartID = GetCartIDFromBuyer($_GET['buyerId'], $db)[0]['cartId'];
  $bill = getBill($db, $cartID, $_GET['billId']);
  $itemName = GetItemByID($_GET['itemid'], $db)[0]['title'];
?>
<?php if(isset($_GET['keyword'])): ?>
					<?php if ($inputSearchError) :?>
					<p class="alert-danger ms-auto me-auto pt-5 pb-5" style="width:50%">Enter a valid value!</p>
					<?php elseif(($noItemsSearch)): ?>
					<p class="alert-danger ms-auto me-auto pt-5 pb-5" style="width:50%">No items match this word
						<?php echo " " .$_GET['keyword']; ?> </p>
					<?php elseif($noItems): ?>
					<p class="alert-danger ms-auto me-auto pt-5 pb-5" style="width:50%">No items in this Category</p>
					<?php else: ?>
						<?php header("Location: searchItem.php?keyword=".$_GET['keyword']); ?>
					<?php endif ?>
          <?php endif ?>

    <main>
        <!-- checkout-area-start -->
        <section class="checkout-area pb-85">
            <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkbox-form">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" placeholder="" name="firstname" value="<?php echo $bill[0]['firstname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" placeholder="" name="lastname" value="<?php echo $bill[0]['lastname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Company Name</label>
                                            <input type="text" placeholder="" name="companyname" value="<?php echo $bill[0]['companyname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" placeholder="Street address" name="address" value="<?php echo $bill[0]['address'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <input type="text" placeholder="Apartment, suite, unit etc. (optional)" name="optional" value="<?php echo $bill[0]['optional'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input type="text" placeholder="Town / City"  name="city" value="<?php echo $bill[0]['city'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>State / County <span class="required">*</span></label>
                                            <input type="text" placeholder="" name="country" value="<?php echo $bill[0]['country'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zip"  name="postcode" value="<?php echo $bill[0]['postcode'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input type="email" placeholder="" name="email" value="<?php echo $bill[0]['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zip" name="phone" value="<?php echo $bill[0]['phone'] ?>">
                                        </div>
                                    </div>

                                </div>
                                <div class="different-address">
                                    <div class="order-notes">
                                        <div class="checkout-form-list">
                                            <label>Order Notes</label>
                                            <textarea id="checkout-mess"  name="notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery." value="<?php echo $bill[0]['notes'] ?>"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="your-order mb-30 ">
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
                                                    Items <strong class="product-quantity"></strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount"><?php echo $itemName; ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                            <tr class="shipping">
                                                <th>Payment Method</th>
                                                <td>
                                                    <ul>
                                                        <?php if($bill[0]['isShip'] == 0): ?>
                                                        <li>
                                                            <label>
                                                                Pay Now: <span class="amount">$</span>
                                                            </label>
                                                        </li>
                                                        <?php else: ?>
                                                        <li>
                                                            <label>Payment on delivery</label>
                                                        </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="order-button-payment mt-20">
                                    <button onclick="window.history.back()" type="submit" class="tp-btn-h1">RETURN</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </main>
<?php
include $tpl . "footer.php";
ob_end_flush(); ?>