<?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 11:26:39
         compiled from "/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/box-emotion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:577998415ebbbd4fd9ced7-53339911%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b24624b5806de2f86cd9f8a41f1733982fb80dea' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/box-emotion.tpl',
      1 => 1583233580,
      2 => 'file',
    ),
    'd8c581d08ad7e50036d791bb6ff304a88e99b478' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-badges.tpl',
      1 => 1583233580,
      2 => 'snippet',
    ),
    '58d23cf599cda659ab01e7ae8df78e08da36a81d' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-price-unit.tpl',
      1 => 1583233580,
      2 => 'snippet',
    ),
    '59fd2a9c510af33e24c2810f3222a75ced6d10bb' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-price.tpl',
      1 => 1583233580,
      2 => 'snippet',
    ),
  ),
  'nocache_hash' => '577998415ebbbd4fd9ced7-53339911',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'productBoxLayout' => 0,
    'sArticle' => 0,
    'productName' => 0,
    'imageOnly' => 0,
    'element' => 0,
    'fixedImageSize' => 0,
    'viewport' => 1,
    'cols' => 0,
    'cellWidth' => 1,
    'elementSize' => 1,
    'breakpoints' => 1,
    'emotionFullscreen' => 1,
    'baseWidth' => 1,
    'size' => 1,
    'itemSize' => 1,
    'srcSet' => 0,
    'image' => 0,
    'srcSetRetina' => 0,
    'desc' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ebbbd4fdd6d26_06368778',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ebbbd4fdd6d26_06368778')) {function content_5ebbbd4fdd6d26_06368778($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/html/engine/Library/Smarty/plugins/modifier.truncate.php';
?>


    <div class="product--box box--<?php echo $_smarty_tpl->tpl_vars['productBoxLayout']->value;?>
" data-ordernumber="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['ordernumber'];?>
">

        
            <?php $_smarty_tpl->tpl_vars['productName'] = new Smarty_variable($_smarty_tpl->tpl_vars['sArticle']->value['articleName'], null, 0);?>
            <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['additionaltext']){?>
                <?php $_smarty_tpl->tpl_vars['productName'] = new Smarty_variable((($_smarty_tpl->tpl_vars['productName']->value).(' ')).($_smarty_tpl->tpl_vars['sArticle']->value['additionaltext']), null, 0);?>
            <?php }?>
        

        
            <div class="box--content">

                
                
                    <?php if (!$_smarty_tpl->tpl_vars['imageOnly']->value){?>
                        <?php /*  Call merged included template "frontend/listing/product-box/product-badges.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("frontend/listing/product-box/product-badges.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '577998415ebbbd4fd9ced7-53339911');
content_5ebbbd4fda1961_25869271($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "frontend/listing/product-box/product-badges.tpl" */?>
                    <?php }?>
                

                
                    <div class="product--info">

                        
                        
                            <a href="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['linkDetails'];?>
"
                               title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productName']->value, ENT_QUOTES, 'utf-8', true);?>
"
                               class="product--image<?php if ($_smarty_tpl->tpl_vars['imageOnly']->value){?> is--large<?php }?>">

                                
                                    <span class="image--element">

                                        
                                            <span class="image--media">

                                                

                                                    <?php $_smarty_tpl->tpl_vars['desc'] = new Smarty_variable(htmlspecialchars($_smarty_tpl->tpl_vars['productName']->value, ENT_QUOTES, 'utf-8', true), null, 0);?>

                                                    <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['image']['description']){?>
                                                        <?php $_smarty_tpl->tpl_vars['desc'] = new Smarty_variable(htmlspecialchars($_smarty_tpl->tpl_vars['sArticle']->value['image']['description'], ENT_QUOTES, 'utf-8', true), null, 0);?>
                                                    <?php }?>

                                                    <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['image']['thumbnails']){?>

                                                        <?php if ($_smarty_tpl->tpl_vars['element']->value['viewports']&&!$_smarty_tpl->tpl_vars['fixedImageSize']->value){?>
                                                            <?php  $_smarty_tpl->tpl_vars['viewport'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['viewport']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['viewports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['viewport']->key => $_smarty_tpl->tpl_vars['viewport']->value){
$_smarty_tpl->tpl_vars['viewport']->_loop = true;
?>
                                                                <?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable(($_smarty_tpl->tpl_vars['viewport']->value['endCol']-$_smarty_tpl->tpl_vars['viewport']->value['startCol'])+1, null, 0);?>
                                                                <?php $_smarty_tpl->tpl_vars['elementSize'] = new Smarty_variable($_smarty_tpl->tpl_vars['cols']->value*$_smarty_tpl->tpl_vars['cellWidth']->value, true, 0);?>
                                                                <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['elementSize']->value)."vw", true, 0);?>

                                                                <?php if ($_smarty_tpl->tpl_vars['breakpoints']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]){?>

                                                                    <?php if ($_smarty_tpl->tpl_vars['viewport']->value['alias']==='xl'&&!$_smarty_tpl->tpl_vars['emotionFullscreen']->value){?>
                                                                        <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("calc(".((string)($_smarty_tpl->tpl_vars['elementSize']->value/100))." * ".((string)$_smarty_tpl->tpl_vars['baseWidth']->value)."px)", true, 0);?>
                                                                        <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("(min-width: ".((string)$_smarty_tpl->tpl_vars['baseWidth']->value)."px) ".((string)$_smarty_tpl->tpl_vars['size']->value), true, 0);?>
                                                                    <?php }else{ ?>
                                                                        <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("(min-width: ".((string)$_smarty_tpl->tpl_vars['breakpoints']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]).") ".((string)$_smarty_tpl->tpl_vars['size']->value), true, 0);?>
                                                                    <?php }?>
                                                                <?php }?>

                                                                <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['itemSize']->value){?><?php echo ", ";?><?php echo (string)$_smarty_tpl->tpl_vars['itemSize']->value;?><?php }?><?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['itemSize'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['size']->value).$_tmp1, true, 0);?>
                                                            <?php } ?>
                                                        <?php }else{ ?>
                                                            <?php $_smarty_tpl->tpl_vars['itemSize'] = new Smarty_variable("200px", null, 0);?>
                                                        <?php }?>

                                                        <?php $_smarty_tpl->tpl_vars['srcSet'] = new Smarty_variable('', null, 0);?>
                                                        <?php $_smarty_tpl->tpl_vars['srcSetRetina'] = new Smarty_variable('', null, 0);?>

                                                        <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sArticle']->value['image']['thumbnails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                                                            <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['srcSet']->value){?><?php echo (string)$_smarty_tpl->tpl_vars['srcSet']->value;?><?php echo ", ";?><?php }?><?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['srcSet'] = new Smarty_variable($_tmp2.((string)$_smarty_tpl->tpl_vars['image']->value['source'])." ".((string)$_smarty_tpl->tpl_vars['image']->value['maxWidth'])."w", null, 0);?>

                                                            <?php if ($_smarty_tpl->tpl_vars['image']->value['retinaSource']){?>
                                                                <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['srcSetRetina']->value){?><?php echo (string)$_smarty_tpl->tpl_vars['srcSetRetina']->value;?><?php echo ", ";?><?php }?><?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['srcSetRetina'] = new Smarty_variable($_tmp3.((string)$_smarty_tpl->tpl_vars['image']->value['retinaSource'])." ".((string)($_smarty_tpl->tpl_vars['image']->value['maxWidth']*2))."w", null, 0);?>
                                                            <?php }?>
                                                        <?php } ?>

                                                        <picture>
                                                            <source sizes="<?php echo $_smarty_tpl->tpl_vars['itemSize']->value;?>
