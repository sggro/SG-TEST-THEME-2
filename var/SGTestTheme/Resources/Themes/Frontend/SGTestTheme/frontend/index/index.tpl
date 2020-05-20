{extends file='parent:/frontend/index/index.tpl'}

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
                        <a class="btn entry--link entry--trigger" href="#show-hide--search" title="{$snippetIndexTitleSearchToggle|escape}" aria-label="{$snippetIndexTitleSearchToggle|escape}">
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
{/block}
{block name='frontend_index_container_ajax_cart'}
    <div class="container--ajax-cart" data-collapse-cart="true"{if $theme.offcanvasCart} data-displayMode="offcanvas"{/if}></div>
{/block}
{/block}
{*{block name='frontend_index_navigation_categories_top_include'}
    {$smarty.block.parent}
    {include file='frontend/plugins/advanced_menu/index.tpl'}
{/block}*}

{* Footer *}
{block name="frontend_index_footer"}
    {include file="frontend/index/sg-footer-newsletter.tpl"}
    <footer class="footer-main">
        {block name="frontend_index_footer_container"}
                {include file='frontend/index/footer.tpl'}
        {/block}
    </footer>
{/block}
