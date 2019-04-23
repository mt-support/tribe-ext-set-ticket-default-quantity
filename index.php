<?php
/**
 * Plugin Name:     The Events Calendar Extension: Set default quantity of tickets to 1
 * Description:     An extension that Sets default quantity for tickets
 * Version:         1.0.0
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

    private static $version = "1.0.0";

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

        $src_file = plugins_url( 'tribe-custom.js', __FILE__ );

        wp_register_script( 'tribe-custom-ticket-qty',
            $src_file,
            array( 'jquery',
                   'event-tickets-tickets-rsvp-js',
                   'tribe_tickets_frontend_tickets',
                   'event-tickets-tpp-js'
            ),
            self::$version,
            true
        );

        add_action( 'wp_enqueue_scripts', array( $this, 'set_default_quantity_for_tickets' ), 999);
    }

    /**
     * Check if it's the Events single page and enqueue custom script
     *
     * @return bool
     */
    function set_default_quantity_for_tickets() {
        // bail out if not on a Single Event page
        if ( ! function_exists( 'tribe_is_event' ) || ! tribe_is_event() ) {
            return false;
        }

        wp_enqueue_script( 'tribe-custom-ticket-qty' );
    }

}