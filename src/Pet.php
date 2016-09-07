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

        function petSave()
        {
            array_push($_SESSION['pet_record'], $this);
        }

        function retrievePet()
        {
            return $_SESSION['pet_record'];
        }

        function resetPet()
        {
            $_SESSION['pet_record'] = array();
        }
    }
?>
