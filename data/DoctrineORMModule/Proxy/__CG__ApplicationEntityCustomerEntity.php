<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class CustomerEntity extends \Application\Entity\CustomerEntity implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'orders', 'name', 'surname', 'email', 'phone', 'discount', 'id', 'created_at', 'updated_at'];
        }

        return ['__isInitialized__', 'orders', 'name', 'surname', 'email', 'phone', 'discount', 'id', 'created_at', 'updated_at'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (CustomerEntity $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getOrders(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrders', []);

        return parent::getOrders();
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', []);

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', [$name]);

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getSurname()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSurname', []);

        return parent::getSurname();
    }

    /**
     * {@inheritDoc}
     */
    public function setSurname($surname)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSurname', [$surname]);

        return parent::setSurname($surname);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getPhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhone', []);

        return parent::getPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setPhone($phone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhone', [$phone]);

        return parent::setPhone($phone);
    }

    /**
     * {@inheritDoc}
     */
    public function getDiscount()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDiscount', []);

        return parent::getDiscount();
    }

    /**
     * {@inheritDoc}
     */
    public function setDiscount($discount)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDiscount', [$discount]);

        return parent::setDiscount($discount);
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id): \Application\Entity\CustomerEntity
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateCreated(): ?\DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateCreated', []);

        return parent::getDateCreated();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateCreated(\DateTime $created_at): \Application\Entity\CustomerEntity
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateCreated', [$created_at]);

        return parent::setDateCreated($created_at);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateUpdated(): ?\DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateUpdated', []);

        return parent::getDateUpdated();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateUpdated(\DateTime $updated_at): \Application\Entity\CustomerEntity
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateUpdated', [$updated_at]);

        return parent::setDateUpdated($updated_at);
    }

}
