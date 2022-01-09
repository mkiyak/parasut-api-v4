# Parasut API PHP

**Kaynak : https://apidocs.parasut.com**

## Kurulum
```
composer require mkiyak/parasut-api-v4
```

## Kullanımı

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

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
```

### Müşteri İşlemleri
```php
$contacts = new \Parasut\API\Contacts($parasutAuthorization);
```

- Müşteri listesi
```php
$contactList = $contacts->list_contacts();
```

- Müşteri görüntüleme
```php
$contact_id = 123456;
$showContact = $contacts->show($contact_id);
```

- Müşteri arama
```php
$searchContactData1 = [
	"name" => "XXXX"
];

$searchContactData2 = [
	"name" => "XXXX",
	"email" => "XXXX"
];

$searchContactData3 = [
	"name" => "XXXX",
	"email" => "XXXX",
	"tax_number" => "XXXX",
	"tax_office" => "XXXX",
	"city" => "XXXX",
	"account_type" => "customer" //customer, supplier
];
$searchContact1 = $contacts->search($searchContactData1);
$searchContact2 = $contacts->search($searchContactData2);
$searchContact3 = $contacts->search($searchContactData3);
```

- Yeni müşteri oluşturma
```php
$createContactData = [
	"data" => [
		"type" => "contacts",
		"attributes" => [
			"name" => "XXXX", //*zorunlu //ad soyad
			"email" => "XXXX", //e-posta
			"contact_type" => "person", //company, person (tüzel kişi, gerçek kişi)
			"tax_office" => "XXX", //vergi dairesi
			"tax_number" => "XXX", //vergi numarası
			"district" => "XXX", //ilçe
			"city" => "XXX", //il
			"address" => "XXX", //adres
			"phone" => "0XXXXXXXXXX", //tel no
			"account_type" => "customer" //customer, supplier
		]
	]
];
$createContact = $contacts->create($createContactData);
```

- Müşteri düzenleme
```php
$contact_id = 123456; //integer
$editContactData = [
	"data" => [
		"type" => "contacts",
		"attributes" => [
			"name" => "XXXX", //*required //ad soyad
			"email" => "XXXX", //e-posta
			"contact_type" => "person", //company, person (tüzel kişi, gerçek kişi)
			"tax_office" => "XXX", //vergi dairesi
			"tax_number" => "XXX", //vergi numarası
			"district" => "XXX", //ilçe
			"city" => "XXX", //il
			"address" => "XXX", //adres
			"phone" => "0XXXXXXXXXX", //tel no
			"account_type" => "customer" //customer, supplier
		]
	]
];
$editContact = $contacts->edit($contact_id, $editContactData);
```

- Müşteri silme
```php
$contact_id = 123456; //integer
$deleteContact = $contacts->delete($contact_id);
```

### Fatura İşlemleri
```php
$invoices = new \Parasut\API\Invoices($parasutAuthorization);
```

- Satış faturası listesi
```php
$invoiceList = $invoices->list_invoices();
```

- Satış faturası görüntüleme
```php
$invoice_id = 123456; //integer
$showInvoice = $invoices->show($invoice_id); //active_e_document,contact parametreleri ile beraber gelir
```

- Satış faturası arama
```php
$searchInvoiceData1 = [
	"invoice_id" => "XXXX"
];

$searchInvoiceData2 = [
	"invoice_id" => "XXXX",
	"contact_id" => "XXXX"
];

