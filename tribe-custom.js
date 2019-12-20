;(function ($) {
    var container = $('.tribe-events-tickets');
    var block_container = $('form#tribe-tickets');

    var Tribe_Ticket_Qty = {
        init: function () {
            var self = this;
            // wrapper.find( 'input.tribe-ticket-quantity, .woocommerce .quantity input.qty, .edd.quantity input.edd-input' ).val(1);
            if (container.length) {
                $inputs = container.find('input.tribe-ticket-quantity, .woocommerce .quantity input.qty, .edd.quantity input.edd-input');
                $inputs.val(1);
                $inputs.trigger('change');
            }

            if (block_container.length) {
                $inputs = block_container.find('input.tribe-tickets-quantity');
                $inputs.val(1);
                $inputs.trigger('change');
            }
        },

    };

    $(function () {
        Tribe_Ticket_Qty.init();
    });

})(jQuery);