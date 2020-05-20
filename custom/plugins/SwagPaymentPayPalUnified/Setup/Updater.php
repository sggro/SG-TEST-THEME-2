<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\Setup;

use Doctrine\DBAL\Connection;
use Shopware\Bundle\AttributeBundle\Service\CrudService;
use Shopware\Components\Model\ModelManager;
use SwagPaymentPayPalUnified\Models\Settings\General as GeneralSettingsModel;

class Updater
{
    /**
     * @var CrudService
     */
    private $attributeCrudService;

    /**
     * @var ModelManager
     */
    private $modelManager;

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(CrudService $attributeCrudService, ModelManager $modelManager, Connection $connection)
    {
        $this->attributeCrudService = $attributeCrudService;
        $this->modelManager = $modelManager;
        $this->connection = $connection;
    }

    /**
     * @param string $oldVersion
     */
    public function update($oldVersion)
    {
        if (version_compare($oldVersion, '1.0.2', '<=')) {
            $this->updateTo103();
        }

        if (version_compare($oldVersion, '1.0.7', '<=')) {
            $this->updateTo110();
        }

        if (version_compare($oldVersion, '1.1.0', '<=')) {
            $this->updateTo111();
        }

        if (version_compare($oldVersion, '1.1.1', '<=')) {
            $this->updateTo112();
        }

        if (version_compare($oldVersion, '2.0.3', '<=')) {
            $this->updateTo210();
        }

        if (version_compare($oldVersion, '2.1.3', '<=')) {
            $this->updateTo220();
        }

        if (version_compare($oldVersion, '2.3.0', '<=')) {
            $this->updateTo240();
        }

        if (version_compare($oldVersion, '2.4.1', '<=')) {
            $this->updateTo250();
        }

        if (version_compare($oldVersion, '2.6.0', '<=')) {
            $this->updateTo261();
        }
    }

    private function updateTo103()
    {
        $this->attributeCrudService->update(
            's_core_paymentmeans_attributes',
            'swag_paypal_unified_plus_iframe_payment_logo',
            'string',
            [
                'position' => -99,
                'displayInBackend' => true,
                'label' => 'Payment logo for iFrame',
                'helpText' => 'Simply put an URL to an image here, if you want to show a logo for this payment in the PayPal Plus iFrame.<br><ul><li>The URL must be secure (https)</li><li>The image size must be maximum 100x25px</li></ul>',
            ]
        );

        $this->modelManager->generateAttributeModels(['s_core_paymentmeans_attributes']);
    }

    private function updateTo110()
    {
        if (!$this->checkIfColumnExist('swag_payment_paypal_unified_settings_general', 'landing_page_type')) {
            $sql = 'ALTER TABLE `swag_payment_paypal_unified_settings_general`
                    ADD COLUMN `landing_page_type` VARCHAR(255);
                    UPDATE `swag_payment_paypal_unified_settings_general`
                    SET `landing_page_type` = "Login";';

            $this->connection->executeQuery($sql);
        }
    }

    private function updateTo111()
    {
        if ($this->checkIfColumnExist('swag_payment_paypal_unified_settings_general', 'logo_image')) {
            $sql = 'ALTER TABLE `swag_payment_paypal_unified_settings_general`
                    DROP COLUMN `logo_image`;';

            $this->connection->executeQuery($sql);
        }
    }

    private function updateTo112()
    {
        if (!$this->checkIfColumnExist('swag_payment_paypal_unified_settings_express', 'off_canvas_active')) {
            $sql = 'ALTER TABLE `swag_payment_paypal_unified_settings_express`
                ADD `off_canvas_active` TINYINT(1) NOT NULL;
                UPDATE `swag_payment_paypal_unified_settings_express`
                SET `off_canvas_active` = 1;';

            $this->connection->executeQuery($sql);
        }
    }

    private function updateTo210()
    {
        if (!$this->checkIfColumnExist('swag_payment_paypal_unified_settings_express', 'listing_active')) {
            $sql = 'ALTER TABLE `swag_payment_paypal_unified_settings_express`
                ADD `listing_active` TINYINT(1) NOT NULL;
                UPDATE `swag_payment_paypal_unified_settings_express`
                SET `listing_active` = 0;';

            $this->connection->executeQuery($sql);
        }
    }

    private function updateTo220()
    {
        if (!$this->checkIfColumnExist('swag_payment_paypal_unified_settings_express', 'button_locale')) {
            $sql = "ALTER TABLE `swag_payment_paypal_unified_settings_express`
                ADD `button_locale` VARCHAR(5) NOT NULL;
                UPDATE `swag_payment_paypal_unified_settings_express`
                SET `button_locale` = '';";

            $this->connection->executeQuery($sql);
        }
    }

    private function updateTo240()
    {
        if (!$this->checkIfColumnExist('swag_payment_paypal_unified_settings_general', 'use_smart_payment_buttons')) {
            $query = <<<SQL
ALTER TABLE `swag_payment_paypal_unified_settings_general`
ADD `use_smart_payment_buttons` TINYINT(1) NOT NULL,
ADD `merchant_location` VARCHAR(255) NOT NULL;
UPDATE `swag_payment_paypal_unified_settings_general`
SET `use_smart_payment_buttons` = 0, `merchant_location` = :location;
SQL;

            $this->connection->executeQuery($query, ['location' => GeneralSettingsModel::MERCHANT_LOCATION_GERMANY]);
        }
    }

    private function updateTo250()
    {
        if (!$this->checkIfColumnExist('swag_payment_paypal_unified_settings_general', 'submit_cart')) {
            $query = <<<SQL
ALTER TABLE `swag_payment_paypal_unified_settings_general`
ADD `submit_cart` TINYINT(1) NOT NULL;
UPDATE `swag_payment_paypal_unified_settings_general`
SET `submit_cart` = 1;
SQL;

            $this->connection->executeQuery($query);
        }
    }

    private function updateTo261()
    {
        if (!$this->checkIfColumnExist('swag_payment_paypal_unified_settings_general', 'advertise_installments')) {
            $query = <<<SQL
ALTER TABLE `swag_payment_paypal_unified_settings_general`
ADD `advertise_installments` TINYINT(1) NOT NULL;
UPDATE `swag_payment_paypal_unified_settings_general`
SET `advertise_installments` = 1;
SQL;

            $this->connection->executeQuery($query);
        }
    }

    /**
     * Helper function to check if a column exists which is needed during update
     *
     * @param string $tableName
     * @param string $columnName
     *
     * @return bool
     */
    private function checkIfColumnExist($tableName, $columnName)
    {
        $sql = <<<SQL
SELECT column_name
FROM information_schema.columns
WHERE table_name = :tableName
    AND column_name = :columnName
    AND table_schema = DATABASE();
SQL;

        $columnNameInDb = $this->connection->executeQuery(
            $sql,
            ['tableName' => $tableName, 'columnName' => $columnName]
        )->fetchColumn();

        return $columnNameInDb === $columnName;
    }
}