$searchInvoiceData3 = [
	"issue_date" => "XXXX",
	"due_date" => "XXXX",
	"contact_id" => "XXXX",
	"invoice_id" => "XXXX",
	"invoice_series" => "XXXX",
	"item_type" => "invoice",
	"print_status" => "printed", //printed, not_printed, invoices_not_sent, e_invoice_sent, e_archive_sent, e_smm_sent
	"payment_status" => "paid" //overdue, not_due, unscheduled, paid
];
$searchInvoice1 = $invoices->search($searchInvoiceData1);
$searchInvoice2 = $invoices->search($searchInvoiceData2);
$searchInvoice3 = $invoices->search($searchInvoiceData3);
```

- Satış faturası oluşturma
```php
$createInvoiceData = [
	"data" => [
		"type" => "sales_invoices",
		"attributes" => [
			"item_type" => "invoice",
			"description" => "XXXX XXXX XXXX", //fatura açıklaması
			"issue_date" => "YYYY-MM-DD", //düzenleme tarihi
			"due_date" => "YYYY-MM-DD", //son tahsilat tarihi
			"invoice_series" => "XXX", //fatura seri no
			"invoice_id" => "XXX", //fatura sıra no
			"currency" => "TRL", //döviz tipi // TRL, USD, EUR, GBP
			"shipment_included" => false, //irsaliye
		],
		"relationships" => [
			"details" => [
				"data" => [
					0 => [
						"type" => "sales_invoice_details",
						"attributes" => [
							"quantity" => 1, //birim adedi
							"unit_price" => 100, //birim fiyatı (kdv'siz fiyatı)
							"vat_rate" => 18, //kdv oranı
							"description" => "XXXXX" //ürün açıklaması
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
			],
			"contact" => [
				"data" => [
					"type" => "contacts",
					"id" => 123456 //müşteri id
				]
			]
		]
	]
];
$createInvoice = $invoices->create($createInvoiceData);
```

- Satış faturası düzenleme
```php
$editInvoiceData = [
	"data" => [
		"type" => "sales_invoices",
		"attributes" => [
			"item_type" => "invoice",
			"description" => "XXXX XXXX XXXX", //fatura açıklaması
			"issue_date" => "YYYY-MM-DD", //düzenleme tarihi
			"due_date" => "YYYY-MM-DD", //son tahsilat tarihi
			"invoice_series" => "XXX", //fatura seri no
			"invoice_id" => "XXX", //fatura sıra no
			"currency" => "TRL", //döviz tipi // TRL, USD, EUR, GBP
			"shipment_included" => false, //irsaliye
		],
		"relationships" => [
			"details" => [
				"data" => [
					0 => [
						"type" => "sales_invoice_details",
						"attributes" => [
							"quantity" => 1, //birim adedi
							"unit_price" => 100, //birim fiyatı (kdv'siz fiyatı)
							"vat_rate" => 18, //kdv oranı
							"description" => "XXXXX" //ürün açıklaması
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
			],
			"contact" => [
				"data" => [
					"type" => "contacts",
					"id" => 123456 //müşteri id
				]
			]
		]
	]
];

$invoice_id = 123456;
$editInvoice = $invoices->edit($invoice_id, $editInvoiceData);
```

- Satış faturası silme
```php
$invoice_id = 123456;
$deleteInvoice = $invoices->delete($invoice_id);
```

- Satış faturası iptal etme
```php
$invoice_id = 123456;
$cancelInvoice = $invoices->cancel($invoice_id);
```

- Satış faturasına tahsilat ekleme
```php
$invoice_id = 123456;
$payInvoiceData = [
	"data" => [
		"type" => "payments",
		"attributes" => [
			"account_id" => 1234, // Kasa veya Banka id
			"date" => "YYYY-MM-DD", //ödeme tarihi
			"amount" => 123 //ödeme tutarı
		]
	]
];
$invoices->pay($invoice_id, $payInvoiceData);
```

- Satış faturasını resmileştirme
```php
/* 
 * VKN e-fatura sistemine kayıtlıysa resmileştirme işleminde e-fatura olarak işlem yapılır 
 * değilse e-arşive olarak işlem yapılır
 */
$vkn = 12345678912;
$checkVKNType = $invoices->check_vkn_type($vkn);

//VKN e-fatura sistemine kayıtlı değil
if (empty($checkVKNType->result))
{
    $eArchiveData = [
	"data" => [
		"type" => "e_archives",
		"relationships" => [
			"sales_invoice" => [
				"data" => [
					"id" => 123456, //invoice_id
					"type" => "sales_invoices"
				    ]
			    ]
		    ]
	    ]
    ];
    $createEArchive = $invoices->create_e_archive($eArchiveData);
}
//VKN e-fatura sistemine kayıtlı
else
{
    $vkn = 12345678912;
    $checkVKNType = $invoices->check_vkn_type($vkn);
    $eInvoiceAddress = $checkVKNType->result->data[0]->attributes->e_invoice_address;

    $eInvoiceData = [
	"data" => [
		"type" => "e_invoices",
		"attributes" => [
        	'scenario' => 'basic', // basic veya commercial (temel veya ticari)
        	'to' => $eInvoiceAddress
        ],
		"relationships" => [
			"invoice" => [
				"data" => [
					"id" => 123456, //invoice_id
					"type" => "sales_invoices"
				    ]
			    ]
		    ]
	    ]
    ];
    $createEInvoice = $invoices->create_e_invoice($eInvoiceData);
}
```

- E-Arşiv görüntüleme
```php
$e_archive_id = 123456; //invoice_id değildir.
$showEArchive = $invoices->show_e_archive($e_archive_id);
```

- E-Arşiv PDF olarak görüntüleme
```php
$e_archive_id = 123456; //invoice_id değildir.
$pdfEArchive = $invoices->pdf_e_archive($e_archive_id);
```

- E-Fatura görüntüleme
```php
$e_invoice_id = 123456; //invoice_id değildir.
$showEArchive = $invoices->show_e_invoice($e_invoice_id);
```

- E-Fatura PDF olarak görüntüleme
```php
$e_invoice_id = 123456; //invoice_id değildir.
$pdfEArchive = $invoices->pdf_e_invoice($e_invoice_id);
```

### Fatura İşlemleri
```php
$purchases = new \Parasut\API\Purchase($parasutAuthorization);
```

- Gider faturası listesi
```php
$purchaseList = $purchases->list_purchase();
```

- Gider faturası görüntüleme
```php
$purchase_id = 123456; //integer
$showpurchase = $purchases->show($purchase_id); //active_e_document,contact parametreleri ile beraber gelir
```

- Gider faturası arama
```php
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
```

- Gider faturası oluşturma
```php
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
```

- Gider faturası düzenleme
```php
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
```

- Detaylı Gider faturası oluşturma
```php
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
```

- Detaylı Gider faturası düzenleme
```php
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
```

- Gider faturası silme
```php
$purchase_id = 123456;
$deletepurchase = $purchases->delete($purchase_id);
```

- Gider faturası iptal etme
```php
$purchase_id = 123456;
$cancelpurchase = $purchases->cancel($purchase_id);
```

### Ürün İşlemleri
```php
$products = new \Parasut\API\Products($parasutAuthorization);
```

- Ürün listesi
```php
$productList = $products->list_products();
```

- Ürün görüntüleme
```php
$product_id = 123456;
$showProduct = $products->show($product_id);
```

- Ürün arama
```php
$searchProductData1 = [
	"name" => "XXXX"
];

$searchProductData2 = [
	"name" => "XXXX",
	"code" => "XXXX"
];

$searchProduct1 = $products->search($searchProductData1);
$searchProduct2 = $products->search($searchProductData2);
```

- Yeni ürün oluşturma
```php
$productData = [
	"data" => [
		"type" => "products",
		"attributes" => [
			"name" => "XXXX", //ürün adı
			"vat_rate" => 18, //KDV oranı
			"unit" => "Adet", //birim
			"currency" => "TRL", //döviz tipi
			"inventory_tracking" => true, //stok durumu
			"initial_stock_count" => 100 //stok adedi
		]
	]
];
$createProduct = $products->create($productData);
```

- Ürün düzenleme
```php
$productData = [
	"data" => [
		"type" => "products",
		"attributes" => [
			"name" => "XXXX", //ürün adı
			"vat_rate" => 18, //KDV oranı
			"unit" => "Adet", //birim
			"currency" => "TRL", //döviz tipi
			"inventory_tracking" => true, //stok durumu
			"initial_stock_count" => 100 //stok adedi
		]
	]
];

$product_id = 123456;
$editProduct = $products->edit($product_id, $productData);
```

- Ürün silme
```php
$product_id = 123456;
$deleteProduct = $products->delete($product_id);
```


### Kategori İşlemleri
```php
$categories = new \Parasut\API\Categories($parasutAuthorization);
```

- Kategori Listesi
```php
$categoryList = $categories->list_categories();
```

- Kategori Görüntüleme
```php
$category_id = 123456; //integer
$showCategory = $categories->show($category_id);
```

- Kategori Arama
```php
$searchCategoryData1 = [
	"name" => "XXXX"
];

$searchCategoryData2 = [
	"name" => "XXXX",
	"category_type" => "XXXX"
];

$searchCategory1 = $categories->search($searchCategoryData1);
$searchCategory2 = $categories->search($searchCategoryData2);
```

- Kategori Ekleme
```php
$createCategoryData = [
	"data" => [
		"type" => "item_categories",
		"attributes" => [
			"name" => "XXXX", //*required // Kategori Adı
			"bg_color" => "XXXX", // Arka plan rengi
			"text_color" => "person", // Yazı rengi
			"category_type" => "XXX", // Kategori Tipi
			"parent_id" => 0,
		]
	]
];
$createCategory = $categories->create($createCategoryData);
```

- Kategori Düzenleme
```php
$category_id = 123456; //integer
$editCategoryData = [
	"data" => [
		"type" => "item_categories",
		"attributes" => [
            "name" => "XXXX", //*required // Kategori Adı
            "bg_color" => "XXXX", // Arka plan rengi
            "text_color" => "person", // Yazı rengi
            "category_type" => "XXX", // Kategori Tipi
            "parent_id" => 0,
		]
	]
];
$editCategory = $categories->edit($category_id, $editCategoryData);
```

- Kategori Silme
```php
$category_id = 123456; //integer
$deleteCategory = $categories->delete($category_id);
```

### Diğer İşlemler

- Etiketler
- Stok Hareketleri
- Depolar
- Çalışanlar
- Kasa ve Banka
```php
 Yukarıda ki işlemleri ve diğer tüm işlemleri tests klasörü içerisinde bulabilirsiniz.
```
