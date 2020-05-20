<?php

namespace SGTestTheme;

use Shopware\Components\Model\ModelManager;
//use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Shopware\Models\Emotion\Library\Component;
use Shopware\Models\Plugin\Plugin;


class SGTestTheme extends \Shopware\Components\Plugin
{

    public function install(InstallContext $context)
    {
        $component = $this->createEmotionComponent($context->getPlugin(), [
            'name' => 'Zwei Bilder Ein Text',
            'xtype' => 'emotion-components-base',
            'template' => 'component_two_images_one_text',
            'cls' => 'two-images-one-text',
            'description' => 'Zeigt 2 Bilder mit einem Textbox an.',
        ]);

        $component->createTextField([
            'name' => 'titel',
            'fieldLabel' => 'Titel',
            'allowBlank' => true,
        ]);

        $component->createMediaField([
            'name' => 'left_image',
            'fieldLabel' => 'Linkes Bild',
            'valueField' => 'path',
        ]);

        $component->createMediaField([
            'name' => 'right_image',
            'fieldLabel' => 'Rechtes Bild',
            'valueField' => 'path',
        ]);

        $component->createTextField([
            'name' => 'descriptionTitel',
            'fieldLabel' => 'Beschreibung Titel',
            'allowBlank' => true,
        ]);

        $component->createTextAreaField([
            'name' => 'description',
            'fieldLabel' => 'Beschreibung',
            'allowBlank' => true,
        ]);

        $component->createTextField([
            'name' => 'readMoreLink',
            'fieldLabel' => 'Mehr Lesen Link',
            'allowBlank' => true,
        ]);

        $component->createTextField([
            'name' => 'goShoppingLink',
            'fieldLabel' => 'Jetzt Shoppen Link',
            'allowBlank' => true,
        ]);

        /** @var ModelManager $em */
        $em = $this->container->get('models');
        $em->persist($component);
        $em->flush();
    }

    public function uninstall(UninstallContext $context)
    {
        $em = $this->container->get('models');
        $component = $em->getRepository(Component::class)->findOneBy([
            'name' => 'Zwei Bilder Ein Text',
            'pluginId' => $context->getPlugin()->getId()
        ]);

        if(!$component){
            return;
        }
        $em->remove($component);
        $em->flush();
    }

    /**
     * @param $options
     * @param Plugin $pluginModel
     * @return Component
     */
    protected function createEmotionComponent(Plugin $pluginModel, $options)
    {
        /** @var ModelManager $em */
        $em = $this->container->get('models');

        // if a componentn with this name already exists for this plugin, use that
        $component = $em->getRepository(Component::class)->findOneBy([
            'name' => $options['name'],
            'pluginId' => $pluginModel->getId()
        ]);

        //else: create a new component
        if (!$component) {
            $component = new Component();
        }

        $component->fromArray($options);

        $component->setPluginId($pluginModel->getId());
        $component->setPlugin($pluginModel);

        return $component;
    }
}