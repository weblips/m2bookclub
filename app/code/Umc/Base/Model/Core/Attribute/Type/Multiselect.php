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
namespace Umc\Base\Model\Core\Attribute\Type;

class Multiselect extends Dropdown
{
    /**
     * get default value
     *
     * @return int|mixed|string
     */
    public function getDefaultValue()
    {
        $default = $this->getAttribute()->getData('default_value');
        $default = array_map('trim', explode("\n", $default));

        $values = $this->getAttribute()->getData('options');
        $values = explode("\n", $values);

        $realDefault = [];
        foreach ($values as $key => $label) {
            if (in_array(trim($label), $default)) {
                $realDefault[] = $key + 1;
            }
        }
        return implode(',', $realDefault);
    }

    /**
     * get addition option for edit form
     *
     * @return array
     */
    public function getAdditionalEditFormOptions()
    {
        $options = [];
        $attribute = $this->getAttribute();
        $underscore = $this->getUnderscore();
        $options[] = '\'values\' => $this->'.
            $underscore.
            $attribute->getCodeCamelCase().
            'Options->toOptionArray(),';
        return $options;
    }
}
