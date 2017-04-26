<?php
namespace Weblips\Test\Model\ResourceModel;
class Tester extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('weblips_test_tester','weblips_test_tester_id');
    }
}
