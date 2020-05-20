{extends file='parent:/frontend/index/index.tpl'}

{block name="frontend_index_body_classes"}{strip}
    is--ctl-{controllerName|lower} is--act-{controllerAction|lower}
    {if $sUserLoggedIn} is--user{/if}
    {if $sOneTimeAccount} is--one-time-account{/if}
    {if $sTarget} is--target-{$sTarget|escapeHtml}{/if}
    {if $theme.checkoutHeader && (({controllerName|lower} == "checkout" && {controllerAction|lower} != "cart") || ({controllerName|lower} == "register" && ($sTarget != "account" && $sTarget != "address")))} is--minimal-header{/if}
    {/strip} is--no-sidebar{/block}

{* Shop header *}
{block name='frontend_index_navigation'}

{* Maincategories navigation top *}
{block name='frontend_index_navigation_categories_top'}
    <nav class="navigation-main">

        <div class='sg-header-icons is-sg-header-icon-left'>
            <ul>
            {* Menu (Off canvas left) trigger *}
            {block name='frontend_index_offcanvas_left_trigger'}
                <li class="navigation--entry entry--menu-left" role="menuitem">
                    <a class="entry--link entry--trigger btn" href="#offcanvas--left" data-offcanvas="true" data-offCanvasSelector=".sidebar-main" aria-label="{s namespace='frontend/index/menu_left' name="IndexLinkMenu"}{/s}">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            {/block}
            </ul>
        </div>

        <div class="sg-header-logo">
            {* Logo container *}
            {block name='frontend_index_logo_container'}
                {include file="frontend/index/logo-container.tpl"}
            {/block}
        </div>
        <div class="sg-header-categories">
            {block name="frontend_index_navigation_categories_top_include"}
                {include file='frontend/index/main-navigation.tpl'}
            {/block}
        </div>
        <div class="sg-header-icons">
            <ul>
                {* Search form *}
                {block name='frontend_index_search'}
                    <li class="navigation--entry entry--search" role="menuitem" data-search="true" aria-haspopup="true"{if $theme.focusSearch && {controllerName|lower} == 'index'} data-activeOnStart="true"{/if} data-minLength="{config name="MinSearchLenght"}">
                        {s namespace="frontend/index/search" name="IndexTitleSearchToggle" assign="snippetIndexTitleSearchToggle"}{/s}
                        <a class="btn entry--link entry--trigger"
                            href="#"
                            title="{$snippetIndexTitleSearchToggle|escape}"
                            aria-label="{$snippetIndexTitleSearchToggle|escape}"
                            data-offcanvas="true"
                            data-sg-search-offcanvas="true"
                            data-offCanvasSelector=".sg-search-offcanvas"
                            data-direction="fromRight"
                            data-closeButtonSelector=".sg-search-close-btn">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                {/block}
                {* Cart entry *}
                {block name='frontend_index_checkout_actions'}
                    {* Include of the cart *}
                    {block name='frontend_index_checkout_actions_include'}
                        {action module=widgets controller=checkout action=info}
                    {/block}
                {/block}
            </ul>
        </div>
    </nav>
    {block name="sg_frontend_index_sub_navigation"}
        {include file="frontend/index/sg-sub-navigation.tpl"}
    {/block}
{/block}
    {block name='frontend_index_container_ajax_cart'}
        <div class="container--ajax-cart" data-collapse-cart="true"{if $theme.offcanvasCart} data-displayMode="offcanvas"{/if}></div>
        <div class="sg-search-offcanvas off-canvas" data-search="true">
            <div class="sg-search-offcanvas-header">
                <h2>{s namespace="frontend/index/shop-navigation" name="IndexSearchFieldSubmit"}Suchen{/s}</h2>
                <a href="#" class="sg-search-close-btn">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
            <div class="sg-search-offcanvas-content-wrapper">
                {block name='frontend_index_search_include'}
                    {include file="frontend/index/search.tpl"}
                {/block}
            </div>
        </div>
    {/block}
{/block}
{*{block name='frontend_index_navigation_categories_top_include'}
    {$smarty.block.parent}
    {include file='frontend/plugins/advanced_menu/index.tpl'}
{/block}*}

{block name="frontend_index_content_main_classes"}
    {strip}
        {$smarty.block.parent}

        {if $sCategories}
            {$sgCategories = $sCategories}
        {elseif $sMainCategories}
            {$sgCategories = $sMainCategories}
        {/if}

        {foreach $sgCategories as $sgCategory}
            {if $sCategoryCurrent == $sgCategory.id}
                {$sgSubNavigationActive = "true"}
            {/if}
        {/foreach}

        {if !$sgSubNavigationActive} sg-sub-navigation-active{/if}
    {/strip}
{/block}



{* Footer *}
{block name="frontend_index_footer"}
    {include file="frontend/index/sg-footer-newsletter.tpl"}
    <footer class="footer-main">
        {block name="frontend_index_footer_container"}
                {include file='frontend/index/footer.tpl'}
        {/block}
    </footer>
{/block}
