<?php
require_once 'curl_helper.php';

$restAPIBaseURL = 'http://localhost/php/REST-API-JWT';
echo "REST API Base URL: $restAPIBaseURL\n<br>";
$token = 'your key here';

$headers = [
    "Authorization: Bearer $token"
];

try {
    // GET all employees
    $employees = sendRequest($restAPIBaseURL . '/api.php/employees', 'GET', [], $headers);
    echo "1 <br>";
    print_r(json_decode($employees, true));

    // GET employee by ID
    $employeeId = 1;
    $employee = sendRequest($restAPIBaseURL . "/api.php/employees/$employeeId", 'GET', [], $headers);
     echo "<br> 2 <br>";
    print_r(json_decode($employee, true));

    // POST new employee
    $data = [
        'emp_name' => 'John Doe',
        'emp_code' => 'E001',
        'emp_email' => 'john.doe@example.com',
        'emp_phone' => '1234567890',
        'emp_address' => '123 Street, City',
        'emp_designation' => 'Manager',
        'emp_joining_date' => '2022-01-01',
    ];
    $result = sendRequest($restAPIBaseURL . '/api.php/employees', 'POST', $data, $headers);
     echo "<br> 3 <br>";
    print_r(json_decode($result, true));

    // PUT update employee
    $data['emp_name'] = 'Updated John';
    $result = sendRequest($restAPIBaseURL . "/api.php/employees/$employeeId", 'PUT', $data, $headers);
     echo "<br> 4 <br>";
    print_r(json_decode($result, true));

    // DELETE employee
    $result = sendRequest($restAPIBaseURL . "/api.php/employees/$employeeId", 'DELETE', [], $headers);
     echo "<br> 5 <br>";
    print_r(json_decode($result, true));
    
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
