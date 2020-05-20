{extends file='parent:frontend/index/sidebar.tpl'}

{* Mobile specific menu actions *}
{block name="frontend_index_left_navigation_smartphone"}
    <div class="navigation--smartphone">
        <ul class="navigation--list sg-header-mobile-navigation">

            {* Trigger to close the off canvas menu *}
            {block name="frontend_index_left_categories_close_menu"}
                <li class="navigation--entry entry--home" role="menuitem">
                    {s namespace="frontend/index/checkout_actions" name="IndexLinkHome" assign="snippetIndexLinkHome"}{/s}
                    <a href="{url controller='index'}" title="{$snippetIndexLinkNotepad|escape}" aria-label="{$snippetIndexLinkHome|escape}" class="btn">
                        <i class="fa fa-home"></i>
                     </a>
                </li>

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
                <li class="navigation--entry entry--close-off-canvas">
                    <a href="#close-categories-menu" title="{s namespace='frontend/index/menu_left' name="IndexActionCloseMenu"}{/s}" class="btn">
                        <i class="fa fa-times"></i>
                    </a>
                </li>
            {/block}
        </ul>

    </div>
{/block}

{* Categories headline *}
{block name="frontend_index_left_categories_headline"}
{/block}