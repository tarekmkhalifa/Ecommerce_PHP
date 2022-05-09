<?php 
require_once(dirname(__DIR__)."/database/data_base.php");

class addressValidation extends database {
    private $street;
    private $building;
    private $floor;
    private $flat;
    private $region_id;
    private $details;
    

    /**
     * Get the value of street
     */ 
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @return  self
     */ 
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get the value of building
     */ 
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set the value of building
     *
     * @return  self
     */ 
    public function setBuilding($building)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get the value of floor
     */ 
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set the value of floor
     *
     * @return  self
     */ 
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get the value of flat
     */ 
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Set the value of flat
     *
     * @return  self
     */ 
    public function setFlat($flat)
    {
        $this->flat = $flat;

        return $this;
    }

    
    /**
     * Get the value of region_id
     */ 
    public function getRegion_id()
    {
        return $this->region_id;
    }

    /**
     * Set the value of region_id
     *
     * @return  self
     */ 
    public function setRegion_id($region_id)
    {
        $this->region_id = $region_id;

        return $this;
    }

    /**
     * Get the value of details
     */ 
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set the value of details
     *
     * @return  self
     */ 
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    // method to check on input keys
    public function addressKeyValidation()
    {
        $errors = [];

        if ( !isset($_POST['street'])    | !isset($_POST['building']) |
             !isset($_POST['floor'])     | !isset($_POST['flat']) |
             !isset($_POST['region_id']) | !isset($_POST['details']) ){
                 
                $errors['key'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
        }
        return $errors;
    }

    public function addressValidation()
    {
        $errors = [];
        if(!$this->street | !$this->building | !$this->floor | !$this->flat | !$this->region_id){
            $errors['fields'] = "<div class='alert alert-danger'> Street, Building, Floor, Flat, Region Are Required </div>";
        }
        return $errors;
    }

}