" srcset="<?php echo $_smarty_tpl->tpl_vars['srcSetRetina']->value;?>
" media="(min-resolution: 192dpi)" />
                                                            <source sizes="<?php echo $_smarty_tpl->tpl_vars['itemSize']->value;?>
" srcset="<?php echo $_smarty_tpl->tpl_vars['srcSet']->value;?>
" />

                                                            <img src="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['image']['thumbnails'][0]['source'];?>
" alt="<?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['desc']->value),160);?>
" />
                                                        </picture>

                                                    <?php }elseif($_smarty_tpl->tpl_vars['sArticle']->value['image']['source']){?>
                                                        <img src="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['image']['source'];?>
" alt="<?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['desc']->value),160);?>
" />
                                                    <?php }else{ ?>
                                                        <img src="/themes/Frontend/Responsive/frontend/_public/src/img/no-picture.jpg" alt="<?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['desc']->value),160);?>
" />
                                                    <?php }?>
                                                
                                            </span>
                                        
                                    </span>
                                
                            </a>
                        

                        <?php if (!$_smarty_tpl->tpl_vars['imageOnly']->value){?>
                            <div class="product--details">

                                
                                
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['linkDetails'];?>
"
                                       class="product--title"
                                       title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escapeHtml'][0][0]->escapeHtml($_smarty_tpl->tpl_vars['productName']->value);?>
">
                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escapeHtml'][0][0]->escapeHtml(smarty_modifier_truncate($_smarty_tpl->tpl_vars['productName']->value,50));?>

                                    </a>
                                

                                
                                    <div class="product--price-info">

                                        
                                        
                                            <?php /*  Call merged included template "frontend/listing/product-box/product-price-unit.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("frontend/listing/product-box/product-price-unit.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '577998415ebbbd4fd9ced7-53339911');
content_5ebbbd4fdc2d69_39879438($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "frontend/listing/product-box/product-price-unit.tpl" */?>
                                        

                                        
                                        
                                            <?php /*  Call merged included template "frontend/listing/product-box/product-price.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("frontend/listing/product-box/product-price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '577998415ebbbd4fd9ced7-53339911');
content_5ebbbd4fdcf859_34776543($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "frontend/listing/product-box/product-price.tpl" */?>
                                        
                                    </div>
                                
                            </div>
                        <?php }?>
                    </div>
                
            </div>
        
    </div>

