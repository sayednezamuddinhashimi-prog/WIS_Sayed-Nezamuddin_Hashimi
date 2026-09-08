<?php 

// TASK => 1 --------------------
class Libary{
    const MAX_BOOOKS=3;


}
// this is constant value because during write programming you can
// chnage its value
echo Libary::MAX_BOOOKS;

// TASK => 2 --------------------

class StudentCounter{
    public static $count=0;
    
    public function addStudent(){
        echo self::$count++;
    }
}

StudentCounter::addStudent();
echo StudentCounter::$count;


// TASK => 3 --------------------

abstract class Vehicle{
    abstract public function start();
    

}

class Car extends Vehicle{
    public function start(){
        echo 'Car engine started';
    }
}

class Bike extends Vehicle{
    public function start(){
        echo 'Bike started';
    }


}
$Car1=new Car();
$Car1->start();
$Bike=new Bike();
$Bike->start();


?>