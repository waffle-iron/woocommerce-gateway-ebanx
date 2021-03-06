<?php
/**
 * Credit Card - Payment processed.
 *
 * @author  EBANX.com
 * @package WooCommerce_EBANX/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<p><strong><?php _e(sprintf('Seu pagamento foi confirmado, %s.', $customer_name), 'woocommerce-gateway-ebanx') ?></strong></p>
<p><strong><?php _e('Resumo da compra:', 'woocommerce-gateway-ebanx') ?></strong></p>
<p><?php _e('Valor:', 'woocommerce-gateway-ebanx') ?> <?php echo $order_total ?></p>
<?php if ($instalments_number > 1) : ?>
    <p><?php echo $instalments_number ?> <?php _e('parcelas de', 'woocommerce-gateway-ebanx') ?> <?php echo $order_currency ?> <?php echo $instalments_amount ?></p>
<?php else : ?>
    <p><?php _e('Pagamento à vista', 'woocommerce-gateway-ebanx') ?></p>
<?php endif; ?>
<p><?php _e(sprintf('Pago com Cartão %s:', ucwords($card_brand_name)), 'woocommerce-gateway-ebanx') ?> <?php echo $masked_card ?></p>
<p><?php _e('Obrigado por ter comprado conosco.', 'woocommerce-gateway-ebanx') ?></p>
