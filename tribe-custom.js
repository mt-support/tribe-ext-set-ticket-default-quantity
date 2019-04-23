jQuery(document).ready( function ($) {
    // RSVP, Woo, and EDD tickets default to quantity of 1
    $( 'input.tribe-ticket-quantity, .woocommerce .quantity input.qty, .edd.quantity input.edd-input' ).val( 1 );

    //RSVP Trigger
    $('input.tribe-ticket-quantity, .quantity input, .quantity select').trigger('change');

    //TPP and Ticket form trigger
    $tickets_lists = $( '.tribe-events-tickets, .tribe-events-tickets-tpp' );
    $quantity_fields = $tickets_lists.find( '.quantity' ).find( '.qty, .edd-input' );

    $quantity_fields.trigger('change');
});