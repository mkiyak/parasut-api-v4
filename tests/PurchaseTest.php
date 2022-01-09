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
$purchases = new \Parasut\API\Purchase($parasutAuthorization);

// Gider faturası listesi
$purchaseList = $purchases->list_purchase();

// Gider faturası görüntüleme
$purchase_id = 123456; //integer
$showpurchase = $purchases->show($purchase_id); //active_e_document,contact parametreleri ile beraber gelir

// Gider faturası arama
$searchpurchaseData1 = [
    "purchase_id" => 12345
];
$searchpurchaseData2 = [
    "purchase_id" => 12345,
    "supplier_id" => 12345
];

$searchpurchaseData3 = [
    "issue_date" => "XXXX",
    "due_date" => "XXXX",
    "supplier_id" => 12345,
    "spender_id" => 12345,
    "item_type" => "purchase", // purchase_bill, refund, cancelled
];
$searchpurchase1 = $purchases->search($searchpurchaseData1);
$searchpurchase2 = $purchases->search($searchpurchaseData2);
$searchpurchase3 = $purchases->search($searchpurchaseData3);

// Gider faturası oluşturma
$createpurchaseData = [
    "data" => [
        "type" => "purchase_bills",
        "attributes" => [
            "item_type" => "purchase_bill", //*required // purchase_bill, refund
            "description" => "string", // Açıklama
            "issue_date" => "2022-01-09", //*required
            "due_date" => "2022-01-09", //*required
            "invoice_no" => "string",
            "currency" => "TRL",  //*required //döviz tipi // TRL, USD, EUR, GBP
            "exchange_rate" => 0,
            "net_total" => 0, //*required
            "total_vat" => 0 //*required
        ]
    ]
];
$createpurchase = $purchases->create($createpurchaseData);

// Gider faturası düzenleme
$editpurchaseData = [
    "data" => [
        "type" => "purchase_bills",
        "attributes" => [
            "item_type" => "purchase_bill", //*required // purchase_bill, refund
            "description" => "string", // Açıklama
            "issue_date" => "2022-01-09", //*required
            "due_date" => "2022-01-09", //*required
            "invoice_no" => "string",
            "currency" => "TRL",  //*required //döviz tipi // TRL, USD, EUR, GBP
            "exchange_rate" => 0,
            "net_total" => 0, //*required
            "total_vat" => 0 //*required
        ]
    ]
];

$purchase_id = 123456;
$editpurchase = $purchases->edit($purchase_id, $editpurchaseData);

// Detaylı Gider faturası oluşturma
$createpurchaseData = [
    "data" => [
        "type" => "purchase_bills",
        "attributes" => [
            "item_type" => "purchase_bill", //*required // purchase_bill, refund
            "description" => "string", // Açıklama
            "issue_date" => "2022-01-09", //*required
            "due_date" => "2022-01-09", //*required
            "invoice_no" => "string",
            "currency" => "TRL",  //*required //döviz tipi // TRL, USD, EUR, GBP
            "exchange_rate" => 0,
            "net_total" => 0, //*required
            "total_vat" => 0 //*required
        ],
        "relationships" => [
            "details" => [
                "data" => [
                    0 => [
                        "type" => "purchase_bill_details",
                        "attributes" => [
                            "quantity" => 1, //birim adedi
                            "unit_price" => 100, //birim fiyatı (kdv'siz fiyatı)
                            "vat_rate" => 18, //kdv oranı
                            "description" => "XXXXX", //ürün açıklaması
                            "discount_type" => "percentage", // percentage, amount
                            "discount_value" => 0,
                            "excise_duty_type" => "percentage", // percentage, amount
                            "excise_duty_value" => 0,
                            "communications_tax_rate" => 0,
                        ],
                        "relationships" => [
                            "product" => [
                                "data" => [
                                    "id" => 123456, //ürün id
                                    "type" => "products"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
$createpurchase = $purchases->create($createpurchaseData, '#detailed');

// Detaylı Gider faturası düzenleme
$editpurchaseData = [
    "data" => [
        "type" => "purchase_bills",
        "attributes" => [
            "item_type" => "purchase_bill", //*required // purchase_bill, refund
            "description" => "string", // Açıklama
            "issue_date" => "2022-01-09", //*required
            "due_date" => "2022-01-09", //*required
            "invoice_no" => "string",
            "currency" => "TRL",  //*required //döviz tipi // TRL, USD, EUR, GBP
            "exchange_rate" => 0,
            "net_total" => 0, //*required
            "total_vat" => 0 //*required
        ],
        "relationships" => [
            "details" => [
                "data" => [
                    0 => [
                        "type" => "purchase_bill_details",
                        "attributes" => [
                            "quantity" => 1, //birim adedi
                            "unit_price" => 100, //birim fiyatı (kdv'siz fiyatı)
                            "vat_rate" => 18, //kdv oranı
                            "description" => "XXXXX", //ürün açıklaması
                            "discount_type" => "percentage", // percentage, amount
                            "discount_value" => 0,
                            "excise_duty_type" => "percentage", // percentage, amount
                            "excise_duty_value" => 0,
                            "communications_tax_rate" => 0,
                        ],
                        "relationships" => [
                            "product" => [
                                "data" => [
                                    "id" => 123456, //ürün id
                                    "type" => "products"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];

$purchase_id = 123456;
$editpurchase = $purchases->edit($purchase_id, $editpurchaseData, '#detailed');

// Gider faturası silme
$purchase_id = 123456;
$deletepurchase = $purchases->delete($purchase_id);

// Gider faturası iptal etme
$purchase_id = 123456;
$cancelpurchase = $purchases->cancel($purchase_id);