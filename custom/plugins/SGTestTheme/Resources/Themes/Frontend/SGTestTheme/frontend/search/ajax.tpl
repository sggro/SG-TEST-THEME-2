{extends file="parent:frontend/search/ajax.tpl"}

{block name="search_ajax_inner"}
    <h2>{s namespace="frontend/search/ajax" name="IndexSearchResultsHeadline"}Produkte{/s}</h2>
    {$smarty.block.parent}
{/block}

{block name="search_ajax_list_entry"}
    <li class="list--entry block-group result--item">
        <a class="search-result--link" href="{$search_result.link}" title="{$search_result.name|escape}">

            <div class="sg-offcanvas-search-result-item">
                <div class="sg-offcanvas-search-result-item-left-wrapper">
                    {block name="search_ajax_list_entry_name"}
                        <span class="entry--name block">
                            {$search_result.name|escapeHtml}
                            </span>
                        {block name="search_ajax_list_entry_price"}
                            <span class="entry--price block">
                                    {$sArticle = $search_result}
                                {*reset pseudo price value to prevent discount boxes*}
                                {$sArticle.has_pseudoprice = 0}

                                {block name="search_ajax_list_entry_price_main"}
                                    {include file="frontend/listing/product-box/product-price.tpl"}
                                {/block}

                                {*{block name="search_ajax_list_entry_price_unit"}
                                    {include file="frontend/search/product-price-unit.tpl"}
                                {/block}*}
                                </span>
                        {/block}
                    {/block}
                </div>

                <div class="sg-offcanvas-search-result-item-right-wrapper">
                    {block name="search_ajax_list_entry_media"}
                        <span class="entry--media block">
                            {if $search_result.image.thumbnails[0]}
                                <img srcset="{$search_result.image.thumbnails[0].sourceSet}" alt="{$search_result.name|escape}" class="media--image">
                            {else}
                                {s name="ListingBoxNoPicture" assign="snippetListingBoxNoPicture"}{/s}
                                <img src="{link file='frontend/_public/src/img/no-picture.jpg'}" alt="{$snippetListingBoxNoPicture|escape}" class="media--image">
                            {/if}
                        </span>
                    {/block}
                </div>
            </div>
        </a>
    </li>
{/block}