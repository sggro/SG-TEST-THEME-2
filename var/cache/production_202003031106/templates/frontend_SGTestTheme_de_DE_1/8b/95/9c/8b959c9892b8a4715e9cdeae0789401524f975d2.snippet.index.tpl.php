<?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 14:04:47
         compiled from "/var/www/html/themes/Frontend/Bare/frontend/plugins/seo/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14979510995ebbe25fc6bc99-83288813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b959c9892b8a4715e9cdeae0789401524f975d2' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/frontend/plugins/seo/index.tpl',
      1 => 1583233580,
      2 => 'file',
    ),
    'b20fdba3dbb92bc51db5e3c2bf3a25a939eb1ddf' => 
    array (
      0 => '/var/www/html/custom/plugins/SGTestTheme/Resources/Themes/Frontend/SGTestTheme/frontend/search/ajax.tpl',
      1 => 1589355367,
      2 => 'file',
    ),
    'cd68274301479d208207f1c1c534ff218c1cf75e' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/frontend/search/ajax.tpl',
      1 => 1589297304,
      2 => 'parent',
    ),
    '59fd2a9c510af33e24c2810f3222a75ced6d10bb' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-price.tpl',
      1 => 1583233580,
      2 => 'snippet',
    ),
    '58d23cf599cda659ab01e7ae8df78e08da36a81d' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-price-unit.tpl',
      1 => 1583233580,
      2 => 'parent',
    ),
    '6e06009814213e3ff8add286c39c1412a58bbcae' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/frontend/search/product-price-unit.tpl',
      1 => 1583233580,
      2 => 'snippet',
    ),
  ),
  'nocache_hash' => '14979510995ebbe25fc6bc99-83288813',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sSearchResults' => 0,
    'search_result' => 0,
    'snippetListingBoxNoPicture' => 0,
    'sSearchRequest' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ebbe25fdbb169_10115489',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ebbe25fdbb169_10115489')) {function content_5ebbe25fdbb169_10115489($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['sSearchResults']->value['sResults']){?>

    
    
        <ul class="results--list">
            <li class="list--entry entry--no-results result--item"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'SearchAjaxNoResults','namespace'=>'frontend/search/ajax')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'SearchAjaxNoResults','namespace'=>'frontend/search/ajax'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Keine Suchergebnisse gefunden<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'SearchAjaxNoResults','namespace'=>'frontend/search/ajax'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</li>
        </ul>
    

<?php }else{ ?>

    
    <h2><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'frontend/search/ajax','name'=>'IndexSearchResultsHeadline','default'=>'Produkte')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'frontend/search/ajax','name'=>'IndexSearchResultsHeadline','default'=>'Produkte'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Produkte<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'frontend/search/ajax','name'=>'IndexSearchResultsHeadline','default'=>'Produkte'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>
    
        <ul class="results--list">
            <?php  $_smarty_tpl->tpl_vars['search_result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['search_result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sSearchResults']->value['sResults']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['search_result']->key => $_smarty_tpl->tpl_vars['search_result']->value){
$_smarty_tpl->tpl_vars['search_result']->_loop = true;
?>

                
                
    <li class="list--entry block-group result--item">
        <a class="search-result--link" href="<?php echo $_smarty_tpl->tpl_vars['search_result']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_result']->value['name'], ENT_QUOTES, 'utf-8', true);?>
">

            <div class="sg-offcanvas-search-result-item">
                <div class="sg-offcanvas-search-result-item-left-wrapper">
                    
                        <span class="entry--name block">
                            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escapeHtml'][0][0]->escapeHtml($_smarty_tpl->tpl_vars['search_result']->value['name']);?>

                            </span>
                        
                            <span class="entry--price block">
                                    <?php $_smarty_tpl->tpl_vars['sArticle'] = new Smarty_variable($_smarty_tpl->tpl_vars['search_result']->value, null, 0);?>
                                
                                <?php $_smarty_tpl->createLocalArrayVariable('sArticle', null, 0);
$_smarty_tpl->tpl_vars['sArticle']->value['has_pseudoprice'] = 0;?>

                                
                                    <?php /*  Call merged included template "frontend/listing/product-box/product-price.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("frontend/listing/product-box/product-price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '14979510995ebbe25fc6bc99-83288813');
content_5ebbe25fda46c0_24950831($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "frontend/listing/product-box/product-price.tpl" */?>
                                

                                
                                </span>
                        
                    
                </div>

                <div class="sg-offcanvas-search-result-item-right-wrapper">
                    
                        <span class="entry--media block">
                            <?php if ($_smarty_tpl->tpl_vars['search_result']->value['image']['thumbnails'][0]){?>
                                <img srcset="<?php echo $_smarty_tpl->tpl_vars['search_result']->value['image']['thumbnails'][0]['sourceSet'];?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_result']->value['name'], ENT_QUOTES, 'utf-8', true);?>
" class="media--image">
                            <?php }else{ ?>
                                <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ListingBoxNoPicture','assign'=>'snippetListingBoxNoPicture','namespace'=>'frontend/search/ajax')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxNoPicture','assign'=>'snippetListingBoxNoPicture','namespace'=>'frontend/search/ajax'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Kein Bild<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxNoPicture','assign'=>'snippetListingBoxNoPicture','namespace'=>'frontend/search/ajax'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                <img src="/themes/Frontend/Responsive/frontend/_public/src/img/no-picture.jpg" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['snippetListingBoxNoPicture']->value, ENT_QUOTES, 'utf-8', true);?>
" class="media--image">
                            <?php }?>
                        </span>
                    
                </div>
            </div>
        </a>
    </li>

            <?php } ?>

            
            
                <li class="entry--all-results block-group result--item">

                    
                    
                        <a href="<?php echo 'http://192.168.100.198/search';?>?sSearch=<?php echo urlencode($_smarty_tpl->tpl_vars['sSearchRequest']->value['sSearch']);?>
