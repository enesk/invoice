<?php
/**
 * THE CODE IN THIS FILE WAS GENERATED FROM THE EBAY WSDL USING THE PROJECT:
 *
 * https://github.com/davidtsadler/ebay-api-sdk-php
 *
 * Copyright 2014 David T. Sadler
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace DTS\eBaySDK\ReturnManagement\Types;

/**
 *
 * @property \DTS\eBaySDK\ReturnManagement\Types\ReturnIdType $ReturnId
 * @property \DTS\eBaySDK\ReturnManagement\Enums\ReturnType $ReturnType
 * @property \DTS\eBaySDK\ReturnManagement\Types\ReturnUserType $otherParty
 * @property \DTS\eBaySDK\ReturnManagement\Types\ReturnRequestType $returnRequest
 * @property \DTS\eBaySDK\ReturnManagement\Enums\ReturnStatusType $status
 * @property \DTS\eBaySDK\ReturnManagement\Types\ReturnResponseDueType $responseDue
 * @property \DateTime $creationDate
 * @property \DateTime $lastModifiedDate
 */
class ReturnSummaryType extends \DTS\eBaySDK\Types\BaseType
{
    /**
     * @var array Properties belonging to objects of this class.
     */
    private static $propertyTypes = array(
        'ReturnId' => array(
            'type' => 'DTS\eBaySDK\ReturnManagement\Types\ReturnIdType',
            'unbound' => false,
            'attribute' => false,
            'elementName' => 'ReturnId'
        ),
        'ReturnType' => array(
            'type' => 'string',
            'unbound' => false,
            'attribute' => false,
            'elementName' => 'ReturnType'
        ),
        'otherParty' => array(
            'type' => 'DTS\eBaySDK\ReturnManagement\Types\ReturnUserType',
            'unbound' => false,
            'attribute' => false,
            'elementName' => 'otherParty'
        ),
        'returnRequest' => array(
            'type' => 'DTS\eBaySDK\ReturnManagement\Types\ReturnRequestType',
            'unbound' => false,
            'attribute' => false,
            'elementName' => 'returnRequest'
        ),
        'status' => array(
            'type' => 'string',
            'unbound' => false,
            'attribute' => false,
            'elementName' => 'status'
        ),
        'responseDue' => array(
            'type' => 'DTS\eBaySDK\ReturnManagement\Types\ReturnResponseDueType',
            'unbound' => false,
            'attribute' => false,
            'elementName' => 'responseDue'
        ),
        'creationDate' => array(
            'type' => 'DateTime',
            'unbound' => false,
            'attribute' => false,
            'elementName' => 'creationDate'
        ),
        'lastModifiedDate' => array(
            'type' => 'DateTime',
            'unbound' => false,
            'attribute' => false,
            'elementName' => 'lastModifiedDate'
        )
    );

    /**
     * @param array $values Optional properties and values to assign to the object.
     */
    public function __construct(array $values = array())
    {
        list($parentValues, $childValues) = self::getParentValues(self::$propertyTypes, $values);

        parent::__construct($parentValues);

        if (!array_key_exists(__CLASS__, self::$properties)) {
            self::$properties[__CLASS__] = array_merge(self::$properties[get_parent_class()], self::$propertyTypes);
        }

        if (!array_key_exists(__CLASS__, self::$xmlNamespaces)) {
            self::$xmlNamespaces[__CLASS__] = 'http://www.ebay.com/marketplace/returns/v1/services';
        }

        $this->setValues(__CLASS__, $childValues);
    }
}
