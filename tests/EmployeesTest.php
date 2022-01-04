<?php
try {
	$parasutAuthorization = new \Parasut\API\Authorization([
		"development" => true, //development mode
		"client_id" => "YOUR_CLIENT_ID",
		"client_secret" => "YOUR_CLIENT_SECRET",
		"username" => "YOUR_EMAIL",
		"password" => "YOUR_PASSWORD",
		"redirect_uri" => "urn:ietf:wg:oauth:2.0:oob",
		"company_id" => "YOUR_COMPANY_ID"
	]);
} catch (\Parasut\API\Exception $e) {
	echo "Error code : " . $e->getCode()."<br>";
	echo "Error message : " . $e->getMessage();
	die;
}

$employees = new \Parasut\API\Employees($parasutAuthorization);

//employee list
$employeeList = $employees->list_employees();
//employee list

//show employee
$employee_id = 123456; //integer
$showEmployees = $employees->show($employee_id);
//show employee

//search employee
$searchEmployeesData1 = [
	"name" => "XXXX"
];

$searchEmployeesData2 = [
	"name" => "XXXX",
	"email" => "XXXX"
];
$searchEmployees1 = $employees->search($searchEmployeesData1);
$searchEmployees2 = $employees->search($searchEmployeesData2);
//search employee

//create employee
$createEmployeesData = [
	"data" => [
		"type" => "employees",
		"attributes" => [
			"name" => "XXXX", //*required //ad soyad
			"email" => "XXXX", //e-posta
			"archived" => true,
			"iban" => "XXX", // IBAN
		]
	]
];
$createEmployees = $employees->create($createEmployeesData);
//create employee

//edit employee
$employee_id = 123456; //integer
$editEmployeesData = [
	"data" => [
		"type" => "employees",
		"attributes" => [
            "name" => "XXXX", //*required //ad soyad
            "email" => "XXXX", //e-posta
            "archived" => true,
            "iban" => "XXX", // IBAN
		]
	]
];
$editEmployees = $employees->edit($employee_id, $editEmployeesData);
//edit employee

//delete employee
$employee_id = 123456; //integer
$deleteEmployees = $employees->delete($employee_id);
//delete employee