" class="search-result--link entry--all-results-link block">
                            <i class="icon--arrow-right"></i>
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'SearchAjaxLinkAllResults','namespace'=>'frontend/search/ajax')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'SearchAjaxLinkAllResults','namespace'=>'frontend/search/ajax'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Alle Ergebnisse anzeigen<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'SearchAjaxLinkAllResults','namespace'=>'frontend/search/ajax'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        </a>
                    

                    
                    
                        <span class="entry--all-results-number block">
                            <?php echo $_smarty_tpl->tpl_vars['sSearchResults']->value['sArticlesCount'];?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'SearchAjaxInfoResults','namespace'=>'frontend/search/ajax')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'SearchAjaxInfoResults','namespace'=>'frontend/search/ajax'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Treffer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'SearchAjaxInfoResults','namespace'=>'frontend/search/ajax'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        </span>
                    
                </li>
            
        </ul>
    

<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 14:04:47
         compiled from "/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-price.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5ebbe25fd3e507_53346534')) {function content_5ebbe25fd3e507_53346534($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_currency')) include '/var/www/html/engine/Library/Enlight/Template/Plugins/modifier.currency.php';
?>

<div class="product--price">

    
    
        <span class="price--default is--nowrap<?php if ($_smarty_tpl->tpl_vars['sArticle']->value['has_pseudoprice']){?> is--discount<?php }?>">
            <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['priceStartingFrom']){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ListingBoxArticleStartsAt','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleStartsAt','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ab<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleStartsAt','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php }?>
            <?php echo smarty_modifier_currency($_smarty_tpl->tpl_vars['sArticle']->value['price']);?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'Star','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
*<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </span>
    

    
    
        <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['has_pseudoprice']){?>
            <span class="price--pseudo">

                
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'priceDiscountLabel','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'priceDiscountLabel','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'priceDiscountLabel','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                

                <span class="price--discount is--nowrap">
                    <?php echo smarty_modifier_currency($_smarty_tpl->tpl_vars['sArticle']->value['pseudoprice']);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'Star','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
*<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </span>

                
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'priceDiscountInfo','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'priceDiscountInfo','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'priceDiscountInfo','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                
            </span>
        <?php }?>
    
</div>
<?php }} ?><?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 14:04:47
         compiled from "/var/www/html/themes/Frontend/Bare/frontend/search/product-price-unit.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5ebbe25fd6c3a2_76853322')) {function content_5ebbe25fd6c3a2_76853322($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_currency')) include '/var/www/html/engine/Library/Enlight/Template/Plugins/modifier.currency.php';
?>

