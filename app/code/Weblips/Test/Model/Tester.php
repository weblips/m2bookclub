<?php
namespace Weblips\Test\Model;
class Tester extends \Magento\Framework\Model\AbstractModel implements \Weblips\Test\Api\Data\TesterInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'weblips_test_tester';

    protected function _construct()
    {
        $this->_init('Weblips\Test\Model\ResourceModel\Tester');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
