<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Unit\Setup\DefaultProfiles;

use PHPUnit\Framework\TestCase;
use Shopware\Setup\SwagImportExport\DefaultProfiles\MinimalCategoryProfile;
use Shopware\Setup\SwagImportExport\DefaultProfiles\ProfileMetaData;

class MinimalCategoryProfileTest extends TestCase
{
    use DefaultProfileTestCaseTrait;

    public function test_it_can_be_created()
    {
        $categoryMinimalProfile = $this->createMinimalCategoryProfile();

        static::assertInstanceOf(MinimalCategoryProfile::class, $categoryMinimalProfile);
        static::assertInstanceOf(\JsonSerializable::class, $categoryMinimalProfile);
        static::assertInstanceOf(ProfileMetaData::class, $categoryMinimalProfile);
    }

    public function test_it_should_return_valid_profile_tree()
    {
        $minimalCategoryProfile = $this->createMinimalCategoryProfile();

        $profileTree = $minimalCategoryProfile->jsonSerialize();
        $this->walkRecursive($profileTree, function ($node) {
            $this->assertArrayHasKey('id', $node, 'Current array: ' . print_r($node, true));
            $this->assertArrayHasKey('type', $node, 'Current array: ' . print_r($node, true));
            $this->assertArrayHasKey('name', $node, 'Current array: ' . print_r($node, true));
        });

        $profileJson = json_encode($minimalCategoryProfile);
        static::assertJson($profileJson);
    }

    /**
     * @return MinimalCategoryProfile
     */
    private function createMinimalCategoryProfile()
    {
        return new MinimalCategoryProfile();
    }
}
