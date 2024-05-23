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
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">First Name <span class="required">*</span></label>
                                            <input style = "font-family:candara;letter-spacing: 0.05em;"type="text" placeholder="" name="firstname" value="<?php echo $bill[0]['firstname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">Last Name <span class="required">*</span></label>
                                            <input style = "font-family:candara;letter-spacing: 0.05em;"type="text" placeholder="" name="lastname" value="<?php echo $bill[0]['lastname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">Company Name</label>
                                            <input style = "font-family:candara;letter-spacing: 0.05em;"type="text" placeholder="" name="companyname" value="<?php echo $bill[0]['companyname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">Address <span class="required">*</span></label>
                                            <input style = "font-family:candara;letter-spacing: 0.05em;"type="text" placeholder="Street address" name="address" value="<?php echo $bill[0]['address'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <input style = "font-family:candara;letter-spacing: 0.05em;"type="text" placeholder="Apartment, suite, unit etc. (optional)" name="optional" value="<?php echo $bill[0]['optional'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">Town / City <span class="required">*</span></label>
                                            <input style = "font-family:candara;letter-spacing: 0.05em;"type="text" placeholder="Town / City"  name="city" value="<?php echo $bill[0]['city'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">State / County <span class="required">*</span></label>
                                            <input style = "font-family:candara;letter-spacing: 0.05em;" type="text" placeholder="" name="country" value="<?php echo $bill[0]['country'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">Postcode / Zip <span class="required">*</span></label>
                                            <input style = "font-family:candara;letter-spacing: 0.05em;"type="text" placeholder="Postcode / Zip"  name="postcode" value="<?php echo $bill[0]['postcode'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">Email Address <span class="required">*</span></label>
                                            <input style = "font-family:candara;letter-spacing: 0.05em;"type="email" placeholder="" name="email" value="<?php echo $bill[0]['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">Phone <span class="required">*</span></label>
                                            <input style = "font-family:candara;letter-spacing: 0.05em;"type="text" placeholder="Postcode / Zip" name="phone" value="<?php echo $bill[0]['phone'] ?>">
                                        </div>
                                    </div>

                                </div>
                                <div class="different-address">
                                    <div class="order-notes">
                                        <div class="checkout-form-list">
                                            <label style = "font-family:candara;letter-spacing: 0.05em;">Order Notes</label>
                                            <textarea style = "font-family:candara;letter-spacing: 0.05em;"id="checkout-mess"  name="notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery." value="<?php echo $bill[0]['notes'] ?>"></textarea>
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
                                                <th style = "font-family:candara;letter-spacing: 0.05em;"class="product-name">Product</th>
                                                <th style = "font-family:candara;letter-spacing: 0.05em;"class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="cart_item">
                                                <td style = "font-family:candara;letter-spacing: 0.05em;"class="product-name">
                                                    Items <strong class="product-quantity"></strong>
                                                </td>
                                                <td style = "font-family:candara;letter-spacing: 0.05em;"class="product-total">
                                                    <span style = "font-family:candara;letter-spacing: 0.05em;" class="amount"><?php echo $itemName; ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                            <tr style = "font-family:candara;letter-spacing: 0.05em;"class="shipping">
                                                <th style = "font-family:candara;letter-spacing: 0.05em;">Payment Method</th>
                                                <td>
                                                    <ul>
                                                        <?php if($bill[0]['isShip'] == 0): ?>
                                                        <li>
                                                            <label style = "font-family:candara;letter-spacing: 0.05em;">
                                                                Pay Now: <span class="amount">$</span>
                                                            </label>
                                                        </li>
                                                        <?php else: ?>
                                                        <li>
                                                            <label style = "font-family:candara;letter-spacing: 0.05em;">Payment on delivery</label>
                                                        </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="order-button-payment mt-20">
                                    <button style = "font-family:candara;letter-spacing: 0.05em;" onclick="window.history.back()" type="submit" class="tp-btn-h1">RETURN</button>
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