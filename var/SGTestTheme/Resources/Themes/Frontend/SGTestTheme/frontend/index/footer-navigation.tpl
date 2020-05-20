<div class="sg-footer-navigation-left">
    <div class="footer--column is--first block">
        <div class="column--headline">
            {s namespace="frontend/index/menu_footer" name='sgFooterFirstColumnHeadline'}{/s}
        </div>
        <div class="column--content">
            {s namespace="frontend/index/menu_footer" name='sgFooterFirstColumnImage'}{/s}
            <p class="column--desc">
                {s namespace="frontend/index/menu_footer" name='sgFooterFirstColumnDescription'}{/s}
            </p>
            <div class="sg-column--link">
                {s namespace="frontend/index/menu_footer" name='sgFooterFirstColumnLink'}{/s}
            </div>
        </div>
    </div>

    <div class="footer--column block">
        <div class="column--headline">
            {s namespace="frontend/index/menu_footer" name='sgFooterSecondColumnHeadline'}{/s}
        </div>
        <div class="column--content">
            {s namespace="frontend/index/menu_footer" name='sgFooterSecondColumnImage'}{/s}
            <p class="column--desc">
                {s namespace="frontend/index/menu_footer" name='sgFooterSecondColumnDescription'}{/s}
            </p>
            <div class="sg-column--link">
                {s namespace="frontend/index/menu_footer" name='sgFooterSecondColumnLink'}{/s}
            </div>
        </div>
    </div>
</div>

<div class="sg-footer-navigation-right">
    <div class="footer--column block">
        <div class="column--headline">
            {s namespace="frontend/index/menu_footer" name='sgFooterThirdColumnHeadline'}{/s}
        </div>
        <div class="column--content">
            <ul>
                <li>
                    {s namespace="frontend/index/menu_footer" name='sgFooterThirdColumnEntry1'}{/s}
                </li>
                <li>
                    {s namespace="frontend/index/menu_footer" name='sgFooterThirdColumnEntry2'}{/s}
                </li>
                <li>
                    {s namespace="frontend/index/menu_footer" name='sgFooterThirdColumnEntry3'}{/s}
                </li>
                <li>
                    {s namespace="frontend/index/menu_footer" name='sgFooterThirdColumnEntry4'}{/s}
                </li>
            </ul>
            <div class="sg-column--link">
                {s namespace="frontend/index/menu_footer" name='sgFooterThirdColumnLink'}{/s}
            </div>
        </div>
    </div>

    <div class="footer--column column--menu block">
        <div class="column--headline">
            {s namespace="frontend/index/menu_footer" name='sgFooterFourthColumnHeadline'}{/s}
        </div>
        <nav class="column--navigation column--content">
            <ul class="navigation--list" role="menu">
              {foreach $sMenu.sgFooterFourthColumn as $item}
                <li class="navigation--entry" role="menuitem">
                    <a class="navigation--link" href="{if $item.link}{$item.link}{else}{url controller='custom' sCustom=$item.id title=$item.description}{/if}" title="{$item.description|escape}"{if $item.target} target="{$item.target}"{/if}>
                        <div class='sg-column--icon'>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </div>
                        <div class='sg-column--text'>
                            {$item.description}
                        </div>
                    </a>

                    {* Sub categories *}
                    {if $item.childrenCount > 0}
                        <ul class="navigation--list is--level1" role="menu">
                            {foreach $item.subPages as $subItem}
                                <li class="navigation--entry" role="menuitem">
                                    <a class="navigation--link" href="{if $subItem.link}{$subItem.link}{else}{url controller='custom' sCustom=$subItem.id title=$subItem.description}{/if}" title="{$subItem.description|escape}"{if $subItem.target} target="{$subItem.target}"{/if}>
                                        {$subItem.description}
                                    </a>
                                </li>
                            {/foreach}
                        </ul>
                    {/if}
                </li>
            {/foreach}
            </ul>
            <div class="sg-column--link">
                {s namespace="frontend/index/menu_footer" name='sgFooterFourthColumnLink'}{/s}
            </div>
        </nav>
    </div>

    <div class="footer--column column--menu block">
        <div class="column--headline">
            {s namespace="frontend/index/menu_footer" name='sgFooterFifthColumnHeadline'}{/s}
        </div>
        <nav class="column--navigation column--content">
            <ul class="navigation--list" role="menu">
                {foreach $sMenu.sgFooterFifthColumn as $item}
                    <li class="navigation--entry" role="menuitem">
                        <a class="navigation--link" href="{if $item.link}{$item.link}{else}{url controller='custom' sCustom=$item.id title=$item.description}{/if}" title="{$item.description|escape}"{if $item.target} target="{$item.target}"{/if}>
                            {$item.description}
                        </a>

                        {* Sub categories *}
                        {if $item.childrenCount > 0}
                            <ul class="navigation--list is--level1" role="menu">
                                {foreach $item.subPages as $subItem}
                                    <li class="navigation--entry" role="menuitem">
                                        <a class="navigation--link" href="{if $subItem.link}{$subItem.link}{else}{url controller='custom' sCustom=$subItem.id title=$subItem.description}{/if}" title="{$subItem.description|escape}"{if $subItem.target} target="{$subItem.target}"{/if}>
                                            {$subItem.description}
                                        </a>
                                    </li>
                                {/foreach}
                            </ul>
                        {/if}
                    </li>
                {/foreach}
            </ul>
            <div class="sg-column--link">
                {s namespace="frontend/index/menu_footer" name='sgFooterFifthColumnLink'}{/s}
            </div>
        </nav>
    </div>
</div>