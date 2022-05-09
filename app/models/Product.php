<?php
require_once(dirname(__DIR__) . "/database/data_base.php");
require_once(dirname(__DIR__) . "/database/operations.php");

class Product extends database implements operations
{
    private $id;
    private $name;
    private $details;
    private $code;
    private $price;
    private $quantity;
    private $status;
    private $brand_id;
    private $subcategory_id;
    private $created_at;
    private $updated_at;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

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

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of brand_id
     */
    public function getBrand_id()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @return  self
     */
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Get the value of subcategory_id
     */
    public function getSubcategory_id()
    {
        return $this->subcategory_id;
    }

    /**
     * Set the value of subcategory_id
     *
     * @return  self
     */
    public function setSubcategory_id($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function insertData()
    {
    }
    public function updateData()
    {
    }
    public function deleteData()
    {
    }
    public function selectAllData()
    {
        $query = " SELECT `products`.*,`products_images`.`image` FROM `products` JOIN `products_images` 
         ON `products`.`id` = `products_images`.`product_id` AND `products_images`.`primary_image` = 1
         ORDER BY `products`.`name` ASC ";
        return $this->runDQL($query);
    }

    public function productsBySubCategory()
    {
        $query = " SELECT `products`.*,`products_images`.`image` FROM `products` JOIN `products_images` 
        ON `products`.`id` = `products_images`.`product_id` AND `products_images`.`primary_image` = 1
        WHERE `subcategory_id` = $this->subcategory_id
        ORDER BY `products`.`name` ASC ";
        return $this->runDQL($query);
    }

    public function productsByBrand()
    {
        $query = " SELECT `products`.*,`products_images`.`image` FROM `products` JOIN `products_images` 
        ON `products`.`id` = `products_images`.`product_id` AND `products_images`.`primary_image` = 1
        WHERE `products`.`brand_id` = '$this->brand_id'
        ORDER BY `products`.`name` ASC ";
        return $this->runDQL($query);
    }

    public function productDetails()
    {
        $query = " SELECT `products_ratings`.*  FROM `products_ratings` WHERE `products_ratings`.`id` = $this->id ";
        return $this->runDQL($query);
    }

    public function productImages()
    {
        $query = " SELECT `products_images`.* FROM `products_images` WHERE `products_images`.`product_id` = $this->id ORDER BY `products_images`.`primary_image` DESC";
        return $this->runDQL($query);
    }

    public function productReviews()
    {
        $query = " SELECT `reviews`.* , `users`.`name` FROM `reviews`
                    JOIN `users` ON `reviews`.`user_id` = `users`.`id`
         WHERE `reviews`.`product_id` = $this->id ORDER BY `reviews`.`date` DESC";
        return $this->runDQL($query);
    }

    public function relatedProducts()
    {
        $query = " SELECT `products`.* FROM `products`
         WHERE `products`.`subcategory_id` = $this->subcategory_id AND `products`.`id` <> $this->id ";
        return $this->runDQL($query);
    }


    public function selectNewProducts()
    {
        $query = " SELECT `products`.*,`products_images`.`image` FROM `products` JOIN `products_images` 
        ON `products`.`id` = `products_images`.`product_id` AND `products_images`.`primary_image` = 1
        ORDER BY `products`.`created_at` DESC
        LIMIT 4 ";
        return $this->runDQL($query);
    }

    public function selectMostRatedProducts()
    {
        $query = " SELECT `products`.* , `products_images`.`image` , AVG(`reviews`.`ratevalue`) AS `productAVG` FROM `products`
                   JOIN `reviews` ON `reviews`.`product_id` = `products`.`id`
                   JOIN `products_images` ON `products`.`id` = `products_images`.`product_id` AND `products_images`.`primary_image` = 1
                   GROUP BY `reviews`.`product_id` 
                   ORDER BY `productAVG` DESC LIMIT 4 ";
        return $this->runDQL($query);
    }
}
