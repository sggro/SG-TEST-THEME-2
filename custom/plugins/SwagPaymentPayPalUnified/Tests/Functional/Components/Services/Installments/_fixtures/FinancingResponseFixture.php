<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'configuration_owner_account' => 'YFU4VLGHM29JA',
    'financing_fee_charged_to_separate_account' => false,
    'financing_options' => [
        [
            'qualifying_financing_options' => [
                [
                    'credit_financing' => [
                        'financing_code' => 'KBDJWP7U6B',
                        'apr' => '15', //Item with highest APR. This should be marked with a star in the tests.
                        'nominal_rate' => '0.0000',
                        'term' => 6,
                        'country_code' => 'DE',
                        'credit_type' => 'INST',
                        'vendor_financing_id' => '6006',
                        'enabled' => true,
                        'links' => [
                            [
                                'href' => 'v1/credit/credit-financing/KBDJWP7U6B',
                                'rel' => 'self',
                                'method' => 'GET',
                            ],
                        ],
                    ],
                    'min_amount' => [
                        'currency_code' => 'EUR',
                        'value' => '99.00',
                    ],
                    'monthly_percentage_rate' => '0.00000',
                    'monthly_payment' => [
                        'currency_code' => 'EUR',
                        'value' => '106.98',
                    ],
                    'total_interest' => [
                        'currency_code' => 'EUR',
                        'value' => '0.00',
                    ],
                    'total_cost' => [
                        'currency_code' => 'EUR',
                        'value' => '641.88',
                    ],
                    'paypal_subsidy' => false,
                ],
                [
                    'credit_financing' => [
                        'financing_code' => 'OVGL4CTFPF',
                        'apr' => '9.99',
                        'nominal_rate' => '9.5598',
                        'term' => 24,
                        'country_code' => 'DE',
                        'credit_type' => 'INST',
                        'vendor_financing_id' => '6245',
                        'enabled' => true,
                        'links' => [
                            [
                                'href' => 'v1/credit/credit-financing/OVGL4CTFPF',
                                'rel' => 'self',
                                'method' => 'GET',
                            ],
                        ],
                    ],
                    'min_amount' => [
                        'currency_code' => 'EUR',
                        'value' => '300.00',
                    ],
                    'monthly_percentage_rate' => '0.79665',
                    'monthly_payment' => [
                        'currency_code' => 'EUR',
                        'value' => '29.49',
                    ],
                    'total_interest' => [
                        'currency_code' => 'EUR',
                        'value' => '65.02',
                    ],
                    'total_cost' => [
                        'currency_code' => 'EUR',
                        'value' => '706.90',
                    ],
                    'paypal_subsidy' => false,
                ],
                [
                    'credit_financing' => [
                        'financing_code' => '4WGQMMCBSF',
                        'apr' => '9.99',
                        'nominal_rate' => '9.5598',
                        'term' => 18,
                        'country_code' => 'DE',
                        'credit_type' => 'INST',
                        'vendor_financing_id' => '6239',
                        'enabled' => true,
                        'links' => [
                            [
                                'href' => 'v1/credit/credit-financing/4WGQMMCBSF',
                                'rel' => 'self',
                                'method' => 'GET',
                            ],
                        ],
                    ],
                    'min_amount' => [
                        'currency_code' => 'EUR',
                        'value' => '200.00',
                    ],
                    'monthly_percentage_rate' => '0.79665',
                    'monthly_payment' => [
                        'currency_code' => 'EUR',
                        'value' => '38.42',
                    ],
                    'total_interest' => [
                        'currency_code' => 'EUR',
                        'value' => '48.93',
                    ],
                    'total_cost' => [
                        'currency_code' => 'EUR',
                        'value' => '690.81',
                    ],
                    'paypal_subsidy' => false,
                ],
                [
                    'credit_financing' => [
                        'financing_code' => '5IKT4QESHZ',
                        'apr' => '9.99',
                        'nominal_rate' => '9.5598',
                        'term' => 12,
                        'country_code' => 'DE',
                        'credit_type' => 'INST',
                        'vendor_financing_id' => '6233',
                        'enabled' => true,
                        'links' => [
                            [
                                'href' => 'v1/credit/credit-financing/5IKT4QESHZ',
                                'rel' => 'self',
                                'method' => 'GET',
                            ],
                        ],
                    ],
                    'min_amount' => [
                        'currency_code' => 'EUR',
                        'value' => '150.00',
                    ],
                    'monthly_percentage_rate' => '0.79665',
                    'monthly_payment' => [
                        'currency_code' => 'EUR',
                        'value' => '56.30',
                    ],
                    'total_interest' => [
                        'currency_code' => 'EUR',
                        'value' => '33.01',
                    ],
                    'total_cost' => [
                        'currency_code' => 'EUR',
                        'value' => '674.89',
                    ],
                    'paypal_subsidy' => false,
                ],
                [
                    'credit_financing' => [
                        'financing_code' => 'OVGL4CTFPF',
                        'apr' => '9.99',
                        'nominal_rate' => '9.5598',
                        'term' => 24,
                        'country_code' => 'DE',
                        'credit_type' => 'INST',
                        'vendor_financing_id' => '6245',
                        'enabled' => true,
                        'links' => [
                            [
                                'href' => 'v1/credit/credit-financing/OVGL4CTFPF',
                                'rel' => 'self',
                                'method' => 'GET',
                            ],
                        ],
                    ],
                    'min_amount' => [
                        'currency_code' => 'EUR',
                        'value' => '300.00',
                    ],
                    'monthly_percentage_rate' => '0.79665',
                    'monthly_payment' => [
                        'currency_code' => 'EUR',
                        'value' => '29.49',
                    ],
                    'total_interest' => [
                        'currency_code' => 'EUR',
                        'value' => '65.02',
                    ],
                    'total_cost' => [
                        'currency_code' => 'EUR',
                        'value' => '706.90',
                    ],
                    'paypal_subsidy' => false,
                ],
            ],
            'non_qualifying_financing_options' => [
            ],
        ],
    ],
];
