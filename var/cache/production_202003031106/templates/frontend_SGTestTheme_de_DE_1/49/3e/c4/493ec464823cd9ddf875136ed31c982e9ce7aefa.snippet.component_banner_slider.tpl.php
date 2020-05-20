<?php /* Smarty version Smarty-3.1.12, created on 2020-05-13 11:26:39
         compiled from "/var/www/html/custom/plugins/SGTestTheme/Resources/Themes/Frontend/SGTestTheme/widgets/emotion/components/component_banner_slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1468482175ebbbd4fce36e5-64015362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '493ec464823cd9ddf875136ed31c982e9ce7aefa' => 
    array (
      0 => '/var/www/html/custom/plugins/SGTestTheme/Resources/Themes/Frontend/SGTestTheme/widgets/emotion/components/component_banner_slider.tpl',
      1 => 1588005457,
      2 => 'file',
    ),
    '0b539a1160e8e29194da728abae87eb5efe13d37' => 
    array (
      0 => '/var/www/html/themes/Frontend/Bare/widgets/emotion/components/component_banner_slider.tpl',
      1 => 1583233580,
      2 => 'parent',
    ),
  ),
  'nocache_hash' => '1468482175ebbbd4fce36e5-64015362',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Data' => 1,
    'banner' => 1,
    'element' => 1,
    'viewport' => 1,
    'cols' => 1,
    'cellWidth' => 1,
    'elementSize' => 1,
    'breakpoints' => 1,
    'emotionFullscreen' => 1,
    'baseWidth' => 1,
    'size' => 1,
    'itemSize' => 1,
    'srcSet' => 1,
    'image' => 1,
    'baseSource' => 1,
    'altText' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ebbbd4fcfb6c0_09715566',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ebbbd4fcfb6c0_09715566')) {function content_5ebbbd4fcfb6c0_09715566($_smarty_tpl) {?>
    <div class="sg-emotion--banner-slider">
    
    <div class="emotion--banner-slider image-slider"
         data-image-slider="true"
         data-thumbnails="false"
         data-lightbox="false"
         data-loopSlides="true"
         data-animationSpeed="<?php echo $_smarty_tpl->tpl_vars['Data']->value['banner_slider_scrollspeed'];?>
"
         data-arrowControls="<?php if ($_smarty_tpl->tpl_vars['Data']->value['banner_slider_arrows']){?>true<?php }else{ ?>false<?php }?>"
         data-autoSlideInterval="<?php echo $_smarty_tpl->tpl_vars['Data']->value['banner_slider_rotatespeed'];?>
"
         data-autoSlide="<?php if ($_smarty_tpl->tpl_vars['Data']->value['banner_slider_rotation']){?>true<?php }else{ ?>false<?php }?>"
         data-imageSelector=".image-slider--item">

        <?php if ($_smarty_tpl->tpl_vars['Data']->value['banner_slider_title']){?>
            <div class="banner-slider--title"><?php echo $_smarty_tpl->tpl_vars['Data']->value['banner_slider_title'];?>
</div>
        <?php }?>

        
            <div class="banner-slider--container image-slider--container">

                
                    <div class="banner-slider--slide image-slider--slide">

                        <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banner']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Data']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>
                            
                                <div class="banner-slider--item image-slider--item"
                                     data-coverImage="true"
                                     data-containerSelector=".banner-slider--banner"
                                     data-width="<?php echo $_smarty_tpl->tpl_vars['banner']->value['fileInfo']['width'];?>
"
                                     data-height="<?php echo $_smarty_tpl->tpl_vars['banner']->value['fileInfo']['height'];?>
">

                                    
                                        <div class="banner-slider--banner">

                                            
                                                <?php $_smarty_tpl->tpl_vars['srcSet'] = new Smarty_variable('', true, 0);?>
                                                <?php $_smarty_tpl->tpl_vars['itemSize'] = new Smarty_variable('', true, 0);?>

                                                <?php if ($_smarty_tpl->tpl_vars['banner']->value['thumbnails']){?>
                                                    <?php $_smarty_tpl->tpl_vars['baseSource'] = new Smarty_variable($_smarty_tpl->tpl_vars['banner']->value['thumbnails'][0]['source'], true, 0);?>

                                                    <?php  $_smarty_tpl->tpl_vars['viewport'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['viewport']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['viewports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['viewport']->key => $_smarty_tpl->tpl_vars['viewport']->value){
$_smarty_tpl->tpl_vars['viewport']->_loop = true;
?>
                                                        <?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable(($_smarty_tpl->tpl_vars['viewport']->value['endCol']-$_smarty_tpl->tpl_vars['viewport']->value['startCol'])+1, true, 0);?>
                                                        <?php $_smarty_tpl->tpl_vars['elementSize'] = new Smarty_variable($_smarty_tpl->tpl_vars['cols']->value*$_smarty_tpl->tpl_vars['cellWidth']->value, true, 0);?>
                                                        <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['elementSize']->value)."vw", true, 0);?>

                                                        <?php if ($_smarty_tpl->tpl_vars['breakpoints']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]){?>

                                                            <?php if ($_smarty_tpl->tpl_vars['viewport']->value['alias']==='xl'&&!$_smarty_tpl->tpl_vars['emotionFullscreen']->value){?>
                                                                <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("calc(".((string)($_smarty_tpl->tpl_vars['elementSize']->value/100))." * ".((string)$_smarty_tpl->tpl_vars['baseWidth']->value)."px)", true, 0);?>
                                                            <?php }?>

                                                            <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("(min-width: ".((string)$_smarty_tpl->tpl_vars['breakpoints']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]).") ".((string)$_smarty_tpl->tpl_vars['size']->value), true, 0);?>
                                                        <?php }?>

                                                        <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['itemSize']->value){?><?php echo ", ";?><?php echo (string)$_smarty_tpl->tpl_vars['itemSize']->value;?><?php }?><?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['itemSize'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['size']->value).$_tmp1, true, 0);?>
                                                    <?php } ?>

                                                    <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banner']->value['thumbnails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                                                        <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['srcSet']->value){?><?php echo (string)$_smarty_tpl->tpl_vars['srcSet']->value;?><?php echo ", ";?><?php }?><?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['srcSet'] = new Smarty_variable($_tmp2.((string)$_smarty_tpl->tpl_vars['image']->value['source'])." ".((string)$_smarty_tpl->tpl_vars['image']->value['maxWidth'])."w", true, 0);?>

                                                        <?php if ($_smarty_tpl->tpl_vars['image']->value['retinaSource']){?>
                                                            <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['srcSet']->value){?><?php echo (string)$_smarty_tpl->tpl_vars['srcSet']->value;?><?php echo ", ";?><?php }?><?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['srcSet'] = new Smarty_variable($_tmp3.((string)$_smarty_tpl->tpl_vars['image']->value['retinaSource'])." ".((string)($_smarty_tpl->tpl_vars['image']->value['maxWidth']*2))."w", true, 0);?>
                                                        <?php }?>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                    <?php $_smarty_tpl->tpl_vars['baseSource'] = new Smarty_variable($_smarty_tpl->tpl_vars['banner']->value['source'], true, 0);?>
                                                <?php }?>

                                                <?php if ($_smarty_tpl->tpl_vars['banner']->value['altText']){?>
                                                    <?php $_smarty_tpl->tpl_vars['altText'] = new Smarty_variable($_smarty_tpl->tpl_vars['banner']->value['altText'], true, 0);?>
                                                <?php }elseif($_smarty_tpl->tpl_vars['banner']->value['title']){?>
                                                    <?php $_smarty_tpl->tpl_vars['altText'] = new Smarty_variable($_smarty_tpl->tpl_vars['banner']->value['title'], true, 0);?>
                                                <?php }else{ ?>
                                                    <?php $_smarty_tpl->tpl_vars['altText'] = new Smarty_variable($_smarty_tpl->tpl_vars['banner']->value['link'], true, 0);?>
                                                <?php }?>

                                                <img src="<?php echo $_smarty_tpl->tpl_vars['baseSource']->value;?>
"
                                                     class="banner-slider--image"
                                                     <?php if ($_smarty_tpl->tpl_vars['srcSet']->value){?>sizes="<?php echo $_smarty_tpl->tpl_vars['itemSize']->value;?>
" srcset="<?php echo $_smarty_tpl->tpl_vars['srcSet']->value;?>
"<?php }?>
                                                     alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['altText']->value, ENT_QUOTES, 'utf-8', true);?>
" />
                                            
                                        </div>
                                    

                                    <?php if ($_smarty_tpl->tpl_vars['banner']->value['link']){?>
                                        
                                            <a class="banner-slider--link" href="<?php echo $_smarty_tpl->tpl_vars['banner']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['banner']->value['title'], ENT_QUOTES, 'utf-8', true);?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['banner']->value['altText'];?>

                                            </a>
                                        
                                    <?php }?>
                                </div>
                            
                        <?php } ?>
                    </div>
                

                
                    <?php if ($_smarty_tpl->tpl_vars['Data']->value['banner_slider_numbers']){?>
                        <div class="image-slider--dots force--3d">
                            <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Data']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['link']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
 $_smarty_tpl->tpl_vars['link']->iteration++;
?>
                                <div class="dot--link"><?php echo $_smarty_tpl->tpl_vars['link']->iteration;?>
</div>
                            <?php } ?>
                        </div>
                    <?php }?>
                
            </div>
        
    </div>

    </div>

<?php }} ?>