{extends file='parent:frontend/index/main-navigation.tpl'}

{block name='frontend_index_navigation_categories'}
    <div class="sg-header-categories-wrapper" data-menu-scroller="true" data-listSelector=".navigation--list.container" data-viewPortSelector=".navigation--list-wrapper">
        {$smarty.block.parent}
    </div>
{/block}