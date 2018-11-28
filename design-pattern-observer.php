<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//https://github.com/domnikl/DesignPatternsPHP

class EmployeeList implements SplSubject
{
    private $_observers;
    private $_employees = array();
    
    public function __construct()
    {
        $this->_observers = new SplObjectStorage();
    }
    
    public function addEmployee($employee)
    {
        $this->_employees[] = $employee;
        $this->notify();
        return $this;
    }
    
    public function getEmployees()
    {
        return $this->_employees;
    }
    
    public function getLastEmployee()
    {
        $employees = $this->getEmployees();
        return end($employees);
    }
    
    public function getFirstEmployee()
    {
        $employees = $this->getEmployees();
        return current($employees);
    }
    
    public function attach(SplObserver $observer)
    {
        $this->_observers->attach($observer);
        return $this;
    }
    
    public function detach(SplObserver $observer)
    {
        $this->_observers->detach($observer);
        return $this;
    }
    
    public function notify()
    {
        foreach ($this->_observers as $observer) {
            $observer->update($this);
        }
        return $this;
    }
}

class EmployeeListObserver implements SplObserver
{
    public function update(SplSubject $subject)
    {
        printf('First created employees: "%s"', $subject->getFirstEmployee());
        echo "</br >";
        printf('Last created employees: "%s"', $subject->getLastEmployee());
    }
}

$ul = new EmployeeList();
$ul->attach(new EmployeeListObserver());
$ul->addEmployee('Jyoti');
echo "</br >";
echo "</br >";
$ul->addEmployee('Ranjan');
echo "</br >";
echo "</br >";
$ul->addEmployee('Biswal');
