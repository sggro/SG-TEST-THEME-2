{namespace name='frontend/paypal_unified/installments/common'}

{block name='frontend_paypal_unified_installments_modal_link'}
    <a href="#"
       class="paypal-unified-installments--modal-link{if $displayStyle == 'simple'} is--white{/if}{if $displayStyle == 'cheapest'} is--centered{/if}"
       title="{"{s name='link/text'}Information about possible rates{/s}"|escape}"
       data-title="{"{s name='title'}Information about Installments Powered by PayPal{/s}"|escape}"
       data-paypalInstallmentsModalURL="{url module='widgets' controller='PaypalUnifiedInstallments' action='modalContent' forceSecure}"
       data-paypalInstallmentsProductPrice="{$paypalInstallmentsProductPrice}">
        {s name='link/text'}Information about possible rates{/s}

        {if $displayStyle == 'cheapest'}
            <i class="icon--arrow-right"></i>
        {/if}
    </a>
{/block}
