# Magento2 Scenario:
In Case of non-injectable objects you should always use factories , Non-injectable such as Product, Customer and classes such as EventManager and all the Management classes are injectable in magento2. As injectable objects don’t have identities but in the case of non-injectable objects they have identities, so you don’t know which instance you need at which time, so you must use Factory classes to inject non-injectable objects.

For example, *let check the product model which you cann't depend, because you need to provide a product id or explicitly request a new, empty instance to get a Product object. For providing id is not posible through constructor signature, So magento cannot inject this object.*

To get rid out of this limitation, injectable objects can depend on factories that produce newable objects.


Example:
```
<?php
namespace Magento\Catalog\Model;

/**
 * Factory class for @see \Magento\Catalog\Model\Product
 */
class ProductFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magento\\Catalog\\Model\\Product')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Magento\Catalog\Model\Product
     */
    public function create(array $data = array())
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
```

**Used In**
https://github.com/magento/magento2/blob/2.3/app/code/Magento/CatalogInventory/Model/StockStateProvider.php


**Another Example**
```
<?php
namespace Magento\Customer\Model;

/**
 * Factory class for @see \Magento\Customer\Model\Customer
 */
class CustomerFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magento\\Customer\\Model\\Customer')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Magento\Customer\Model\Customer
     */
    public function create(array $data = array())
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
```

**Used In**
https://github.com/magento/magento2/blob/b8892f057a42244be88ac9a46b9885f3ec525943/app/code/Magento/Customer/Model/ResourceModel/Address/Relation.php

