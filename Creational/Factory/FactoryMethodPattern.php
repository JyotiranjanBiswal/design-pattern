<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * All car should extend this abstract car class
 */
abstract class CarAbstract 
{
    protected $types;
    protected $location;
 
    public function getMessage() 
    {
        return '</br>Connecting to '.$this->types.' located in '.$this->location;
    }
}
 
/**
 * used to represent a petrol car
 */
class PetrolCar extends CarAbstract
{
    protected $types = 'petrol car';
    
    public function __construct($location, $type) {
        $this->location = $location;
        $this->types = $type.' '.$this->types;
    }
}
 
/**
 * used to represent a diesel car
 */
class DieselCar extends CarAbstract 
{
    protected $types = 'diesel car';
    
    public function __construct($location, $type) {
        $this->location = $location;
        $this->types = $type.' '.$this->types;
    }
}
 
/**
 * used to represent a Electric car
 */
class ElectricCar extends CarAbstract
{
    protected $types = 'Electric car';
    
    public function __construct($location, $type) {
        $this->location = $location;
        $this->types = $type.' '.$this->types;
    }
}

/**
 * used to represent a LPG Car
 */
class LPGCar extends CarAbstract 
{  
    protected $types = 'LPG car';
    
    public function __construct($location, $type) {
        $this->location = $location;
        $this->types = $type.' '.$this->types;
    }
}
 
/**
 * used to represent a all factories should implement this interface
 */
interface CarFactoryInterface 
{
    public static function factory($car);
}
 
/**
 * this should be used to create all cars which are LUXURY
 */
class LuxuryCarFactory implements CarFactoryInterface
{
    public static function factory($car) 
    {
        switch ($car) {
            case 'petrol':
                $obj = new PetrolCar('India','Luxury');
                break;
            case 'diesel':
                $obj = new DieselCar('China','Luxury');
                break;
            default:
                throw new Exception("Luxury car factory could not create car of types '" . $car . "'", 1000);
        }
        return $obj;
    }
}
/**
 * this should be used to create all cars which are SMALL
 */
class NanoCarFactory implements CarFactoryInterface
{
    public static function factory($car) 
    {
        switch ($car) {
            case 'petrol':
                $obj = new PetrolCar('India','Nano');
                break;
            case 'diesel':
                $obj = new DieselCar('China','Nano');
                break;
            default:
                throw new Exception("Nano car factory could not create car of types '" . $car . "'", 1000);
        }
        return $obj;
    }
}

try {
    $luxuryCar = LuxuryCarFactory::factory('petrol');
    echo $luxuryCar->getMessage();
    
    $luxuryCar = LuxuryCarFactory::factory('diesel');
    echo $luxuryCar->getMessage();
    
    $nanoCar = NanoCarFactory::factory('petrol');
    echo $nanoCar->getMessage();
    
    $nanoCar = NanoCarFactory::factory('diesel');
    echo $nanoCar->getMessage();
 
} catch(Exception $e) {
    echo $e->getMessage();
}