<?php ob_start();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ListingBoxArticleContent','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleContent','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo "Inhalt";?><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleContent','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['tooltip'] = new Smarty_variable(htmlspecialchars($_tmp1, ENT_QUOTES, 'utf-8', true), null, 0);?>
<?php $_smarty_tpl->tpl_vars['hasPurchaseUnit'] = new Smarty_variable($_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit']&&$_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit']!=0, null, 0);?>
<?php $_smarty_tpl->tpl_vars['hasReferenceUnit'] = new Smarty_variable($_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit']&&$_smarty_tpl->tpl_vars['sArticle']->value['referenceunit']&&$_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit']!=$_smarty_tpl->tpl_vars['sArticle']->value['referenceunit'], null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['hasPurchaseUnit']->value){?>
    <?php $_smarty_tpl->tpl_vars['purchaseUnit'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit'])." ".((string)$_smarty_tpl->tpl_vars['sArticle']->value['sUnit']['description']), null, 0);?>
    <?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchaseUnit']->value, ENT_QUOTES, 'utf-8', true);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['tooltip'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['tooltip']->value)." ".$_tmp2, null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['hasReferenceUnit']->value){?>
    <?php ob_start();?><?php echo smarty_modifier_currency($_smarty_tpl->tpl_vars['sArticle']->value['referenceprice']);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['price'] = new Smarty_variable($_tmp3, null, 0);?>
    <?php ob_start();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'Star','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo "*";?><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_tmp4=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['unit'] = new Smarty_variable($_tmp4." / ".((string)$_smarty_tpl->tpl_vars['sArticle']->value['referenceunit'])." ".((string)$_smarty_tpl->tpl_vars['sArticle']->value['sUnit']['description']), null, 0);?>
    <?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['unit']->value, ENT_QUOTES, 'utf-8', true);?>
<?php $_tmp5=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['referenceUnit'] = new Smarty_variable("(".((string)$_smarty_tpl->tpl_vars['price']->value)." ".$_tmp5.")", null, 0);?>
    <?php $_smarty_tpl->tpl_vars['tooltip'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['tooltip']->value)." ".((string)$_smarty_tpl->tpl_vars['referenceUnit']->value), null, 0);?>
<?php }?>

<div class="price--unit" title="<?php echo $_smarty_tpl->tpl_vars['tooltip']->value;?>
">

    
    <?php if ($_smarty_tpl->tpl_vars['hasPurchaseUnit']->value){?>

        
        
    <span class="price--label label--purchase-unit">
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'DetailDataInfoContent','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'DetailDataInfoContent','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Inhalt:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'DetailDataInfoContent','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </span>


        
        
            <span class="is--nowrap">
                <?php echo $_smarty_tpl->tpl_vars['purchaseUnit']->value;?>

            </span>
        
    <?php }?>

    
    <?php if ($_smarty_tpl->tpl_vars['hasReferenceUnit']->value){?>

        
        
            <span class="is--nowrap">
                <?php echo $_smarty_tpl->tpl_vars['referenceUnit']->value;?>

            </span>
        
    <?php }?>
</div>
<?php }} ?><?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 14:04:47
         compiled from "/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-price.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5ebbe25fda46c0_24950831')) {function content_5ebbe25fda46c0_24950831($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_currency')) include '/var/www/html/engine/Library/Enlight/Template/Plugins/modifier.currency.php';
?>

<div class="product--price">

    
    
        <span class="price--default is--nowrap<?php if ($_smarty_tpl->tpl_vars['sArticle']->value['has_pseudoprice']){?> is--discount<?php }?>">
            <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['priceStartingFrom']){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ListingBoxArticleStartsAt','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleStartsAt','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ab<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleStartsAt','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php }?>
            <?php echo smarty_modifier_currency($_smarty_tpl->tpl_vars['sArticle']->value['price']);?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'Star','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
*<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </span>
    

    
    
        <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['has_pseudoprice']){?>
            <span class="price--pseudo">

                
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'priceDiscountLabel','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'priceDiscountLabel','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'priceDiscountLabel','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                

                <span class="price--discount is--nowrap">
                    <?php echo smarty_modifier_currency($_smarty_tpl->tpl_vars['sArticle']->value['pseudoprice']);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'Star','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
*<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'Star','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </span>

                
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'priceDiscountInfo','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'priceDiscountInfo','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'priceDiscountInfo','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                
            </span>
        <?php }?>
    
</div>
<?php }} ?>