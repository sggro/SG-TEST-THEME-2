;(function($, window) {
    'use strict';

    $.plugin('swagPayPalUnifiedInContextCheckout', {
        defaults: {
            /**
             * Depending on the mode, the library will load the PSP from different locations. live will
             * load it from paypal.com whereas sandbox will load it from sandbox.paypal.com. The
             * library will also emit warning to the console if the mode is sandbox (in live mode it will
             * do so only for required parameters).
             *
             * Available modes:
             *  - production
             *  - sandbox
             *
             * @type string
             */
            paypalMode: 'production',

            /**
             * label of the button
             * possible values:
             *  - buynow
             *  - checkout
             *  - credit
             *  - pay
             *
             * @type string
             */
            label: 'buynow',

            /**
             * show PayPal branding
             *
             * @type boolean
             */
            branding: true,

            /**
             * show text under the button
             *
             * @type boolean
             */
            tagline: false,

            /**
             * size of the button
             * possible values:
             *  - small
             *  - medium
             *  - large
             *  - responsive
             *
             * @type string
             */
            size: 'medium',

            /**
             * shape of the button
             * possible values:
             *  - pill
             *  - rect
             *
             * @type string
             */
            shape: 'rect',

            /**
             * color of the button
             * possible values:
             *  - gold
             *  - blue
             *  - silver
             *  - black
             *
             * @type string
             */
            color: 'gold',

            /**
             * The language ISO (ISO_639) for the payment wall.
             *
             * @type string
             */
            paypalLanguage: 'en_US',

            /**
             * selector for the checkout confirm form element
             *
             * @type string
             */
            confirmFormSelector: '#confirm--form',

            /**
             * selector for the submit button of the checkout confirm form
             *
             * @type string
             */
            confirmFormSubmitButtonSelector: ':submit[form="confirm--form"]',

            /**
             * selector for the sAgb Checkbox
             *
             * @type string
             */
            agbSelector: '#sAGB',

            /**
             * The selector for the indicator whether the PayPal javascript is already loaded or not
             *
             * @type string
             */
            paypalScriptLoadedSelector: 'paypal-checkout-js-loaded',

            /**
             * This page will be opened when the payment creation fails.
             *
             * @type string
             */
            paypalErrorPage: '',

            /**
             * The URL called, when the payment should be created
             *
             * @type string
             */
            checkoutPaymentUrl: ''
        },

        /**
         * @type {Object}
         */
        inContextCheckoutButton: null,

        init: function() {
            var me = this;
            me.shouldRun = false;

            me.applyDataAttributes();

            me.$form = $(me.opts.confirmFormSelector);
            me.hideConfirmButton();
            me.disableConfirmButton();
            me.createButton();

            $.publish('plugin/swagPayPalUnifiedInContextCheckout/init', me);
        },

        /**
         * Hides the confirm button
         * It should not be removed completely from the DOM, because is used to trigger HTML5 form validation
         */
        hideConfirmButton: function() {
            var me = this;

            me.$confirmButton = $(me.opts.confirmFormSubmitButtonSelector);
            me.$confirmButton.addClass('is--hidden');

            $.publish('plugin/swagPayPalUnifiedInContextCheckout/hideConfirmButton', [me, me.$confirmButton]);
        },

        /**
         * Disables the submit function, because in some browsers the submit event is triggered,
         * even though the form is not valid
         */
        disableConfirmButton: function() {
            var me = this;

            me._on(me.$form, 'submit', $.proxy(me.onConfirmCheckout, me));
        },

        /**
         * @param {Event} event
         */
        onConfirmCheckout: function(event) {
            event.preventDefault();
        },

        /**
         * Creates the PayPal express checkout button with the loaded PayPal javascript
         */
        createButton: function() {
            var me = this,
                paypalScriptUrl = 'https://www.paypalobjects.com/api/checkout.min.js',
                $head = $('head');

            if (me.opts.paypalMode === 'sandbox') {
                paypalScriptUrl = 'https://www.paypalobjects.com/api/checkout.js';
            }

            if (!$head.data(me.opts.paypalScriptLoadedSelector)) {
                $.ajax({
                    url: paypalScriptUrl,
                    dataType: 'script',
                    cache: true,
                    success: function() {
                        $head.data(me.opts.paypalScriptLoadedSelector, true);
                        me.renderButton();
                    }
                });
            } else {
                me.renderButton();
            }
        },

        /**
         * Renders the ECS button
         */
        renderButton: function() {
            var me = this;

            // wait for the PayPal javascript to be loaded
            me.buffer(function() {
                me.inContextCheckoutButton = paypal.Button.render(me.createPayPalButtonConfiguration(), me.$el.get(0));

                $.publish('plugin/swagPayPalUnifiedInContextCheckout/createButton', [me, me.inContextCheckoutButton]);
            });
        },

        /**
         * Creates the configuration for the button
         *
         * @return {Object}
         */
        createPayPalButtonConfiguration: function() {
            var me = this,
                config;

            config = {
                /**
                 * environment property of the button
                 */
                env: me.opts.paypalMode,

                /**
                 * styling of the button
                 */
                style: {
                    label: me.opts.label,
                    branding: me.opts.branding,
                    tagline: me.opts.tagline,
                    size: me.opts.size,
                    shape: me.opts.shape,
                    color: me.opts.color
                },

                locale: me.opts.paypalLanguage,

                /**
                 * listener for custom validations
                 */
                validate: $.proxy(me.onValidate, me),

                /**
                 * on click listener for the button
                 */
                onClick: $.proxy(me.onButtonClick, me),

                /**
                 * listener for the button
                 */
                payment: $.proxy(me.onPayPalPayment, me),

                /**
                 * only needed for overlay solution
                 * called if the customer accepts the payment
                 */
                onAuthorize: $.proxy(me.onPayPalAuthorize, me)
            };

            $.publish('plugin/swagPayPalUnifiedInContextCheckout/createConfig', [me, config]);

            return config;
        },

        /**
         * adds a listener to the checkout confirm form to check its validity
         * enables or disables the paypal checkout button
         *
         * @param {Object} actions
         */
        onValidate: function(actions) {
            var me = this;

            me.$form.on('change', function() {
                if (me.checkFormValidity()) {
                    $.publish('plugin/swagPayPalUnifiedInContextCheckout/formValid', [me, actions]);

                    return actions.enable();
                }

                $.publish('plugin/swagPayPalUnifiedInContextCheckout/formInValid', [me, actions]);

                return actions.disable();
            });

            // If-Statement is required since we don´t want Validation on Load
            if (me.shouldRun) {
                if (!me.checkFormValidity()) {
                    $.publish('plugin/swagPayPalUnifiedInContextCheckout/formInValid', [me, actions]);

                    return actions.disable();
                }

                $.publish('plugin/swagPayPalUnifiedInContextCheckout/formValid', [me, actions]);

                return actions.enable();
            }

            me.shouldRun = true;

            // if sAGB Checkbox exists return disable as default because a checkbox can´t be checked on load
            if ($(me.opts.agbSelector).length > 0) {
                $.publish('plugin/swagPayPalUnifiedInContextCheckout/formInValid', [me, actions]);

                return actions.disable();
            }

            $.publish('plugin/swagPayPalUnifiedInContextCheckout/formValid', [me, actions]);

            return actions.enable();
        },

        /**
         * validates the checkout confirm form
         *
         * @return {boolean}
         */
        checkFormValidity: function() {
            var me = this,
                form = me.$form.get(0),
                isFormValid = form.checkValidity();

            $.publish('plugin/swagPayPalUnifiedInContextCheckout/checkFormValidity', [me, isFormValid, me.$form]);

            return isFormValid;
        },

        /**
         * called if the paypal button is clicked
         * clicks the hidden confirm button to trigger the HTML5 validation of the checkout confirm form
         */
        onButtonClick: function() {
            var me = this;

            if (!me.checkFormValidity()) {
                me.$confirmButton.trigger('click');
            }
        },

        /**
         * Callback method for the "payment" function of the button.
         * Calls an action which creates the payment and redirects to the paypal page.
         *
         * @return {string}
         */
        onPayPalPayment: function() {
            var me = this,
                redirectUrl = me.opts.paypalErrorPage;

            $('<input>', {
                type: 'hidden',
                name: 'useInContext',
                value: true
            }).appendTo(me.$form);

            $.publish('plugin/swagPayPalUnifiedInContextCheckout/beforeCreatePayment', [me, me.$form]);

            return me.processPayment().then(function(response) {
                if (response.errorCode) {
                    redirectUrl = me.stripErrorCodeFromUrl(redirectUrl) + response.errorCode;
                    $(location).attr('href', redirectUrl);
                }
                $.publish('plugin/swagPayPalUnifiedInContextCheckout/paymentCreated', [me, response]);
                return response.paymentId;
            });
        },

        /**
         * calls the checkout confirm form URL with ajax and returns it as promise
         * With this solution the Shopware logic is not avoided
         *
         * @return {Object}
         */
        processPayment: function() {
            var me = this,
                url = me.opts.checkoutPaymentUrl,
                method = me.$form.attr('method'),
                data = me.$form.serialize();

            $.publish('plugin/swagPayPalUnifiedInContextCheckout/beforeAjax', [me, url, method, data]);

            return $.ajax({
                url: url,
                method: method,
                data: data,
                error: $.proxy(me.onProcessPaymentError, me)
            }).promise();
        },

        /**
         * Redirects the user to the standard error page.
         */
        onProcessPaymentError: function() {
            var me = this;

            $(location).attr('href', me.opts.paypalErrorPage);
        },

        /**
         * Callback method for the "authorize" function of the button.
         * Directly redirects to the given return URL
         *
         * @param {Object} data
         * @param {Object} actions
         * @return {Object}
         */
        onPayPalAuthorize: function(data, actions) {
            return actions.redirect();
        },

        /**
         * Buffer helper function to set a timeout for a function
         *
         * @param {function} fn
         * @param {number} timeout
         * @return {number}
         */
        buffer: function(fn, timeout) {
            var me = this;

            timeout = timeout || 100;

            return window.setTimeout(fn.bind(me), timeout);
        },

        stripErrorCodeFromUrl: function (url) {
            var index = url.lastIndexOf('/');

            return url.slice(0, index + 1);
        }
    });

    window.StateManager.addPlugin('*[data-paypalUnifiedNormalCheckoutButtonInContext="true"]', 'swagPayPalUnifiedInContextCheckout');
})(jQuery, window);
