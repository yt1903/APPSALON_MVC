<?php 

require __DIR__ . '/../vendor/autoload.php';
//Para leer las variables de entorno vlucas/phpdotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv -> safeLoad();//Si no esta el archivo .env no marcar un error, con esta linea



require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);