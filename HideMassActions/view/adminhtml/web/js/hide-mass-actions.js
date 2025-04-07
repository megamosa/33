define([
    'jquery',
    'mage/translate'
], function ($) {
    'use strict';

    return {
        /**
         * Hide mass actions based on permissions
         */
        hideMassActions: function() {
            // Hide mass action dropdown options
            $('#sales_order_grid_massaction-select option').each(function() {
                var $option = $(this);
                var actionValue = $option.val();
                
                // List of actions to potentially hide
                var restrictedActions = [
                    'cancel', 'hold', 'unhold', 
                    'pdfinvoices', 'pdfshipments', 
                    'printshippinglabel'
                ];

                // Check if current option matches any restricted action
                if (restrictedActions.some(action => actionValue.includes(action))) {
                    $option.hide();
                }
            });

            // Hide mass action buttons
            $('.action-menu-item').each(function() {
                var $actionItem = $(this);
                var actionLabel = $actionItem.data('label');
                
                // List of labels to potentially hide
                var restrictedLabels = [
                    'Cancel', 'Hold', 'Unhold', 
                    'Print Invoices', 'Print Packing Slips', 
                    'Print Shipping Labels'
                ];

                // Check if current label matches any restricted label
                if (restrictedLabels.some(label => actionLabel.includes(label))) {
                    $actionItem.hide();
                }
            });
        },

        /**
         * Initialize the module
         */
        init: function() {
            $(document).ready(this.hideMassActions.bind(this));
        }
    };
});