;(function($, window) {
    'use strict';

    $.plugin('swagPayPalUnifiedExpressCheckoutButtonInContext', {
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
             * URL used to create a new payment
             *
             * @type string
             */
            createPaymentUrl: '',

            /**
             * size of the button
             * possible values:
             *  - small
             *  - medium
             *  - large
             *  - responsive
             *
             *  @type string
             */
            size: 'medium',

            /**
             * shape of the button
             * possible values:
             *  - pill
             *  - rect
             *
             *  @type string
             */
            shape: 'rect',

            /**
             * size of the button
             * possible values:
             *  - gold
             *  - blue
             *  - silver
             *  - black
             *
             *  @type string
             */
            color: 'gold',

            /**
             * show text under the button
             *
             * @type boolean
             */
            tagline: false,

            /**
             * The language ISO (ISO_639) for the payment wall.
             *
             * @type string
             */
            paypalLanguage: 'en_US',

            /**
             * A boolean indicating if the current page is an product detail page.
             *
             * @type boolean
             */
            detailPage: false,

            /**
             * The selector for the quantity selection on the detail page.
             *
             * @type string
             */
            productQuantitySelector: '#sQuantity',

            /**
             * The selector for the product number on the detail page.
             *
             * @type string
             */
            productNumberSelector: 'input[name="sAdd"]',

            /**
             * The selector for the indicator whether the PayPal javascript is already loaded or not
             *
             * @type string
             */
            paypalScriptLoadedSelector: 'paypal-checkout-js-loaded'
        },

        /**
         * @type {Object}
         */
        expressCheckoutButton: null,

        init: function() {
            var me = this;

            me.applyDataAttributes();

            me.createButton();

            $.publish('plugin/swagPayPalUnifiedExpressCheckoutButtonInContextCart/init', me);

            if (me.opts.detailPage) {
                $.subscribe(me.getEventName('plugin/swAjaxVariant/onRequestData'), $.proxy(me.onChangeVariant, me));
            }
        },

        /**
         * Will be triggered when the selected variant was changed.
         * Re-initializes this plugin.
         */
        onChangeVariant: function() {
            window.StateManager.addPlugin('*[data-paypalUnifiedEcButtonInContext="true"]', 'swagPayPalUnifiedExpressCheckoutButtonInContext');
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
                me.expressCheckoutButton = paypal.Button.render(me.createPayPalButtonConfiguration(), me.$el.get(0));

                $.publish('plugin/swagPayPalUnifiedExpressCheckoutButtonInContextCart/createButton', [me, me.expressCheckoutButton]);
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
                    size: me.opts.size,
                    shape: me.opts.shape,
                    color: me.opts.color,
                    tagline: me.opts.tagline
                },

                locale: me.opts.paypalLanguage,

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

            $.publish('plugin/swagPayPalUnifiedExpressCheckoutButtonInContextCart/createConfig', [me, config]);

            return config;
        },

        /**
         * Callback method for the "payment" function of the button.
         * Calls an action which creates the payment and redirects to the paypal page.
         *
         * @return {string}
         */
        onPayPalPayment: function() {
            var me = this,
                token,
                params;

            if (CSRF.checkToken()) {
                token = CSRF.getToken();
            }

            params = {
                'useInContext': true,
                '__csrf_token': token
            };

            if (me.opts.detailPage) {
                params.addProduct = true;
                params.productNumber = me.getProductNumber();
                params.productQuantity = me.getProductQuantity();
            }

            $.publish('plugin/swagPayPalUnifiedExpressCheckoutButtonInContextCart/beforeCreatePayment', [me, params]);

            return paypal.request.post(me.opts.createPaymentUrl, params).then(function(data) {
                $.publish('plugin/swagPayPalUnifiedExpressCheckoutButtonInContextCart/paymentCreated', [me, data]);
                return data.paymentId;
            });
        },

        /**
         * Callback method for the "authorize" function of the button.
         * Directly redirects to the given return URL
         *
         * @param {Object} data
         * @param {Object} actions
         */
        onPayPalAuthorize: function(data, actions) {
            return actions.redirect();
        },

        /**
         * Helper function that returns the current product number.
         * Will only be used on the product detail page
         *
         * @returns {String}
         */
        getProductNumber: function() {
            var me = this;

            return $(me.opts.productNumberSelector).val();
        },

        /**
         * Helper function that returns the current product quantity.
         * Will only be used on the product detail page.
         *
         * @returns {Number}
         */
        getProductQuantity: function() {
            var me = this;

            return $(me.opts.productQuantitySelector).val();
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

        /**
         * Destroys the plugin and unsubscribes from subscribed events
         */
        destroy: function() {
            var me = this;

            $.unsubscribe(me.getEventName('plugin/swAjaxVariant/onRequestData'));

            me._destroy();
        }
    });

    /**
     *  After the loading another product variant, we lose the
     *  plugin instance, therefore, we have to re-initialize it here.
     */
    $.subscribe('plugin/swAjaxVariant/onRequestData', function() {
        window.StateManager.addPlugin('*[data-paypalUnifiedEcButtonInContext="true"]', 'swagPayPalUnifiedExpressCheckoutButtonInContext');
    });

    window.StateManager.addPlugin('*[data-paypalUnifiedEcButtonInContext="true"]', 'swagPayPalUnifiedExpressCheckoutButtonInContext');
})(jQuery, window);
