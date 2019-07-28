;(function ($) {
    var wrapper = $('.tribe-events-tickets');

    var Tribe_Ticket_Qty = {
        init: function () {
            var self = this;
            // wrapper.find( 'input.tribe-ticket-quantity, .woocommerce .quantity input.qty, .edd.quantity input.edd-input' ).val(1);
            $inputs = wrapper.find('input.tribe-ticket-quantity');
            $inputs.val(1);
            $inputs.trigger('change');
        },

    };

    $(function () {
        Tribe_Ticket_Qty.init();
    });

})(jQuery);