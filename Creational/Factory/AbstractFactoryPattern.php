<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
 * CarFactory classes
 */

abstract class AbstractCarFactory {

    abstract function makeDieselCar();

    abstract function makePetrolCar();
}

class TataCarFactory extends AbstractCarFactory {

    private $companyName = "Tata";

    function makeDieselCar() {
        return new TataDieselCar;
    }

    function makePetrolCar() {
        return new TataPetrolCar;
    }

}

class SkodaCarFactory extends AbstractCarFactory {

    private $companyName = "Skoda";

    function makeDieselCar() {
        return new SkodaDieselCar;
    }

    function makePetrolCar() {
        return new SkodaPetrolCar;
    }

}

/*
 *   Car classes
 */
abstract class AbstractCar {

    abstract function getEngine();

    abstract function getCompany();
}

abstract class AbstractPetrolCar extends AbstractCar {

    private $type = "Petrol";

}

class TataPetrolCar extends AbstractPetrolCar {

    private $engine;
    private $company;

    function __construct() {
        $this->engine = '1197 cc';
        $this->company = 'Tata Korea';
    }

    function getEngine() {
        return $this->engine;
    }

    function getCompany() {
        return $this->company;
    }

}

class SkodaPetrolCar extends AbstractPetrolCar {

    private $engine;
    private $company;

    function __construct() {
        $this->engine = '1396 cc';
        $this->company = 'Skoda Korea';
    }

    function getEngine() {
        return $this->engine;
    }

    function getCompany() {
        return $this->company;
    }

}

abstract class AbstractDieselCar extends AbstractCar {

    private $type = "Diesel";

}

class TataDieselCar extends AbstractDieselCar {

    private $engine;
    private $company;
    private static $oddOrEven = 'odd';

    function __construct() {
        //alternate between 2 engins
        if ('odd' == self::$oddOrEven) {
            $this->engine = '2694 cc';
            $this->company = 'Tata India';
            self::$oddOrEven = 'even';
        } else {
            $this->engine = '2500 cc';
            $this->company = 'Tata China';
            self::$oddOrEven = 'odd';
        }
    }

    function getEngine() {
        return $this->engine;
    }

    function getCompany() {
        return $this->company;
    }

}

class SkodaDieselCar extends AbstractDieselCar {

    private $engine;
    private $company;

    function __construct() {
        //alternate randomly between 2 cars
        mt_srand((double) microtime() * 10000000);
        $rand_num = mt_rand(0, 1);

        if (1 > $rand_num) {
            $this->engine = '3694 cc';
            $this->company = 'Skoda India';
        } else {
            $this->engine = '3500 cc';
            $this->company = 'Skoda China';
        }
    }

    function getEngine() {
        return $this->engine;
    }

    function getCompany() {
        return $this->company;
    }

}

//Execution

echo '############# TESTING TataCarFactory ###############'."<br/>";
$carFactoryInstance = new TataCarFactory;
$dieselCarOne = $carFactoryInstance->makeDieselCar();
echo 'first diesel engine: ' . $dieselCarOne->getEngine()."<br/>";
echo 'first diesel company: ' . $dieselCarOne->getCompany()."<br/>";

$dieselCarTwo = $carFactoryInstance->makeDieselCar();
echo 'second diesel Engine: ' . $dieselCarTwo->getEngine()."<br/>";
echo 'second diesel Company: ' . $dieselCarTwo->getCompany()."<br/>";

$petrolCar = $carFactoryInstance->makePetrolCar();
echo 'Petrol Engine: ' . $petrolCar->getEngine()."<br/>";
echo 'Petrol Company: ' . $petrolCar->getCompany()."<br/>";
echo "<br/>";

echo '########## TESTING SkodaCarFactory ###############'."<br/>";
$carFactoryInstance = new SkodaCarFactory;
$dieselCarOne = $carFactoryInstance->makeDieselCar();
echo 'first diesel engine: ' . $dieselCarOne->getEngine()."<br/>";
echo 'first diesel company: ' . $dieselCarOne->getCompany()."<br/>";

$dieselCarTwo = $carFactoryInstance->makeDieselCar();
echo 'second diesel Engine: ' . $dieselCarTwo->getEngine()."<br/>";
echo 'second diesel Company: ' . $dieselCarTwo->getCompany()."<br/>";

$petrolCar = $carFactoryInstance->makePetrolCar();
echo 'Petrol Engine: ' . $petrolCar->getEngine()."<br/>";
echo 'Petrol Company: ' . $petrolCar->getCompany()."<br/>";

/*
OutPut:
############# TESTINF TataCarFactory ###############
first diesel engine: 2694 cc
first diesel company: Tata India
second diesel Engine: 2500 cc
second diesel Company: Tata China
Petrol Engine: 1197 cc
Petrol Company: Tata Korea

########## TESTING SkodaCarFactory ###############
first diesel engine: 3694 cc
first diesel company: Skoda India
second diesel Engine: 3694 cc
second diesel Company: Skoda India
Petrol Engine: 1396 cc
Petrol Company: Skoda Korea
*/
?>
