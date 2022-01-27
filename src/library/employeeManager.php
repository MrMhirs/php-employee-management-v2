<?php

/**
 * EMPLOYEE FUNCTIONS LIBRARY
 *
 * @author: Jose Manuel Orts
 * @date: 11/06/2020
 */
function listEmployee()
{
    $content = file_get_contents(".././../resources/employees.json");
    return json_decode($content);
}



function addEmployee($newEmployee)
{

    // TODO implement it
    $empleadosUncode = file_get_contents("../../resources/employees.json");
    $empleadosDecode = json_decode($empleadosUncode);
    print_r($empleadosDecode);
    $lastEmployee = end($empleadosDecode);
    $newEmployee["id"] = $lastEmployee->id + 1;
    array_push($empleadosDecode, $newEmployee);
    echo "true";
    $newest = json_encode($empleadosDecode);
    file_put_contents("../../resources/employees.json", $newest);
}


function deleteEmployee($id)
{
    // TODO implement it
    $newEmployee = [];
    $empleadosUncode = file_get_contents("../../resources/employees.json");
    $empleadosDecode = json_decode($empleadosUncode);
    foreach ($empleadosDecode as $empleado) {
        if (!($empleado->id == $id)) {
            array_push($newEmployee, $empleado);
        }
    }
    sendEmployee($newEmployee);
    echo "true";
}


function updateEmployee($updateEmployee)
{
    // TODO implement it
    $empleados = listEmployee();
    foreach ($empleados as $empleado) {
        if ($empleado->id == $updateEmployee) {
            $empleado->id = $_POST["id"];
            $empleado->name = $_POST["name"];
            $empleado->gender = $_POST["gender"];
            $empleado->lastName = $_POST['lastName'];
            $empleado->email = $_POST['email'];
            $empleado->age = $_POST['age'];
            $empleado->city = $_POST['city'];
            $empleado->state = $_POST['state'];
            $empleado->streetAddress = $_POST['streetAddress'];
            $empleado->phoneNumber = $_POST['phoneNumber'];
            $empleado->postalCode = $_POST['postalCode'];
        }
    }
    sendEmployee($empleados);
}

function updateEmployeePhp($updateEmployee)
{
    // TODO implement it
    $empleadosUncode = file_get_contents("../resources/employees.json");
    $empleadosDecode = json_decode($empleadosUncode);
    foreach ($empleadosDecode as $empleado) {

        if ($empleado->id == $updateEmployee) {
            $empleado->id = $_POST["id"];
            $empleado->name = $_POST["name"];
            $empleado->gender = $_POST["gender"];
            $empleado->lastName = $_POST['lastName'];
            $empleado->email = $_POST['email'];
            $empleado->age = $_POST['age'];
            $empleado->city = $_POST['city'];
            $empleado->state = $_POST['state'];
            $empleado->streetAddress = $_POST['streetAddress'];
            $empleado->phoneNumber = $_POST['phoneNumber'];
            $empleado->postalCode = $_POST['postalCode'];
        }
    }
    sendEmployeePhp($empleadosDecode);
}

function sendEmployee($content)
{
    $file = ".././../resources/employees.json";
    $usersAll = json_encode($content);
    $Allusers = file_put_contents($file, $usersAll);
}

function sendEmployeePhp($content)
{
    $file = "../resources/employees.json";
    $usersAll = json_encode($content);
    $Allusers = file_put_contents($file, $usersAll);
}

function getEmployee($id)
{
    $empleadosUncode = file_get_contents("../resources/employees.json");
    $empleadosDecode = json_decode($empleadosUncode);
    foreach ($empleadosDecode as $empleado) {
        if ($empleado->id == $id) {
            return $formInfo = array(
                "id" => $empleado->id, "name" => $empleado->name, "lastName" => $empleado->lastName, "gender" => $empleado->gender, "email" => $empleado->email, "age" => $empleado->age, "city" => $empleado->age,
                "state" => $empleado->state, "streetAddress" => $empleado->streetAddress, "phoneNumber" => $empleado->phoneNumber, "postalCode" => $empleado->postalCode
            );
        }
    }
}


// function removeAvatar($id)
// {
//     // TODO implement it
// }


// function getQueryStringParameters(): array
// {
//     // TODO implement it
// }

// function getNextIdentifier(array $employeesCollection): int
// {
//     // TODO implement it
// }