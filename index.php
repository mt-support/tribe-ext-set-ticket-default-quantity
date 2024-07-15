<?php
/**
 * Plugin Name:     Events Tickets Extension: Set default quantity of tickets to 1
 * Description:     An extension that Sets default quantity for tickets
 * Version:         1.2.0
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

    private static $version = '1.2.0';

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
     * Validates if the current post type is valid for ticketing.
     *
     * This function checks if the current post type is among the post types
     * managed by the Tribe Tickets plugin.
     *
     * @since 1.0.0
     *
     * @return bool True if the post type is valid, false otherwise.
     */
    function is_valid_post_type() {
        // Ensure the Tribe__Tickets__Main class exists before proceeding
        if ( ! class_exists( 'Tribe__Tickets__Main', false ) ) {
            return false;
        }

        // Get the current post type of the page
        $post_type = get_post_type();

        // Get the post types from the Tribe__Tickets__Main instance
        $valid_post_types = Tribe__Tickets__Main::instance()->post_types();

        // Check if the current post type is valid
        return in_array( $post_type, $valid_post_types );
    }
}
