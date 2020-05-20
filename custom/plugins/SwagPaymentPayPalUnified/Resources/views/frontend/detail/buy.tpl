{extends file='parent:frontend/detail/buy.tpl'}

{* PayPal Installments integration *}
{block name='frontend_detail_buy_button_container'}
    {block name='frontend_detail_buy_button_container_paypal_unified_installments'}
        {if $paypalInstallmentsMode === 'cheapest'}
            {include file='frontend/paypal_unified/installments/upstream_presentment.tpl'}
        {/if}

        {if $paypalInstallmentsMode === 'simple'}
            {include file='frontend/paypal_unified/installments/upstream_presentment/detail/simple.tpl'}
        {/if}
    {/block}

    {block name='frontend_detail_buy_button_container_paypal_unified_installments_banner'}
        {include file='frontend/paypal_unified/installments/banner/product_detail.tpl'}
    {/block}

    {$smarty.block.parent}
{/block}

{* PayPal Express Checkout integration *}
{block name='frontend_detail_buy_button'}
    {$smarty.block.parent}

    {block name='frontend_detail_buy_button_paypal_unified_installments'}
        {if !($sArticle.sConfigurator && !$activeConfiguratorSelection) && $paypalUnifiedEcDetailActive}
            {include file='frontend/paypal_unified/express_checkout/button_detail.tpl'}
        {/if}
    {/block}
{/block}
