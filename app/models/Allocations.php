<?php

class Allocations extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $allocationID;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $allocationBrotherID;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $allocationMagazineDate;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $allocationInsertionDate;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $allocationLastMod;

    /**
     * Method to set the value of field allocationID
     *
     * @param integer $allocationID
     * @return $this
     */
    public function setAllocationID($allocationID)
    {
        $this->allocationID = $allocationID;

        return $this;
    }

    /**
     * Method to set the value of field allocationBrotherID
     *
     * @param integer $allocationBrotherID
     * @return $this
     */
    public function setAllocationBrotherID($allocationBrotherID)
    {
        $this->allocationBrotherID = $allocationBrotherID;

        return $this;
    }

    /**
     * Method to set the value of field allocationMagazineDate
     *
     * @param string $allocationMagazineDate
     * @return $this
     */
    public function setAllocationMagazineDate($allocationMagazineDate)
    {   
        $allocationMagazineDate = DateTime::createFromFormat('d/m/Y', $allocationMagazineDate);        
        if (!$allocationMagazineDate) {
            throw new InvalidArgumentException(
                "Must be set as date."
            );
        }

        $this->allocationMagazineDate = $allocationMagazineDate->format('Y-m-d');

        return $this;
    }

    /**
     * Method to set the value of field allocationInsertionDate
     *
     * @param string $allocationInsertionDate
     * @return $this
     */
    public function setAllocationInsertionDate($allocationInsertionDate)
    {
        $this->allocationInsertionDate = $allocationInsertionDate;

        return $this;
    }

    /**
     * Method to set the value of field allocationLastMod
     *
     * @param string $allocationLastMod
     * @return $this
     */
    public function setAllocationLastMod($allocationLastMod)
    {
        $this->allocationLastMod = $allocationLastMod;

        return $this;
    }

    /**
     * Returns the value of field allocationID
     *
     * @return integer
     */
    public function getAllocationID()
    {
        return $this->allocationID;
    }

    /**
     * Returns the value of field allocationBrotherID
     *
     * @return integer
     */
    public function getAllocationBrotherID()
    {
        return $this->allocationBrotherID;
    }

    /**
     * Returns the value of field allocationMagazineDate
     *
     * @return string
     */
    public function getAllocationMagazineDate()
    {
        return $this->allocationMagazineDate;
    }

    /**
     * Returns the value of field allocationInsertionDate
     *
     * @return string
     */
    public function getAllocationInsertionDate()
    {
        return $this->allocationInsertionDate;
    }

    /**
     * Returns the value of field allocationLastMod
     *
     * @return string
     */
    public function getAllocationLastMod()
    {
        return $this->allocationLastMod;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("magazineMan");
        $this->belongsTo('allocationBrotherID', '\Brothers', 'brotherID', ['alias' => 'Brothers']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'allocations';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Allocations[]|Allocations
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Allocations
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
