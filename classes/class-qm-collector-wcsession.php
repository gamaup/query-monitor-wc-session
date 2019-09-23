<?php

class QM_Collector_WCSession extends QM_Collector {

	public $id = 'wc_session';

	public function name() {
		return __( 'WC Session', 'query-monitor' );
	}

	public function process() {
		$this->data = array(
			'session'	=> array(),
			'cart'		=> array()
		);
		if ( ! is_null( WC()->session ) ) {
			$session_data = WC()->session->get_session_data();
			$this->data['session'] = $this->maybe_unserialize_recursively( $session_data );
		}
		if ( ! is_null( WC()->cart ) ) {
			$cart_data = WC()->cart->get_cart();
			$this->data['cart'] = $this->maybe_unserialize_recursively( $cart_data );
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