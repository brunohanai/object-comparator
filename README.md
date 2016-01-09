# ObjectComparator [![Build Status](https://travis-ci.org/brunohanai/object-comparator.svg)](https://travis-ci.org/brunohanai/object-comparator)

<!--[![Total Downloads](https://img.shields.io/packagist/dt/monolog/monolog.svg)](https://packagist.org/packages/monolog/monolog)-->
<!--[![Latest Stable Version](https://img.shields.io/packagist/v/monolog/monolog.svg)](https://packagist.org/packages/monolog/monolog)-->
<!--[![Reference Status](https://www.versioneye.com/php/monolog:monolog/reference_badge.svg)](https://www.versioneye.com/php/monolog:monolog/references)-->

> **Atenção: esse componente foi desenvolvido para meu aprendizado e não deve ser considerado confiável. Use-o a seu critério.** 

> **Do not rely on this component. It is just for learning.** 

ObjectComparator recebe dois objetos (do mesmo tipo) e informa se há diferença em suas propriedades.

O componente pode ser resumido em três funções:

* **Comparator:** informa se há, ou não, diferença entre os dois objetos.
* **Differ:** retorna uma lista com as diferenças (DiffCollection).
* **Logger:** registra as diferenças encontradas. O Logger vem com duas implementações padrão e possui uma interface para que o usuário faça suas próprias implementações.
 
## Instalação

Instale a última versão utilizando o composer:

```bash
$ composer require brunohanai/object-comparator
```

## Uso Básico - Comparator

```php
<?php

use brunohanai\ObjectComparator\Comparator;

// create a Comparator
$comparator = new Comparator();

// create two identical objects
$object1 = new stdClass();
$object1->description = 'Description';
$object1->code = 'DESC';
// ---
$object2 = new stdClass();
$object2->description = 'Description';
$object2->code = 'DESC';

// compare
$comparator->isEquals($object1, $object2)); // outputs true
$comparator->isNotEquals($object1, $object2)); // outputs false


// change one property
$object2->description = 'New Description';

// compare again
var_dump($comparator->isEquals($object1, $object2)); // outputs false
var_dump($comparator->isNotEquals($object1, $object2)); // outputs true
```

## Uso Básico - Differ

```php
<?php

use brunohanai\ObjectComparator\Comparator;
use brunohanai\ObjectComparator\Differ\Differ;

// create a Differ (injecting a Comparator)
$differ = new Differ(new Comparator());

// create two identical objects
$object1 = new stdClass();
$object1->description = 'Description';
$object1->code = 'DESC';
// ---
$object2 = new stdClass();
$object2->description = 'Description';
$object2->code = 'DESC';

// get the diffs
$diffs = $differ->diff($object1, $object2); // returns a DiffCollection with no diffs
var_dump($diffs->getDiffs()->count()); // outputs 0
var_dump($diffs->getArrayCopy()); // outputs the result as array
var_dump($diffs->printAsJson()); // outputs the result as json


// change one property
$object2->description = 'New Description';

// get the diffs again
$diffs = $differ->diff($object1, $object2); // returns a DiffCollection with the diffs
var_dump($diffs->getDiffs()->count()); // outputs 1
var_dump($diffs->getArrayCopy()); // outputs the result as array
var_dump($diffs->printAsJson()); // outputs the result as json
```

## Uso Básico - Logger

```php
<?php

use brunohanai\ObjectComparator\Differ\Differ;
use brunohanai\ObjectComparator\Comparator;
use brunohanai\ObjectComparator\Differ\Logger\DefaultLogger;
use Psr\Log\LogLevel;

// create a Differ (injecting a Comparator)
$differ = new Differ(new Comparator());

// create a Logger
$logger = new DefaultLogger();

// create two different objects
$object1 = new stdClass();
$object1->description = 'Description';
$object1->code = 'DESC';
// ---
$object2 = new stdClass();
$object2->description = 'New Description';
$object2->code = 'NEW_DESC';

// get the diffs
$diffs = $differ->diff($object1, $object2); //returns a DiffCollection with two diffs (description and code)

// log (passing the diffs and log level)
$logger->log($diffs, false, LogLevel::INFO); // the DefaultLogger puts a new line in your default PHP error_log file
```

## Avançado - Criando o seu próprio Logger

### Exemplo de Logger que registra a informação em um banco de dados (ajuste o código para o seu caso):

```php
<?php

use brunohanai\ObjectComparator\Differ\DiffCollection;
use brunohanai\ObjectComparator\Differ\Logger\ILogger;
use Psr\Log\LogLevel;

// adjust the class name
class DatabaseDifferLogger implements ILogger
{
    private $data;

    public function __construct()
    {
        $this->data = new ClogLoginHistData(); // this is my own class, adjust it
    }

    public function log(DiffCollection $diffs, $slim_version = false, $level = LogLevel::DEBUG)
    {
        // this is my code, adjust it:
        
        $obj = new ClogLoginHist(); // this is my own object, adjust it

        $obj->setData(date('Y-m-d'), false); // info that are not in DiffCollection
        $obj->setHora(date('H:i:s')); // info that are not in DiffCollection
        
        $obj->setLogin($_SESSION['USER_ID']);  // this is my own info, are not in DiffCollection
        
        $obj->setSessao($diffs->printAsJson($slim_version), false); // DiffCollection result as JSON

        $this->data->insertClogLoginHist($obj); // this is my own method, adjust it 
    }
}
```

### Utilizando o Differ + Logger:

```php
<?php
require_once('DatabaseDifferLogger.php');

use brunohanai\ObjectComparator\Differ\Differ;
use brunohanai\ObjectComparator\Comparator;
use Psr\Log\LogLevel;

// create a Differ (injecting a Comparator)
$differ = new Differ(new Comparator());

// create your new Logger
$logger = new DatabaseDifferLogger();

// create two different objects
$object1 = new stdClass();
$object1->description = 'Description';
$object1->code = 'DESC';
// ---
$object2 = new stdClass();
$object2->description = 'New Description';
$object2->code = 'NEW_DESC';

// get the diffs
$diffs = $differ->diff($object1, $object2); //returns a DiffCollection with two diffs (description and code)

// log (passing the diffs and log level)
$logger->log($diffs, true, LogLevel::INFO); // your Logger will execute your code
```

## Sobre

### Requisitos

* Funciona com o PHP 5.3.3 ou superior.

### Informe bugs e solicite melhorias

* Bugs e melhorias serão tratados [aqui pelo GitHub](https://github.com/brunohanai/object-comparator/issues).

### Autor

* Bruno Hanai

### License

MIT license - leia o arquivo `LICENSE` para maiores detalhes.