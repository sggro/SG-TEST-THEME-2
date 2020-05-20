{extends file="parent:frontend/checkout/ajax_cart.tpl"}

{block name="frontend_checkout_ajax_cart"}
    <div class="ajax--cart">
        <div class="sg-ajax-cart-header">
            <div class="sg-ajax-cart-header-headline">
                {s name="AjaxCartsgHeadline" namespace="frontend/checkout/ajax_cart"}Bestellübersicht{/s}
            </div>
            <div class="buttons--off-canvas">
                {block name='frontend_checkout_ajax_cart_buttons_offcanvas_inner'}
                    <a href="#close-categories-menu" class="close--off-canvas">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                {/block}
            </div>
            <div class="sg-ajax-cart-header-show-cart">
                <a href="{url controller='checkout' action='cart'}" class="btn button--open-basket is--icon-right" title="{$snippetAjaxCartLinkBasket|escape}">
                    {s name='AjaxCartsgLinkBasket' namespace="frontend/checkout/ajax_cart"}Details anzeigen{/s}
                </a>
            </div>
        </div>
        {if $sBasket.content}
            <div class="sg-ajax-cart-buttons">
                <div class="sg-ajax-cart-amount">
                    <div class="sg-ajax-cart-amount-label">
                        {s name='AjaxCartsgTotalAmount'}Gesamtsumme der Ware{/s}
                    </div>
                    <div class="sg-ajax-cart-amount-value">
                        {$sBasket.Amount|currency}
                    </div>
                </div>
                <div class="sg-ajax-confirm-buttons">
                    {if $sBasket.content}
                        {* There is something in the basket *}
                        {if !($sDispatchNoOrder && !$sDispatches) && !$sInvalidCartItems}
                            {block name='frontend_checkout_ajax_cart_open_checkout_inner'}
                                <a href="{if {config name=always_select_payment}}{url controller='checkout' action='shippingPayment'}{else}{url controller='checkout' action='confirm'}{/if}" class="btn is--primary button--checkout" title="{$snippetAjaxCartLinkConfirm|escape}">
                                    {s name='AjaxCartLinkConfirm'}{/s}
                                </a>
                            {/block}
                        {else}
                            {block name='frontend_checkout_ajax_cart_open_checkout_inner_disabled'}
                                {s name="AjaxCartLinkConfirm" assign="snippetAjaxCartLinkConfirm"}{/s}
                                <span class="btn is--disabled is--primary button--checkout" title="{$snippetAjaxCartLinkConfirm|escape}">
                                    {s name='AjaxCartLinkConfirm'}{/s}
                                </span>
                            {/block}
                        {/if}
                        {*{block name='frontend_checkout_ajax_cart_open_basket'}
                            <a href="{url controller='checkout' action='cart'}" class="btn button--open-basket is--icon-right" title="{$snippetAjaxCartLinkBasket|escape}">
                                <i class="icon--arrow-right"></i>
                                {s name='AjaxCartLinkBasket'}{/s}
                            </a>
                        {/block}*}
                    {else}
                        {* The Basket is empty *}
                        {block name='frontend_checkout_ajax_cart_open_checkout_inner_unavailable'}
                            <span class="btn is--primary button--checkout is--icon-right is--disabled" title="{$snippetAjaxCartLinkConfirm|escape}">
                                {s name='AjaxCartLinkConfirm'}{/s}
                            </span>
                        {/block}
                        {block name='frontend_checkout_ajax_cart_open_basket_unavailable'}
                            <span class="btn button--open-basket is--icon-right is--disabled" title="{$snippetAjaxCartLinkBasket|escape}">
                                {s name='AjaxCartLinkBasket'}{/s}
                            </span>
                        {/block}
                    {/if}
                </div>
            </div>
            <div class="sg-ajax-cart-items">
                <div class="item--container">
                    {block name='frontend_checkout_ajax_cart_item_container_inner'}
                        {if $sBasket.content}
                            {foreach $sBasket.content as $sBasketItem}
                                {block name='frontend_checkout_ajax_cart_row'}
                                    {include file="frontend/checkout/ajax_cart_item.tpl" basketItem=$sBasketItem}
                                {/block}
                            {/foreach}
                        {else}
                            {block name='frontend_checkout_ajax_cart_empty'}
                                <div class="cart--item is--empty">
                                    {block name='frontend_checkout_ajax_cart_empty_inner'}
                                        <span class="cart--empty-text">{s name='AjaxCartInfoEmpty'}{/s}</span>
                                    {/block}
                                </div>
                            {/block}
                        {/if}
                    {/block}
                </div>
            </div>
            <div class="sg-ajax-cart-summary">
                <div class="sg-ajax-cart-summary-headline">
                    {s name="AjaxCartsgSummary" namespace="frontend/checkout/ajax_cart"}Ihre Bestellung{/s}
                </div>
                <div class="sg-ajax-cart-total-amount sg-ajax-cart-summary-entry">
                    <span class="sg-ajax-cart-summary-label">
                        {s name="AjaxCartTotalAmount"}Gesamtsumme der Ware{/s}
                    </span>
                    <span class="sg-ajax-cart-summary-amount">
                        {$sBasket.Amount|currency}
                    </span>
                </div>
                <div class="sg-ajax-cart-dispatch sg-ajax-cart-summary-entry">
                    <span class="sg-ajax-cart-summary-label">
                        {s name="AjaxCartsgDispatch" namespace="frontend/checkout/ajax_cart"}Versand{/s}
                    </span>
                    <span class="sg-ajax-cart-summary-amount">
                        {$sBasket.sShippingcostsWithTax|currency}
                    </span>
                </div>
                <div class="sg-ajax-cart-tax sg-ajax-cart-summary-entry">
                    <span class="sg-ajax-cart-summary-label">
                        {s name="AjaxCartsgTax" namespace="frontend/checkout/ajax_cart"}inkl. {$sBasket.sShippingcostsTax}% MwSt.{/s}
                    </span>
                    <span class="sg-ajax-cart-summary-amount">
                     {$sBasket.sAmountTax|currency}
                    </span>
                </div>
                <div class="sg-ajax-cart-total sg-ajax-cart-summary-entry">
                    <span class="sg-ajax-cart-summary-label">
                        {s name="AjaxCartsgTotal" namespace="frontend/checkout/ajax_cart"}Gesamtpreis{/s}
                    </span>
                    <span class="sg-ajax-cart-summary-amount">
                     {$sBasket.sAmount|currency}
                    </span>
                </div>
            </div>
            <div class="sg-ajax-cart-buttons">
                {if $sBasket.content}
                <div class="sg-ajax-confirm-buttons">
                    {* There is something in the basket *}
                    {if !($sDispatchNoOrder && !$sDispatches) && !$sInvalidCartItems}
                        {block name='frontend_checkout_ajax_cart_open_checkout_inner'}

                                <a href="{if {config name=always_select_payment}}{url controller='checkout' action='shippingPayment'}{else}{url controller='checkout' action='confirm'}{/if}" class="btn is--primary button--checkout" title="{$snippetAjaxCartLinkConfirm|escape}">
                                    {s name='AjaxCartLinkConfirm'}{/s}
                                </a>

                        {/block}
                    {else}
                        {block name='frontend_checkout_ajax_cart_open_checkout_inner_disabled'}
                            {s name="AjaxCartLinkConfirm" assign="snippetAjaxCartLinkConfirm"}{/s}
                            <span class="btn is--disabled is--primary button--checkout is--icon-right" title="{$snippetAjaxCartLinkConfirm|escape}">
                                {s name='AjaxCartLinkConfirm'}{/s}
                            </span>
                        {/block}
                    {/if}

                    {*{block name='frontend_checkout_ajax_cart_open_basket'}
                        <a href="{url controller='checkout' action='cart'}" class="btn button--open-basket is--icon-right" title="{$snippetAjaxCartLinkBasket|escape}">
                            <i class="icon--arrow-right"></i>
                            {s name='AjaxCartLinkBasket'}{/s}
                        </a>
                    {/block}*}
                {else}
                    {* The Basket is empty *}
                    {block name='frontend_checkout_ajax_cart_open_checkout_inner_unavailable'}
                        <span class="btn is--primary button--checkout is--icon-right is--disabled" title="{$snippetAjaxCartLinkConfirm|escape}">
                            {s name='AjaxCartLinkConfirm'}{/s}
                        </span>
                    {/block}
                    {block name='frontend_checkout_ajax_cart_open_basket_unavailable'}
                        <span class="btn button--open-basket is--icon-right is--disabled" title="{$snippetAjaxCartLinkBasket|escape}">
                            {s name='AjaxCartLinkBasket'}{/s}
                        </span>
                    {/block}
                {/if}
                </div>
            </div>
        {else}
            <div class="sg-ajax-empty-cart">
                {s name="AjaxCartsgEmptyBasket" namespace="frontend/checkout/ajax_cart"}Ihr Warenkorb enthält aktuell keine Artikel.{/s}
            </div>
        {/if}
    </div>
{/block}
