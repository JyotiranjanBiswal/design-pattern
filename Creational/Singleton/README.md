# Singleton design pattern

*The singleton pattern is useful when we need to make sure we only have a single instance of a class for the entire request life-cycle in a web application. This typically occurs when we have global objects (such as a Configuration class) or a shared resource (such as an event queue).*

lets consider an example why we should consider singleton in our framework.

Lets check one simple example that is creation of database connection. when you want to get connection through database class you will have create new object of database class


**Problem of not using Singleton:**

```
<php
class database {
     
    private $dbName = null, $dbHost = null, $dbPass = null, $dbUser = null;
     
    public function __construct($dbDetails = array()) {
         
        $this->dbName = $dbDetails['db_name'];
        $this->dbHost = $dbDetails['db_host'];
        $this->dbUser = $dbDetails['db_user'];
        $this->dbPass = $dbDetails['db_pass'];
 
        $this->dbh = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName, $this->dbUser, $this->dbPass);    
    }
}
```

The problem will happen if you will create new instance wherever you want to get database connection. Imagine the scenario if you create multiple object then that much multiple identical database connection will be there in database server which will impact on speed on the server.

**Impact after using singleton:**
For overcoming above problem we will have to make sure our object will not be created multiple times from one class to another. So for that we have to think about singleton pattern, which create object of one class in one and one time only.

```
<?php
class database {
     
    private $dbName = null, $dbHost = null, $dbPass = null, $dbUser = null;
    private static $instance = null;
     
    private function __construct($dbDetails = array()) {
         
        // Please note that this is Private Constructor
         
        $this->dbName = $dbDetails['db_name'];
        $this->dbHost = $dbDetails['db_host'];
        $this->dbUser = $dbDetails['db_user'];
        $this->dbPass = $dbDetails['db_pass'];
 
        // Your Code here to connect to database //
        $this->dbh = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName, $this->dbUser, $this->dbPass);
    }
     
    public static function connect($dbDetails = array()) {
         
        // Check if instance is already exists      
        if(self::$instance == null) {
            self::$instance = new database($dbDetails);
        }
         
        return self::$instance;
         
    }
     
    private function __clone() {
        // Stopping Clonning of Object
    }
     
    private function __wakeup() {
        // Stopping unserialize of object
    }
     
}
```

From above example, the private constructor, which prevents object creation using the new keyword. Another indication is one static member variable which holds the reference to an already created object.

**Singleton as anti-pattern**
*Singleton create Global state of object. I would say global state is very bad because any code can change its value. So at the time of debugging it's really hard to find which portion of the code has made the current stage of global variable.
*Singleton is generally a bad idea if you are doing unit testing, and it's generally a bad idea not to perform unit testing.
