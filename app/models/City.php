<?php 
require_once(dirname(__DIR__) . "/database/data_base.php");
require_once(dirname(__DIR__) . "/database/operations.php");

    class City extends database implements operations {

        private $id;
        private $name;
        private $status;
        private $lat;
        private $long;
        private $radius;
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
         * Get the value of lat
         */ 
        public function getLat()
        {
                return $this->lat;
        }

        /**
         * Set the value of lat
         *
         * @return  self
         */ 
        public function setLat($lat)
        {
                $this->lat = $lat;

                return $this;
        }

        /**
         * Get the value of long
         */ 
        public function getLong()
        {
                return $this->long;
        }

        /**
         * Set the value of long
         *
         * @return  self
         */ 
        public function setLong($long)
        {
                $this->long = $long;

                return $this;
        }

        /**
         * Get the value of radius
         */ 
        public function getRadius()
        {
                return $this->radius;
        }

        /**
         * Set the value of radius
         *
         * @return  self
         */ 
        public function setRadius($radius)
        {
                $this->radius = $radius;

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

        public function insertData(){

        }
        public function updateData(){

        }
        public function deleteData(){

        }
        public function selectAllData(){
            $query = " SELECT `cities`.* FROM `cities` ORDER BY `cities`.`name` ASC ";
            return $this->runDQL($query);
        }

    }