<?php }} ?><?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 11:26:39
         compiled from "/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-badges.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5ebbbd4fda1961_25869271')) {function content_5ebbbd4fda1961_25869271($_smarty_tpl) {?>



    <div class="product--badges">
                

            
            
                <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['has_pseudoprice']){?>
                    <div class="product--badge badge--discount">
                        <i class="icon--percent2"></i>
                    </div>
                <?php }?>
            

            
            
                <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['highlight']){?>
                    <div class="product--badge badge--recommend">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ListingBoxTip','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxTip','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
TIPP!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxTip','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    </div>
                <?php }?>
            

            
            
                <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['newArticle']){?>
                    <div class="product--badge badge--newcomer">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ListingBoxNew','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxNew','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NEU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxNew','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    </div>
                <?php }?>
            

            
            
                <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['esd']){?>
                    <div class="product--badge badge--esd">
                        <i class="icon--download"></i>
                    </div>
                <?php }?>
            

        
    </div>

<?php }} ?><?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 11:26:39
         compiled from "/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-price-unit.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5ebbbd4fdc2d69_39879438')) {function content_5ebbbd4fdc2d69_39879438($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_currency')) include '/var/www/html/engine/Library/Enlight/Template/Plugins/modifier.currency.php';
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

        
        
            <span class="price--label label--purchase-unit is--bold is--nowrap">
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ListingBoxArticleContent','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleContent','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Inhalt<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleContent','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

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
<?php }} ?><?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 11:26:39
         compiled from "/var/www/html/themes/Frontend/Bare/frontend/listing/product-box/product-price.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5ebbbd4fdcf859_34776543')) {function content_5ebbbd4fdcf859_34776543($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_currency')) include '/var/www/html/engine/Library/Enlight/Template/Plugins/modifier.currency.php';
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