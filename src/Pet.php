<?php
    class Pet
    {
        private $petName;
        private $petFood;
        private $petRest;
        private $petPlay;

        function __construct($petName)
        {
            $this->petName = $petName;
            $this->petFood = 100;
            $this->petRest = 100;
            $this->petPlay = 100;
        }

        function getName()
        {
            return $this->petName;
        }

        function getStat($statNumber)
        {
            if ($statNumber == 1) {
                return $this->petFood;
            } elseif ($statNumber == 2) {
                return $this->petRest;
            } else {
                return $this->petPlay;
            }

        }

        function petSave()
        {
            $_SESSION['pet_record'] = $this;
        }

        function petFeed()
        {
            $this->petFood += 10;
            $this->petPlay -= rand(1,5);
            $this->petRest -= rand(1,2);
        }

        function petRest()
        {
            $this->petRest += 10;
            $this->petPlay -= rand(1,5);
            $this->petFood -= rand(1,2);
        }

        function petPlay()
        {
            $this->petPlay += 10;
            $this->petRest -= rand(1,5);
            $this->petFood -= rand(1,2);
        }

        function petDegrade()
        {
            $this->petPlay -= rand(1,5);
            $this->petRest -= rand(1,5);
            $this->petFood -= rand(1,5);
            $_SESSION['turn_counter'] ++;
        }

        function petStatus() {
            if ($this->petFood <= 0 || $this->petRest <= 0 || $this->petPlay <= 0) {
                return false;
            } else {
                return true;
            }
        }

        function retrievePet()
        {
            return $_SESSION['pet_record'];
        }

        function resetPet()
        {
            $_SESSION['pet_record'] = array();
            $_SESSION['turn_counter'] = "";
        }
    }
?>
