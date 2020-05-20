{extends file='parent:frontend/detail/data.tpl'}

{* PayPal Installments integration *}
{block name='frontend_widgets_delivery_infos'}
    {$smarty.block.parent}

    {block name='frontend_widgets_delivery_infos_paypal_unified_installments'}
        {if $paypalInstallmentsNotAvailable}
            {include file='frontend/paypal_unified/installments/upstream_presentment/detail/not_available.tpl'}
        {/if}
    {/block}
{/block}
