# Observer design pattern

Observer design pattern is a pattern which we can call also ***Publish-Subscribe pattern.*** It is an one type of behavioral design pattern which has one-to-many relationship between objects. That is when one object changes its state then its all dependent object will notified and updated automatically.
*  ***The object which changes its state called subject (Publish).***
*  ***All dependent object will be notified called observer (Subscribe).***

So subject can have any number of subscriber and any number of observer can subscribe to subject to receive notification.
Lets see one example. In my case I have one subject ***(alternatively can be called publisher)*** called 'EmployeeList' and have one observer ***(alternatively can be called subscriber)*** called EmployeeListObserver

>*For getting notification from subject I have registere observer in subject using the attach method. For no longer to notify the changes to observer I have unregistered Observer in subject using detach method.*

## Observer

Observer class **EmployeeListObserver** provides an update method which will be called by subject to notify it the changes of subject. The update method is already concrete method which is defined **SplObserver** and I have implements my **EmployeeListObserver** from **SplObserver** class. In my example I am displaying the fist and last added employees which is getting notified by subject class once any employee added to the system.

```
class EmployeeListObserver implements SplObserver
{
    public function update(SplSubject $subject)
    {
        printf('First created employees: "%s"', $subject->getFirstEmployee());
        echo "</br >";
        printf('Last created employees: "%s"', $subject->getLastEmployee());
    }
}
```

## Subject

Subject class **EmployeeList** implements all feature from **SplSubject** class which is a core class of PHP and has some methods declared in it those are ***attach(), detach(), notify().*** I have also added some other extra methods in class EmployeeList ***addEmployee(), getEmployees(), getFirstEmployee(), getLastEmployee().*** attach() method subscribes an observer to the subject for notifying any changes being made.  **addEmployee()** method will add employee to system and call **notify()** to update the observer. The **notify()** method updated each subscribe observer by iterating through internal list and calling each memebrs **update()** method.

```
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
```

Finally the observer design pattern is the perfect design pattern if you have several object which are dependent upon on another object and need sto perform some action when state of that object get changed.
