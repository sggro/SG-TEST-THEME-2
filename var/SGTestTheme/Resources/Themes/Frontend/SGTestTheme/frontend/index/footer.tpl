{extends file="parent:frontend/index/footer.tpl"}

{block name='frontend_index_footer_copyright'}
    <div class='sg-footer'>
        <div class="sg-footer-social-media">
            {if $theme.sgSocialMediaInstagramLink}
            <div class="sg-footer-social-media-icon">
                <a href={$theme.sgSocialMediaInstagramLink} ../../../../../../../../../shopware.php>
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            </div>
            {/if}
            {if $theme.sgSocialMediaFacebookLink}
                <div class="sg-footer-social-media-icon">
                    <a href={$theme.sgSocialMediaFacebookLink} ../../../../../../../../../shopware.php>
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    </a>
                </div>
            {/if}
            {if $theme.sgSocialMediaTwitterLink}
                <div class="sg-footer-social-media-icon">
                    <a href={$theme.sgSocialMediaTwitterLink} ../../../../../../../../../shopware.php>
                        <i class="fa fa-twitter-square" aria-hidden="true"></i>
                    </a>
                </div>
            {/if}
            {if $theme.sgSocialMediaYoutubeLink}
            <div class="sg-footer-social-media-icon">
                <a href={$theme.sgSocialMediaYoutubeLink} ../../../../../../../../../shopware.php>
                    <i class="fa fa-youtube-square" aria-hidden="true"></i>
                </a>
            </div>
            {/if}
        </div>
        <div class="sg-footer-navigation">
            <ul class="navigation--list" role="menu">
                {foreach $sMenu.sgFooterNavigation as $item}
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
            {$smarty.block.parent}
        </div>
        <div class="sg-footer-language-switcher">
            {action module=widgets controller=index action=shopMenu}
        </div>
    </div>
{/block}

{block name="frontend_index_footer_minimal"}{/block}

{* Logo *}
{block name="frontend_index_shopware_footer_logo"}{/block}