<div class="sidebar__content">
    <div id="order-summary" class="order-summary order-summary--is-collapsed" data-order-summary="">
        <h2 class="visually-hidden-if-js">Order summary</h2>

        <div class="order-summary__sections">
            <div class="order-summary__section order-summary__section--product-list">
                <div class="order-summary__section__content">
                    <table class="product-table">
                        <caption class="visually-hidden">Shopping cart</caption>
                        <thead>
                        <tr>
                            <th scope="col"><span class="visually-hidden">Product image</span></th>
                            <th scope="col"><span class="visually-hidden">Description</span></th>
                            <th scope="col"><span class="visually-hidden">Quantity</span></th>
                            <th scope="col"><span class="visually-hidden">Price</span></th>
                        </tr>
                        </thead>
                        <tbody data-order-summary-section="line-items">

                        <?php
                        foreach ($cart_data as $key => $value) {
                            ?>
                            <tr class="product" data-product-id="1400082104390" data-variant-id="12527646113862"
                                data-product-type="CBD Drops" data-customer-ready-visible="">
                                <td class="product__image">
                                    <div class="product-thumbnail">
                                        <div class="product-thumbnail__wrapper">
                                            <img alt="" class="product-thumbnail__image"
                                                 src="<?= $value['options']['product_img'] ?>">
                                        </div>
                                        <span class="product-thumbnail__quantity"
                                              aria-hidden="true"><?= $value['qty'] ?></span>
                                    </div>
                                </td>
                                <td class="product__description">
                                    <span
                                        class="product__description__name order-summary__emphasis"><?= $value['name'] ?></span>
                                    <span class="product__description__variant order-summary__small-text"></span>
                                </td>
                                <td class="product__quantity visually-hidden">
                                    1
                                </td>
                                <td class="product__price">
                                    <span
                                        class="order-summary__emphasis"><?= price(($value['price'] * $value['qty'])) ?> </span>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                        </tbody>
                    </table>
                    <div class="order-summary__scroll-indicator" aria-hidden="true" tabindex="-1">
                        Scroll for more items
                        <svg aria-hidden="true" focusable="false" class="icon-svg icon-svg--size-12">
                            <use xlink:href="#down-arrow"></use>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="order-summary__section order-summary__section--total-lines"
                 data-order-summary-section="payment-lines">
                <table class="total-line-table">
                    <caption class="visually-hidden">Cost summary</caption>
                    <thead>
                    <tr>
                        <th scope="col"><span class="visually-hidden">Description</span></th>
                        <th scope="col"><span class="visually-hidden">Price</span></th>
                    </tr>
                    </thead>
                    <tbody class="total-line-table__tbody">
                    <tr class="total-line total-line--subtotal">
                        <th class="total-line__name" scope="row">Subtotal</th>
                        <td class="total-line__price">
<span class="order-summary__emphasis">
<?= price($this->cart->total()) ?>
</span>
                        </td>
                    </tr>
                    <tr class="total-line total-line--shipping">
                        <th class="total-line__name" scope="row">Shipping</th>
                        <td class="total-line__price">
<span class="order-summary__small-text">
N/A
</span>
                        </td>
                    </tr>
                    <tr class="total-line total-line--taxes hidden" data-checkout-taxes="">
                        <th class="total-line__name" scope="row">Taxes</th>
                        <td class="total-line__price">
                            <span class="order-summary__emphasis" data-checkout-total-taxes-target="0">$0.00</span>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot class="total-line-table__footer">
                    <tr class="total-line">
                        <th class="total-line__name payment-due-label" scope="row">
                            <span class="payment-due-label__total">Total</span>
                        </th>
                        <td class="total-line__price payment-due">
                            <span class="payment-due__currency">USD</span>
<span class="payment-due__price">
<?= price($this->cart->total()) ?>
</span>
                        </td>
                    </tr>
                    </tfoot>
                </table>
                <div class="visually-hidden" aria-live="polite" aria-atomic="true" role="status">
                    Updated total price:
<span data-checkout-payment-due-target="6500">
$65.00
</span>
                </div>
            </div>
        </div>
    </div>
</div>