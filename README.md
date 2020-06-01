## GoDaddy PHP

> A minimalist Godaddy Php package which has the basic methods available. This package is open for PR, feel free to contribute :)

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

~~~php
try {
	$domain = Domain::initialize('YOUR_API_KEY', 'YOUR_SECRET_KEY', 'PRODUCTION_MODE');
	$mydomain = 'testingdomain.com';
	
	$check = $domain->available($domain);
	// To check multiple domains use: $domain->availableMultiple([]);
	
	if($check->isAvailable())
	{
		// Domain is available
		$domainPrice = $this->priceToString();
	}else{
		// Domain is not available
	}
}
~~~


### Domain Suggestion
> Returns a list of suggestions based in the keyword you specify.
~~~php
	$domain = Domain::initialize('YOUR_API_KEY', 'YOUR_SECRET_KEY', 'PRODUCTION_MODE');
	
	$keyword = 'mybestdomain';
	
	$suggestion = $domain->suggestion($keyword), 'LIMIT');
~~~

### Domain Purchase
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

### Change DNS Records
~~~php
	$domainName = 'testinjoooo.biz'; // An already registered domain name under your account
	$domain = Domain::initialize('YOUR_API_KEY', 'YOUR_SECRET_KEY', 'PRODUCTION_MODE');
	
	$domain->records($domainName, 'RECORD_TYPE', [
        ['name' => 'Point', 'data' => '123.1.1.1'],
        ['name' => 'Point2', 'data' => '123.1.1.3'],
    ])->set();
~~~