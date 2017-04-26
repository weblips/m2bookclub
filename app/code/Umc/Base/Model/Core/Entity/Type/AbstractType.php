<?php
/**
 * Umc_Base extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category  Umc
 * @package   Umc_Base
 * @copyright 2015 Marius Strajeru
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 * @author    Marius Strajeru <ultimate.module.creator@gmail.com>
 */
namespace Umc\Base\Model\Core\Entity\Type;

use Umc\Base\Model\Core\Entity;
use Umc\Base\Model\Umc;

class AbstractType extends Umc implements TypeInterface
{
    /**
     * entity type
     *
     * @var string
     */
    protected $type = 'abstract';

    /**
     * @var Entity
     */
    protected $entity;

    /**
     * set entity
     *
     * @param Entity $entity
     * @return $this
     */
    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     * get entity
     *
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * get placeholders
     *
     * @return array
     */
    public function getPlaceholders()
    {
        return [];
    }

    /**
     * check if entity type has file attributes
     *
     * @return bool
     */
    public function getHasFile()
    {
        return $this->getEntity()->getHasAttributeType('file');
    }

    /**
     * check if entity type has image attributes
     *
     * @return bool
     */
    public function getHasImage()
    {
        return $this->getEntity()->getHasAttributeType('image');
    }

    /**
     * check if entity type has date attributes
     *
     * @return bool
     */
    public function getHasDate()
    {
        return $this->getEntity()->getHasAttributeType('date');
    }

    /**
     * check if entity type has multi select attributes
     *
     * @return bool
     */
    public function getHasMulti()
    {
        if (!$this->hasData('has_multi')) {
            $this->setData('has_multi', false);
            foreach ($this->getEntity()->getAttributes() as $attribute) {
                if ($attribute->getIsMulti()) {
                    $this->setData('has_multi', true);
                    break;
                }
            }
        }
        return $this->getData('has_multi');
    }

    /**
     * check if has attribute type
     *
     * @param $type
     * @return bool
     */
    public function getHasAttributeType($type)
    {
        foreach ($this->getEntity()->getAttributes() as $attribute) {
            if ($attribute->getType() == $type) {
                return true;
            }
        }
        return false;
    }

    /**
     * check if has attribute type
     *
     * @param $type
     * @return bool
     */
    public function getHasAttributeTypeRequired($type)
    {
        foreach ($this->getEntity()->getAttributes() as $attribute) {
            if ($attribute->getType() == $type && $attribute->getRequired()) {
                return true;
            }
        }
        return false;
    }

}
