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

$accounts = new \Parasut\API\Accounts($parasutAuthorization);

//account list
$accountList = $accounts->list_accounts();
//account list

//show account
$account_id = 123456; //integer
$showAccount = $accounts->show($account_id);
//show account

//search account
$searchAccountData1 = [
	"name" => "XXXX"
];

$searchAccountData2 = [
	"name" => "XXXX",
	"currency" => "XXXX"
];

$searchAccountData3 = [
    "name" => "XXXX",
    "currency" => "XXXX",
    "bank_name" => "XXXX",
    "bank_branch" => "XXXX",
    "account_type" => "XXXX",
    "iban" => "XXXX"
];

$searchAccount1 = $accounts->search($searchAccountData1);
$searchAccount2 = $accounts->search($searchAccountData2);
$searchAccount3 = $accounts->search($searchAccountData3);
//search account

//create account
$createAccountData = [
	"data" => [
		"type" => "accounts",
		"attributes" => [
			"name" => "XXXX", //*required // Hesap ismi
			"currency" => "TRL", // "TRL", "USD", "EUR", "GBP"
			"account_type" => "bank", // "cash", "bank", "sys" // Hesap tipi
            "bank_name" => "XXX", // Banka ismi
			"bank_branch" => "XXX", // Banka şubesi
            "bank_account_no" => "XXX", // Banka hesap no
            "iban" => "XXX", // IBAN
            "archived" => true
		]
	]
];
$createAccount = $accounts->create($createAccountData);
//create account

//edit account
$account_id = 123456; //integer
$editAccountData = [
	"data" => [
		"type" => "accounts",
		"attributes" => [
            "name" => "XXXX", //*required // Hesap ismi
            "currency" => "TRL", // "TRL", "USD", "EUR", "GBP"
            "account_type" => "bank", // "cash", "bank", "sys" // Hesap tipi
            "bank_name" => "XXX", // Banka ismi
            "bank_branch" => "XXX", // Banka şubesi
            "bank_account_no" => "XXX", // Banka hesap no
            "iban" => "XXX", // IBAN
            "archived" => true
		]
	]
];
$editAccount = $accounts->edit($account_id, $editAccountData);
//edit account

//delete account
$account_id = 123456; //integer
$deleteAccount = $accounts->delete($account_id);
//delete account

// Account Transaction List
$account_id = 123456; //integer
$accountTransaction = $accounts->list_transactions($account_id);
// Account Transaction List

// Account Transaction Debit
$account_id = 123456; //integer
$accountTransactionData = [
    "data" => [
        "type" => "transactions",
        "attributes" => [
            "date" => "2022-01-04", //*required // İşlem Tarihi
            "amount" => 1450, //*required // Tutar
            "description" => "XXX", // İşlem Açıklaması
        ]
    ]
];
$accountTransaction = $accounts->import_transactions($account_id, $accountTransactionData);
// Account Transaction Debit

// Account Transaction Credit
$account_id = 123456; //integer
$accountTransactionCreditData = [
    "data" => [
        "type" => "transactions",
        "attributes" => [
            "date" => "2022-01-04", //*required // İşlem Tarihi
            "amount" => 1450, //*required // Tutar
            "description" => "XXX", // İşlem Açıklaması
        ]
    ]
];
$accountTransactionCredit = $accounts->export_transactions($account_id, $accountTransactionCreditData);
// Account Transaction Credit