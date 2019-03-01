<?php

class QM_Collector_WCSession extends QM_Collector {

	public $id = 'wc_session';

	public function name() {
		return __( 'WC Session', 'query-monitor' );
	}

	public function process() {
		global $woocommerce;
		if ( ! is_null( $woocommerce->session ) ) {
			$session_data = $woocommerce->session->get_session_data();
			$this->data = $this->maybe_unserialize_recursively( $session_data );
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