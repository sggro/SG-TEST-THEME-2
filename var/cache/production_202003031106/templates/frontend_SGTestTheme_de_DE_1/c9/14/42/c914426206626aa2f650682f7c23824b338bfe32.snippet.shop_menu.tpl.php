<?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 11:26:38
         compiled from "/var/www/html/custom/plugins/SGTestTheme/Resources/Themes/Frontend/SGTestTheme/widgets/index/shop_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9414839525ebbbd4e5e9d38-18303737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c914426206626aa2f650682f7c23824b338bfe32' => 
    array (
      0 => '/var/www/html/custom/plugins/SGTestTheme/Resources/Themes/Frontend/SGTestTheme/widgets/index/shop_menu.tpl',
      1 => 1587736923,
      2 => 'file',
    ),
    'b21ec8726d2d4df5c44493fadcf5fd37a55801ec' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/widgets/index/shop_menu.tpl',
      1 => 1583233580,
      2 => 'parent',
    ),
  ),
  'nocache_hash' => '9414839525ebbbd4e5e9d38-18303737',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shop' => 0,
    'languages' => 0,
    'language' => 0,
    'currencies' => 0,
    'currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ebbbd4e5fab68_23534568',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ebbbd4e5fab68_23534568')) {function content_5ebbbd4e5fab68_23534568($_smarty_tpl) {?>

    <?php if ($_smarty_tpl->tpl_vars['shop']->value&&count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
        <div class="top-bar--language navigation--entry">
            
                <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                    <form method="post" class="language--form">
                        
    <div class="field--select">
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'widgets/index/shop_menu','name'=>'sgLanguageSwitcherLabel','default'=>'Land auswählen:')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'widgets/index/shop_menu','name'=>'sgLanguageSwitcherLabel','default'=>'Land auswählen:'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Land auswählen:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'widgets/index/shop_menu','name'=>'sgLanguageSwitcherLabel','default'=>'Land auswählen:'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        
            <select name="__shop" class="language--select" data-auto-submit="true">
                    <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['language']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['language']->value->getId()===$_smarty_tpl->tpl_vars['shop']->value->getId()){?>selected="selected"<?php }?>>
                            <?php echo $_smarty_tpl->tpl_vars['language']->value->getName();?>

                        </option>
                    <?php } ?>
            </select>
        
        <input type="hidden" name="__redirect" value="1">
        
        <span class="arrow"></span>
        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
    </div>

                    </form>
                <?php }?>
            
        </div>
    <?php }?>




    <?php if (count($_smarty_tpl->tpl_vars['currencies']->value)>1){?>
        <div class="top-bar--currency navigation--entry">
            
                <form method="post" class="currency--form">
                    
                        <div class="field--select">
                            
                                <div class="select-field">
                                    <select name="__currency" class="currency--select" data-auto-submit="true">
                                        <?php  $_smarty_tpl->tpl_vars['currency'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['currencies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency']->key => $_smarty_tpl->tpl_vars['currency']->value){
$_smarty_tpl->tpl_vars['currency']->_loop = true;
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['currency']->value->getId();?>
"<?php if ($_smarty_tpl->tpl_vars['currency']->value->getId()===$_smarty_tpl->tpl_vars['shop']->value->getCurrency()->getId()){?> selected="selected"<?php }?>>
                                                <?php if ($_smarty_tpl->tpl_vars['currency']->value->getSymbol()!=$_smarty_tpl->tpl_vars['currency']->value->getCurrency()){?><?php echo $_smarty_tpl->tpl_vars['currency']->value->getSymbol();?>
 <?php }?><?php echo $_smarty_tpl->tpl_vars['currency']->value->getCurrency();?>

                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            
                        </div>
                    
                </form>
            
        </div>
    <?php }?>

<?php }} ?>