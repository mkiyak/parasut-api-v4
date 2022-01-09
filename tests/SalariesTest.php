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
// # Fatura İşlemleri
$salaries = new \Parasut\API\Salaries($parasutAuthorization);

// Maaş listesi
$salariesList = $salaries->list_salaries();

// Maaş görüntüleme
$salaries_id = 123456; //integer
$showsalaries = $salaries->show($salaries_id);

// Maaş arama
$searchsalariesData1 = [
    "salaries_id" => 12345
];

$searchsalariesData2 = [
    "issue_date" => "XXXX",
    "due_date" => "XXXX",
    "currency" => 'TRL', //döviz tipi // TRL, USD, EUR, GBP
    "remaining" => 4525,
];
$searchsalaries1 = $salaries->search($searchsalariesData1);
$searchsalaries2 = $salaries->search($searchsalariesData2);

// Maaş oluşturma
$createsalariesData = [
    "data" => [
        "type" => "salaries",
        "attributes" => [
            "description" => "string", //*required // Açıklama
            "issue_date" => "2022-01-09", //*required
            "due_date" => "2022-01-09", //*required
            "currency" => "TRL",  //*required //döviz tipi // TRL, USD, EUR, GBP
            "exchange_rate" => 0,
            "net_total" => 0, //*required
        ]
    ]
];
$createsalaries = $salaries->create($createsalariesData);

// Maaş düzenleme
$editsalariesData = [
    "data" => [
        "type" => "salaries",
        "attributes" => [
            "description" => "string", //*required // Açıklama
            "issue_date" => "2022-01-09", //*required
            "due_date" => "2022-01-09", //*required
            "currency" => "TRL",  //*required //döviz tipi // TRL, USD, EUR, GBP
            "exchange_rate" => 0,
            "net_total" => 0, //*required
        ]
    ]
];

$salaries_id = 123456;
$editsalaries = $salaries->edit($salaries_id, $editsalariesData);

// Maaş silme
$salaries_id = 123456;
$deletesalaries = $salaries->delete($salaries_id);

//pay Salary
$salary_id = 123456;
$paySalaryData = [
    "data" => [
        "type" => "payments",
        "attributes" => [
            "description" => "string", // Açıklama
            "account_id" => 1234, // Kasa veya Banka id
            "date" => "YYYY-MM-DD", //ödeme tarihi
            "amount" => 123, //ödeme tutarı
            "exchange_rate" => 0
        ]
    ]
];
$salaries->pay($salary_id, $paySalaryData);
//pay Salary