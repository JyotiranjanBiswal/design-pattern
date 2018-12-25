<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * All car should extend this abstract car class
 */
abstract class CarAbstract
{
    protected $types;
 
    public function getTypes() {
        return $this->types;
    }
}
 
/**
 * used to represent a petrol car
 */
class PetrolCar extends CarAbstract
{
    protected $types = 'petrol car </br>';
}
 
/**
 * used to represent a diesel car
 */
class DieselCar extends CarAbstract
{
    protected $types = 'diesel car </br>';
}
 
/**
 * The is the factory which creates car objects
 */
class CarFactory
{
    public static function factory($car) 
    {
        switch ($car) {
            case 'petrol':
                $obj = new PetrolCar();
                break;
            case 'diesel':
                $obj = new DieselCar();
                break;
            default:
                throw new Exception("Car factory could not create car of types '" . $car . "'", 1000);
        }
        return $obj;
    }
}
 
try {
 
    $petrol = CarFactory::factory('petrol'); // object(PetrolCar)#1
    echo $petrol->getTypes(); // petrol car
 
    $diesel = CarFactory::factory('diesel'); // object(DieselCar)#1
    echo $diesel->getTypes(); // diesel car
 
    $hippo = CarFactory::factory('electric'); // This will throw an Exception
 
} catch(Exception $e) {
    echo $e->getMessage(); // CarFactory could not create car of types 'electric'
}