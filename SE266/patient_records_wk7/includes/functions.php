<?php 

//Age Function taken from the Assignment Page on Canvas
function getAge($birthday){
    $date = new DateTime($birthday);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}

//BMI calculated by taking in height in feet and inches, and weight, converting them to metric, and using the BMU formula to calulate BMI
function calcBMI($feet, $inches, $weight){
    $weightInKg = $weight/2.20462;
    $heightInInches = ($feet * 12) + $inches;
    $heightInMeters = $heightInInches * 0.0254;
    $BMI = $weightInKg / ($heightInMeters * $heightInMeters);
    return $BMI;
}

//Simple function to calculate a persons BMI classification by comparing to a value and returning a string. 
function bmiClassifier($BMI){
    $classification = '';
    if($BMI < 18.5)
        $classification = 'Underweight';
    else if($BMI < 24.9)
        $classification = 'Normal Weight';
    else if($BMI < 29.9)
        $classification = 'Overweight';
    else
        $classification = 'Obese';

    return $classification;
}

function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

function isGetRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' && !empty($_GET) );
}

?>