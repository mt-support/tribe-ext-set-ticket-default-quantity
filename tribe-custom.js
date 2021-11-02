;( function ($) {
    var container = $('.tribe-events-tickets');
    var block_container = $('form#tribe-tickets');
    var v2Container = $('.tribe-tickets__tickets-form');

    var Tribe_Ticket_Qty = {
        init: function () {
            var self = this;
            if ( container.length ) {
                $inputs = container.find('input.tribe-tickets-quantity, .woocommerce .quantity input.qty, .edd.quantity input.edd-input');
                $inputs.val(1);
                $inputs.trigger('change');
            }

            if ( block_container.length ) {
                $inputs = block_container.find('input.tribe-tickets-quantity');
                $inputs.val(1);
                $inputs.trigger('change');
            }

            if ( v2Container.length ) {
                $( '.tribe-tickets__tickets-form .tribe-tickets__tickets-item-quantity-add' ).trigger( 'click' );
            }
        },

    };

    $( function () {
        Tribe_Ticket_Qty.init();
    } );

} ) ( jQuery );
