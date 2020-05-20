{if $sCategories}
    {$sgCategories = $sCategories}
{elseif $sMainCategories}
    {$sgCategories = $sMainCategories}
{/if}


{if $sgCategories}
     {foreach $sgCategories as $sgCategory}
         {if $sgCategory.flag && $sgCategory.subcategories}
             {foreach $sgCategory.subcategories as $subcategory}
                 {if $subcategory.flag}
                     <div class="sg-sub-navigation">
                         <div class="container" data-menu-scroller="true" data-listSelector=".sg-sub-navigation-list" data-viewPortSelector=".container">
                            <ul class="sg-sub-navigation-list">
                                 <li>
                                     <a {if $sCategoryCurrent == $subcategory.id} class="is--active"{/if} href="{$subcategory.link}">{$subcategory.name}</a>
                                 </li>
                                {if $subcategory.subcategories}
                                     {foreach $subcategory.subcategories as $subsubcategory}
                                         {if !$subsubcategory.hidetop}
                                             <li>
                                                 <a {if $subsubcategory.flag} class="is--active"{/if} href="{$subsubcategory.link}">{$subsubcategory.name}</a>
                                             </li>
                                         {/if}
                                     {/foreach}
                                {/if}
                            </ul>
                         </div>
                     </div>
                 {/if}
             {/foreach}
         {/if}
     {/foreach}
{/if}

