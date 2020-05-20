<?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 11:26:39
         compiled from "/var/www/html/custom/plugins/SGTestTheme/Resources/Views/emotion_components/widgets/emotion/components/component_two_images_one_text.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14323703405ebbbd4fcfd664-00563754%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d9dd0d23bce1562adfb03a641ae0bfe0751cf56' => 
    array (
      0 => '/var/www/html/custom/plugins/SGTestTheme/Resources/Views/emotion_components/widgets/emotion/components/component_two_images_one_text.tpl',
      1 => 1588235631,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14323703405ebbbd4fcfd664-00563754',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Data' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ebbbd4fd00180_65966382',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ebbbd4fd00180_65966382')) {function content_5ebbbd4fd00180_65966382($_smarty_tpl) {?>
    <div class="sg-test-theme-tiot-ewe">
        <div class="container">
            <div class="sg-test-theme-tiot-titel"><?php echo $_smarty_tpl->tpl_vars['Data']->value['titel'];?>
</div>
            <div class="sg-test-theme-tiot-left-image">
                <img src="<?php echo $_smarty_tpl->tpl_vars['Data']->value['left_image'];?>
" />
            </div>
            <div class="sg-test-theme-tiot-right-image">
                <img src="<?php echo $_smarty_tpl->tpl_vars['Data']->value['right_image'];?>
" />
            </div>
            <div class="sg-test-theme-tiot-description-wrapper">
                <div class="sg-test-theme-tiot-description-titel"><?php echo $_smarty_tpl->tpl_vars['Data']->value['descriptionTitel'];?>
</div>
                <div class="sg-test-theme-tiot-description"><?php echo $_smarty_tpl->tpl_vars['Data']->value['description'];?>
</div>
                <div class="sg-test-theme-tiot-links-wrapper">
                    <div class="sg-test-theme-tiot-link-wrapper sg-test-theme-tiot-read-more-wrapper">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['Data']->value['readMoreLink'];?>
" target="_blank">
                            <div class="sg-test-theme-tiot-link-icon">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                            Mehr lesen
                        </a>
                    </div>
                    <div class="sg-test-theme-tiot-link-wrapper sg-test-theme-tiot-go-shopping-wrapper">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['Data']->value['goShoppingLink'];?>
" target="_blank">
                            <div class="sg-test-theme-tiot-link-icon">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                            Jetzt Shoppen
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }} ?>