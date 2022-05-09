<?php
require_once(dirname(__DIR__) . "/database/data_base.php");
require_once(dirname(__DIR__) . "/database/operations.php");

class Review extends database
{
    private $user_id;
    private $product_id;
    private $ratevalue;
    private $comment;
    private $date;

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of product_id
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */ 
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of ratevalue
     */ 
    public function getRatevalue()
    {
        return $this->ratevalue;
    }

    /**
     * Set the value of ratevalue
     *
     * @return  self
     */ 
    public function setRatevalue($ratevalue)
    {
        $this->ratevalue = $ratevalue;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function addReview()
    {
        $query = " INSERT INTO `reviews`(`user_id`, `product_id`, `ratevalue`, `comment` )
                    VALUES ($this->user_id, $this->product_id, $this->ratevalue, '$this->comment')";
        return $this->runDML($query);
    }

    public function selectReview()
    {
        $query = "  SELECT `reviews`.* FROM `reviews`  WHERE `reviews`.`user_id` = $this->user_id AND `reviews`.`product_id` = $this->product_id ";
        return $this->runDQL($query);
    }


}

?>