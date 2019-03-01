<?php
/**
 * Plugin Name: Query Monitor: WC Session Inspector
 * Description: Shows the content of wc session
 * Version: 1.0
 * Author: gamaup
 * GitHub Plugin URI: khromov/wp-query-monitor-included-files
 */

add_action('plugins_loaded', function() {
	/**
	 * Register collector, only if Query Monitor is enabled.
	 */
	if(class_exists('QM_Collectors')) {
		include 'classes/class-qm-collector-wcsession.php';
		QM_Collectors::add( new QM_Collector_WCSession() );
	}
	/**
	 * Register output. The filter won't run if Query Monitor is not
	 * installed so we don't have to explicity check for it.
	 */
	add_filter( 'qm/outputter/html', function(array $output, QM_Collectors $collectors) {
		include 'classes/class-qm-output-wcsession.php';
		if ( $collector = QM_Collectors::get( 'wc_session' ) ) {
			$output['wc_session'] = new QM_Output_WCSession( $collector );
		}
		return $output;
	}, 101, 2 );
});