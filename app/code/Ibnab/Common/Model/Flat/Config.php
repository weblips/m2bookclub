<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ibnab\Common\Model\Flat;

use Magento\Eav\Model\Entity\Type;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Config extends \Magento\Eav\Model\Config
{

    /**
     * Entity types data
     *
     * @var array
     */
    protected $_entityTypeData;

    /**
     * Attributes data
     *
     * @var array
     */
    protected $_attributeData;

    /**
     * Attribute codes cache array
     *
     * @var array
     */
    protected $_attributeCodes;

    /**
     * Initialized objects
     *
     * array ($objectId => $object)
     *
     * @var array
     */
    protected $_objects;

    /**
     * References between codes and identifiers
     *
     * array (
     *      'attributes'=> array ($attributeId => $attributeCode),
     *      'entities'  => array ($entityId => $entityCode)
     * )
     *
     * @var array
     */
    protected $_references;

    /**
     * Cache flag
     *
     * @var bool|null
     */
    protected $_isCacheEnabled = null;

    /**
     * @var \Magento\Framework\App\CacheInterface
     */
    protected $_cache;

    /** @var \Magento\Framework\App\Cache\StateInterface */
    protected $_cacheState;

    /**
     * @var \Magento\Eav\Model\Entity\TypeFactory
     */
    protected $_entityTypeFactory;

    /**
     * @var \Magento\Eav\Model\ResourceModel\Entity\Type\CollectionFactory
     */
    protected $entityTypeCollectionFactory;

    /**
     * @var \Magento\Framework\Validator\UniversalFactory
     */
    protected $_universalFactory;
    /**
     * @param \Magento\Framework\App\CacheInterface $cache
     * @param \Magento\Eav\Model\Entity\TypeFactory $entityTypeFactory
     * @param \Magento\Eav\Model\ResourceModel\Entity\Type\CollectionFactory $entityTypeCollectionFactory
     * @param \Magento\Framework\App\Cache\StateInterface $cacheState
     * @param \Magento\Framework\Validator\UniversalFactory $universalFactory
     * @codeCoverageIgnore
     */
    public function __construct(
        \Magento\Framework\App\CacheInterface $cache,
        \Magento\Eav\Model\Entity\TypeFactory $entityTypeFactory,
        \Magento\Eav\Model\ResourceModel\Entity\Type\CollectionFactory $entityTypeCollectionFactory,
        \Magento\Framework\App\Cache\StateInterface $cacheState,
        \Magento\Framework\Validator\UniversalFactory $universalFactory
    ) {
        $this->_cache = $cache;
        $this->_entityTypeFactory = $entityTypeFactory;
        $this->entityTypeCollectionFactory = $entityTypeCollectionFactory;
        $this->_cacheState = $cacheState;
        $this->_universalFactory = $universalFactory;
        parent::__construct($cache,$entityTypeFactory
,$entityTypeCollectionFactory,$cacheState,$universalFactory);
    }
      /**
     * Get entity type object by entity type code/identifier
     *
     * @param int|string|Type $code
     * @return Type
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getEntityType($code)
    {
        $entityTypeFactory = $this->_entityTypeFactory->create();
        return $entityTypeFactory;
    }
}
