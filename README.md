# GoDaddy PHP 🐘

A minimalist Godaddy PHP package for most of your operations with GoDaddy API..
*This package is open for PR, feel free to contribute :)*

### System Requirements
You need:
- PHP >= 7.2 but the latest stable version of PHP is highly recommended
-   the `intl` extension


### Installation

~~~php
composer require tafhyseni/godaddy-php;
~~~

### Usage

Before using GoDaddy PHP make sure you have already created a developer account at [Godaddy Developer Portal](https://developer.godaddy.com/).
>Since this package uses `php-domain-parser` for validations and interactions with domain, make sure you **enable ext-intl** extension in your `php.ini` configuration.

~~~php
use Tafhyseni\PhpGodaddy\Domain;
Domain::initialize('YOUR_API_KEY', 'YOUR_SECRET_KEY', 'PRODUCTION_MODE');
~~~

### Methods
#### Check Domain Availability
>Returns domain availability status, price to string, currency and period.

An example checking domain availability is as simple as it follows

~~~php
try {
	$domain = Domain::initialize('YOUR_API_KEY', 'YOUR_SECRET_KEY', 'PRODUCTION_MODE');
	$mydomain = 'testingdomain.com';
	
	$check = $domain->available($domain);
	
	if($check->isAvailable())
	{
		// Domain is available
		$domainPrice = $this->priceToString();
	}else{
		// Domain is not available
	}
}
~~~

Available response properties and methods

| Parameter / Method | Data type | Description                                                  |
| ------------------ | --------- | ------------------------------------------------------------ |
| isAvailable()      | bool      | Returns domain availability status                           |
| priceToString()    | string    | Returns a response message containing: { price } { currency } / { period } year(s) |
| domain             | string    | Requested domain                                             |
| availability       | integer   | Availability status                                          |
| price              | float     | Domain price                                                 |
| currency           | string    | Currency in which price is listed                            |
| period             | integer   | Domain availability period                                   |

#### Multiple Domain Checks
> A multiple availability check is covered aswell
~~~php
$domain->availableMultiple([]);
~~~

#### Domain Suggestion
> Returns a list of suggestions based in the keyword you specify.
~~~php
$domain = Domain::initialize('YOUR_API_KEY', 'YOUR_SECRET_KEY', 'PRODUCTION_MODE');

$keyword = 'mybestdomain';

$suggestion = $domain->suggestion($keyword, 'LIMIT');
~~~

| Request parameters | Data type | Default |
| ------------------ | --------- | ------- |
| keyword            | string    | -       |
| limit              | integer   | 97      |

| Response parameters | Description               |
| ------------------- | ------------------------- |
| keyword             | Requested keyword         |
| limit               | Requested limit           |
| domains             | Array of returned domains |

#### Domain Purchase
> Purchase domain from Godaddy. First, set payment method for your account in Godaddy developer portal.
~~~php
$domainName = 'mypurchasedomain.com';
$domain = Domain::initialize('YOUR_API_KEY', 'YOUR_SECRET_KEY', 'PRODUCTION_MODE');

$options = [
    'name'         => 'John',
    'surname'      => 'Doe',
    'email'        => 'john.doe@example.com',
    'phone'        => '+48.111111111',
    'organization' => 'Corporation Inc.',
    'street'       => 'Street Ave. 666',
    'city'         => 'New York City',
    'country'      => 'US',
    'postalCode'  => '91111',
    'state'        => 'New York'
];
	
try {
    $purchase = $domain->purchase($domainName, $options)
        ->nameServers([
            'dns.nameserver.com',
            'dns2.nameserver.com'
        ]);
}catch(Exception $e) {
    // Catch Exception
}
~~~

| Request parameters | Data type | Default |
| ------------------ | --------- | ------- |
| domain             | string    | -       |
| options            | array     | -       |
| nameServers()      | array     | -       |
| period()           | integer   | 1       |
| autorenew()        | bool      | true    |

| Response paramters | Data type | Description                                                  |
| ------------------ | --------- | ------------------------------------------------------------ |
| currency           | string    | Currency in which total is listed                            |
| itemCount          | integer   | Number of items included in the order                        |
| orderId            | integer   | Unique identifier of the order processed                     |
| total              | integer   | Total cost of the domain and any selection addons in micro unit |

#### Changing DNS Records

~~~php
$domainName = 'testinjoooo.biz'; // An already registered domain name under your account
$domain = Domain::initialize('YOUR_API_KEY', 'YOUR_SECRET_KEY', 'PRODUCTION_MODE');
	
$domain->records($domainName, 'RECORD_TYPE', [
	['name' => 'Point', 'data' => '123.1.1.1'],
	['name' => 'Point2', 'data' => '123.1.1.3'],
])->set();
~~~

### Default API Return object
A general API response object is already declared and returns the following properties
 property | data type | description 
---------------|----------------- |---------------
 httpStatus | integer | Http response code 
 httpHeaders | array | Http headers 
 httpBody | Object | Method properties 
 httpMessage | string | Any available http message 

 ### Exceptions
 We created custom responses which should be catched from your side. Therefor, using try/catch blocks is **highly recommended**.

Common Exception thrown

| Code | Name                 | Message                                                      |
| ---- | -------------------- | ------------------------------------------------------------ |
| 401  | noApiKeyProvided     | API Key has not been provided!                               |
| 401  | noSecretKeyProvided  | Secret Key has not been provided!                            |
| 401  | authorizationFailed  | Authorization failed. Check your secret/api keys.            |
| 400  | noDomainProvided     | Domain name is required and cannot be empty!                 |
| 422  | noKeywordProvided    | No keyword has been specified!                               |
| 400  | invalidDomainPeriod  | Domain period should be within 1 and 10 range                |
| 404  | domainNotAvailable   | Domain is not available for registration                     |
| 403  | invalidPaymentInfo   | Invalid payment information provided at your API account!    |
| 400  | invalidRecordType    | Record type is invalid. Available types are: A, AAA, CNAME, MX, NS, SRV, TXT |
| 404  | recordDomainNotFound | Given domain has not been found or is not registered         |

