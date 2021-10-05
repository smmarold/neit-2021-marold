<?php

//The function. formats the dump and dies. 
function dd($value){
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}