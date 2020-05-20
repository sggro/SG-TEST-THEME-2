<?php

namespace Shopware\Themes\SGTestTheme;

use Shopware\Components\Form as Form;

class Theme extends \Shopware\Components\Theme
{
    protected $extend = 'Responsive';

    protected $name = <<<'SHOPWARE_EOD'
SGTestTheme
SHOPWARE_EOD;

    protected $description = <<<'SHOPWARE_EOD'

SHOPWARE_EOD;

    protected $author = <<<'SHOPWARE_EOD'

SHOPWARE_EOD;

    protected $license = <<<'SHOPWARE_EOD'

SHOPWARE_EOD;

    protected $css = [
        'src/css/font-awesome.min.css'
    ];

    public function createConfig(Form\Container\TabContainer $container)
    {
        $navigationLineHeightMobileField = $this->createTextField(
          'sg-navigation-line-height-mobile',
            'Line Height Mobile',
            '63'
        );

        $navigationLineHeightField = $this->createTextField(
            'sg-navigation-line-height',
            'Line Height',
            '72'
        );

        $navigationLogoHeightField = $this->createTextField(
            'sg-navigation-logo-height',
            'Logo Height',
            '63'
        );

        $socialMediaInstagramField = $this->createTextField(
            'sgSocialMediaInstagramLink',
            'Instagram Link',
            ''
        );

        $socialMediaFacebookField = $this->createTextField(
            'sgSocialMediaFacebookLink',
            'Facebook Link',
            ''
        );

        $socialMediaTwitterField = $this->createTextField(
            'sgSocialMediaTwitterLink',
            'Twitter Link',
            ''
        );

        $socialMediaYoutubeField = $this->createTextField(
            'sgSocialMediaYoutubeLink',
            'Youtube Link',
            ''
        );

        $headerFieldSet = $this->createFieldSet(
            'sg-test-header-fieldset',
            'Header'
        );

        $socialMediaFieldSet = $this->createFieldSet(
            'sg_test_social_media_fieldset',
            'Soziale Netzwerke'
        );

        $sgTestThemeTab = $this->createTab(
            'sg-test-theme',
            'SG Test Theme'
        );

        $headerFieldSet->addElement($navigationLineHeightMobileField);
        $headerFieldSet->addElement($navigationLineHeightField);
        $headerFieldSet->addElement($navigationLogoHeightField);

        $socialMediaFieldSet->addElement($socialMediaInstagramField);
        $socialMediaFieldSet->addElement($socialMediaFacebookField);
        $socialMediaFieldSet->addElement($socialMediaTwitterField);
        $socialMediaFieldSet->addElement($socialMediaYoutubeField);

        $sgTestThemeTab->addElement($headerFieldSet);
        $sgTestThemeTab->addElement($socialMediaFieldSet);

        $container->addTab($sgTestThemeTab);
    }
}