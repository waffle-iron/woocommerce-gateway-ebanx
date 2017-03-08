<?php

if (!defined('ABSPATH')) {
	exit;
}

class WC_VPD_XML_Interest_Calculator {
	/**
	 * Calculates the order total with interest
	 *
	 * @param  WC_Order $order       The order object
	 * @param  int      $instalments The installments number
	 * @return float
	 */
	public function calculate_total(WC_Order $order, $instalments) {
		$order_total = 0;

		foreach ($order->get_items() as $key => $value) {
			$wcproduct = new WC_Product($value['item_meta']['_product_id'][0]);
			$quantity = $value['item_meta']['_qty'][0];
			$product = $this->get_product_rates( $wcproduct->get_sku() );

			if (!$product) {
				return $wcproduct->get_display_price();
			}

			$interest_rate = $instalments > 4
				? $product->dezx // 5x ou mais
				: ( $instalments > 1
					? $product->quatrox // de 2x a 4x
					: $product->avista ); // a vista

			$base = (float) $product->boleto;
			$rate = (float) $interest_rate;
			$order_total += ( $base * ( 1 + $rate ) ) * $quantity;
		}

		return $order_total;
	}

	public function get_product_rates($sku)
	{
		$path = get_bloginfo( 'template_directory' ) . '/xml/' . 'sku_parques_pag.xml';
		$products = simplexml_load_file( $path );

		foreach ($products->elemento as $single) {
			if ($single->sku != $sku) {
				continue;
			}

			return $single;
		}

		return null;
	}
}
