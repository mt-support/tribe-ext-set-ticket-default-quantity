<?php
/**
 * Plugin Name:     Events Tickets Extension: Set default quantity of tickets to 1
 * Description:     An extension that Sets default quantity for tickets
 * Version:         1.1.0
 * Extension Class: Tribe__Extension__Set__Default__Ticket__QTY
 * Author:          Modern Tribe, Inc.
 * Author URI:      http://m.tri.be/1971
 * License:         GPLv2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 */

// Do not load directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

// Do not load unless Tribe Common is fully loaded.
if ( ! class_exists( 'Tribe__Extension' ) ) {
    return;
}

class Tribe__Extension__Set__Default__Ticket__QTY extends Tribe__Extension {

    private static $version = "1.1.0";

    /**
     * Setup the Extension's properties.
     *
     */
    public function construct() {
        $this->add_required_plugin( 'Tribe__Tickets__Main', '4.10.1' );
    }

    /**
     * Extension initialization and hooks.
     */
    public function init() {
        add_action( 'wp_enqueue_scripts', [ $this, 'set_default_quantity_for_tickets' ], 99 );
    }

    /**
     * Load the custom JS to set default
     *
     * @since 1.0.0
     *
     * @return void
     */
    function set_default_quantity_for_tickets() {

    	$load_js = apply_filters( 'tribe_ext_set_default_qty_load_js', $this->is_valid_post_type() );

    	if ( ! $load_js ) {
		    return;
	    }

        $src_file = plugins_url( 'tribe-custom.js', __FILE__ );

        wp_enqueue_script(
        	'tribe-custom-ticket-qty',
            $src_file,
            [ 'jquery', 'tribe-tickets-block' ],
            self::$version,
            true
        );
    }

	/**
	 * Check if the current post is a valid post type for tickets
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	function is_valid_post_type() {
		// bail out if not on a Single Event page.
		if ( ! is_single() ) {
			return false;
		}

		if ( ! class_exists( 'Tribe__Tickets__Main' ) ) {
			return false;
		}

		if ( ! in_array( get_post_type(), Tribe__Tickets__Main::instance()->post_types() ) ) {
			return false;
		}

		return true;
	}
}