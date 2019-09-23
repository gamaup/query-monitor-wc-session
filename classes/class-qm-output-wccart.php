<?php
/**
 * Output class
 *
 * Class QM_Output_IncludedFiles
 */
class QM_Output_WCCart extends QM_Output_Html {

	public function __construct( QM_Collector $collector ) {
		parent::__construct( $collector );
		add_filter( 'qm/output/menus', array( $this, 'admin_menu' ), 101 );
		add_filter( 'qm/output/title', array( $this, 'admin_title' ), 101 );
		add_filter( 'qm/output/menu_class', array( $this, 'admin_class' ) );
	}

	/**
	 * Outputs data in the footer
	 */
	public function output() {
		$data = $this->collector->get_data();
		echo '<div class="qm qm-non-tabular" id="qm-wc_cart" role="group" aria-labelledby="qm-wc_cart-caption"><div class="qm-boxed">';
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		echo '</div></div>';
	}

	/**
	 * Adds data to top admin bar
	 *
	 * @param array $title
	 *
	 * @return array
	 */
	public function admin_title( array $title ) {
		$data = $this->collector->get_data();
		// $title[] = sprintf(
		// 	_x( '%s<small>F</small>', 'number of included files', 'query-monitor' ),
		// 	$data['included_files_number']
		// );
		return $title;
	}

	/**
	 * @param array $class
	 *
	 * @return array
	 */
	public function admin_class( array $class ) {
		$class[] = 'qm-wc_cart';
		return $class;
	}

	public function admin_menu( array $menu ) {
		$data = $this->collector->get_data();
		$menu[] = $this->menu( array(
			'id'    => 'qm-wc_cart',
			'href'  => '#qm-wc_cart',
			'title' => __( 'WC Cart Items', 'query-monitor' )
		));
		return $menu;
	}
}