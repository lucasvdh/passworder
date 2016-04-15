# Human-friendly password generator (dutch version)

Generates password from 2 parts: first is random, but well-readable string, second is a word from dictionary.

All options are in config file:

 - random_uppercase: make several letters uppercase [true/false]
 - uppercase_chance: chance to make letter uppercase. Applies for each letter. [0-9]
 - add_numbers: add or not numbers to password (to the end of both parts). [true/false]
 - number_chance: chance to add number [0-9]
 - words => [] : dictionary.



# Install

### 1: install via composer:
```
composer require lucasvdh/passworder
```

### 2: add service provider:

Open `config/app.php`, and add to the `providers` array:
```
Lucasvdh\Passworder\PassworderServiceProvider::class,
```

### 3: add facade alias:

In the `config/app.php`. add to the `aliases` array:
```
'Passworder' => Lucasvdh\Passworder\Facade\Passworder::class,
```

### 4: Publishing config:

Run in the console:
```
php artisan vendor:publish
```
Config will be moved to /config/passworder.php

# Usage examples:

Code:
```
for( $i=0; $i<10; $i++ ) {
	echo \Passworder::gen()."<br>";
}
```

Config:
```
	'random_uppercase' => true,
	'uppercase_chance' => 1,        # 0-9
	'add_numbers' => true,
	'number_chance' => 5,           # 0-9
	'delimeters'  => '-_!@%.#',
```

Output:
```
TODO
```
