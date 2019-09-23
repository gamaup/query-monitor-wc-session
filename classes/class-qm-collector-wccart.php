<?php

class QM_Collector_WCCart extends QM_Collector {

	public $id = 'wc_cart';

	public function name() {
		return __( 'WC Cart Items', 'query-monitor' );
	}

	public function process() {
		if ( ! is_null( WC()->cart ) ) {
			$cart_data = WC()->cart->get_cart();
			$this->data = $this->maybe_unserialize_recursively( $cart_data );
		} else {
			$this->data = array();
		}
	}

	private function maybe_unserialize_recursively( $maybe_array = '' ) {
		$array = maybe_unserialize( $maybe_array );
		if ( is_array( $array ) ) {
			foreach ( $array as $key => $value ) {
				$array[ $key ] = $this->maybe_unserialize_recursively( $value );
			}
		}
		return $array;
	}

}