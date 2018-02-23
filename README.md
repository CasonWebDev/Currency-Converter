# Currency Converter

API Created with Lumen Framework to convert currencies using Google Financial.

## Installation

 - Clone this repository

Install the dependencies and start the server.

```sh
$ cd Currency-Converter
$ composer install
$ php -S localhost:8000
```

### Options

List of avaliable currencies names and codes
```sh
GET - /currency/currencies
```
Will return:
```sh
[{
    "value":"USD",
    "name":"US Dollar ($)"
}...]
```

Conversion from a currency to another one
```sh
POST - /currency/convert
```

These follow parameters are required in this request:
```sh
"amount" - Float
"from" - Base currency
"to" - Converted currency
```

- The fields "from" and "to" uses the parameter "value" from GET request

Example:
```sh
http://localhost:8000/currency/convert?amount=10&from=BRL&to=USD (POST REQUEST)
```

Will return:

```sh
{
    "converted": "3.09"
}
```

**Thanks, free feel to send a improvements**

License
----

MIT


**Free Software, Hell Yeah!**