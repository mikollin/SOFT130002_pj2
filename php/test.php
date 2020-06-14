<?php

class User
{
    public $name='zyl';
    public $ss=2;
    function f()
    {
        echo 'father';
    }
}

interface Person{
    public function f();
}

class Men extends User implements Person{
    function f(){
    echo 'person';
    }
}
$obj=new Men();
//$obj->name=[1,2];
//$ss='zyl';
//echo $obj->name[0];
//$obj2=clone $obj;
//echo $obj2->name[0];
//$obj2->name[0]=3;
//$obj->name[1]=0;
//echo $obj->name[0];
//
//echo $obj->name[1];

$obj->f('he',2);

