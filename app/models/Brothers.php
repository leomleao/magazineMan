<?php

class Brothers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $brotherID;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=false)
     */
    protected $brotherName;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $brotherTakesMagazine;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $brotherCreationDate;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $brotherLastMod;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $brotherStatus;

    /**
     * Method to set the value of field brotherName
     *
     * @param string $brotherName
     * @return $this
     */
    public function setBrotherName($brotherName)
    {
        $this->brotherName = $brotherName;

        return $this;
    }

    /**
     * Method to set the value of field brotherTakesMagazine
     *
     * @param integer $brotherTakesMagazine
     * @return $this
     */
    public function setBrotherTakesMagazine($brotherTakesMagazine)
    {

        if (strlen($brotherTakesMagazine) > 1) {
            throw new InvalidArgumentException(
                "Must be set as boolean ('1' or '0')."
            );
        }

        if (is_nan($brotherTakesMagazine)) {
            throw new InvalidArgumentException(
                "Must be set as boolean ('1' or '0')."
            );
        }

        $this->brotherTakesMagazine = $brotherTakesMagazine;

        return $this;
    }

    /**
     * Method to set the value of field brotherStatus
     *
     * @param integer $brotherStatus
     * @return $this
     */
    public function setbrotherStatus($brotherStatus)
    {

        if (strlen($brotherStatus) > 1) {
            throw new InvalidArgumentException(
                "Must be set as boolean ('1' or '0')."
            );
        }

        if (intval($brotherStatus) != 0 && intval($brotherStatus) != 1) {
            throw new InvalidArgumentException(
                "Must be set as boolean ('1' or '0')."
            );
        }


        $this->brotherStatus = intval($brotherStatus);

        return $this;
    }

    /**
     * Returns the value of field brotherID
     *
     * @return integer
     */
    public function getBrotherID()
    {
        return $this->brotherID;
    }

    /**
     * Returns the value of field brotherName
     *
     * @return string
     */
    public function getBrotherName()
    {
        return $this->brotherName;
    }

    /**
     * Returns the value of field brotherTakesMagazine
     *
     * @return integer
     */
    public function getBrotherTakesMagazine()
    {
        return $this->brotherTakesMagazine;
    }

        /**
     * Returns the value of field brotherCreationDate
     *
     * @return string
     */
    public function getbrotherCreationDate()
    {
        return $this->brotherCreationDate;
    }

    /**
     * Returns the value of field brotherLastMod
     *
     * @return string
     */
    public function getbrotherLastMod()
    {
        return $this->brotherLastMod;
    }

    /**
     * Returns the value of field brotherStatus
     *
     * @return integer
     */
    public function getbrotherStatus()
    {
        return $this->brotherStatus;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("magazineMan");
        $this->hasMany('brotherID', 'Allocations', 'allocationBrotherID', ['alias' => 'Allocations']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'brothers';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Brothers[]|Brothers
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Brothers
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }    

    /**
     * Allows to query the magazines allocations of all brothers
     *
     * @param mixed $parameters
     * @return Array
     */
    public static function getAllocations($parameters = null)
    {
        $bind = ['status' => '1'];
        $brothers = Brothers::query()
        ->columns(array(
            'brotherID',                
            'brotherName', 
            'brotherTakesMagazine'                      
        ))
        ->andWhere('Brothers.BrotherStatus= :status:')
        ->bind($bind); 
        $brothers = $brothers->execute();


        $allocations = Allocations::find();

        $brothersClean = [];

        
        for ($i=0; $i < count($brothers); $i++) {
            if (!array_key_exists('magazines',$brothers[$i])){
                $brothers[$i]->magazines = [];
            }
            for ($j=0; $j < count($allocations); $j++) {

                if ($brothers[$i]->brotherID == $allocations[$j]->allocationBrotherID){
                    array_push($brothers[$i]->magazines, date("m/Y",strtotime($allocations[$j]->allocationMagazineDate)));
                }  
            }
            $brotherClean[$i] = $brothers[$i]->toArray();
        }

                // print_r(json_encode($brotherClean));exit;

        return  $brotherClean;

    }   

}
