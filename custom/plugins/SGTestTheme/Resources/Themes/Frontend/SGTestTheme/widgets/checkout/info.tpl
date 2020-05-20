{extends file="parent:widgets/checkout/info.tpl"}

{* Notepad entry *}
{block name="frontend_index_checkout_actions_notepad"}
    <li class="navigation--entry entry--notepad" role="menuitem">
        {s namespace="frontend/index/checkout_actions" name="IndexLinkNotepad" assign="snippetIndexLinkNotepad"}{/s}
        <a href="{url controller='note'}" title="{$snippetIndexLinkNotepad|escape}" aria-label="{$snippetIndexLinkNotepad|escape}" class="btn">
            <i class="fa fa-heart-o"></i>
            {if $sNotesQuantity > 0}
                <span class="badge notes--quantity">
                    {$sNotesQuantity}
                </span>
            {/if}
        </a>
    </li>
{/block}

{* My account entry *}
{block name="frontend_index_checkout_actions_my_options"}
    <li class="navigation--entry entry--account{if {config name=useSltCookie} || $sOneTimeAccount} with-slt{/if}"
        role="menuitem"
        data-offcanvas="true"
        data-offCanvasSelector=".account--dropdown-navigation">
        {block name="frontend_index_checkout_actions_account"}
            <a href="{url controller='account'}"
               title="{"{if $userInfo}{s name="AccountGreetingBefore" namespace="frontend/account/sidebar"}{/s}{$userInfo['firstname']}{s name="AccountGreetingAfter" namespace="frontend/account/sidebar"}{/s} - {/if}{s namespace='frontend/index/checkout_actions' name='IndexLinkAccount'}{/s}"|escape}"
               aria-label="{"{if $userInfo}{s name="AccountGreetingBefore" namespace="frontend/account/sidebar"}{/s}{$userInfo['firstname']}{s name="AccountGreetingAfter" namespace="frontend/account/sidebar"}{/s} - {/if}{s namespace='frontend/index/checkout_actions' name='IndexLinkAccount'}{/s}"|escape}"
               class="btn entry--link account--link{if $userInfo} account--user-loggedin{/if}">
                <i class="fa fa-user-o"></i>
                {if $userInfo}
                    <span class="account--display navigation--personalized">
                        <span class="account--display-greeting">
                            {s name="AccountGreetingBefore" namespace="frontend/account/sidebar"}{/s}
                            {$userInfo['firstname']}
                            {s name="AccountGreetingAfter" namespace="frontend/account/sidebar"}{/s}
                        </span>
                        {s namespace='frontend/index/checkout_actions' name='IndexLinkAccount'}{/s}
                    </span>
                {else}
                {/if}
            </a>
        {/block}

    </li>
{/block}

{* Cart entry *}
{block name="frontend_index_checkout_actions_cart"}
    <li class="navigation--entry entry--cart" role="menuitem">
        {s namespace="frontend/index/checkout_actions" name="IndexLinkCart" assign="snippetIndexLinkCart"}{/s}
        <a class="btn cart--link" href="{url controller='checkout' action='cart'}" title="{$snippetIndexLinkCart|escape}" aria-label="{$snippetIndexLinkCart|escape}">

            <span class="badge is--primary is--minimal cart--quantity{if $sBasketQuantity < 1} is--hidden{/if}">{$sBasketQuantity}</span>

            <i class="fa fa-shopping-bag"></i>
        </a>
        <div class="ajax-loader">&nbsp;</div>
    </li>
{/block}