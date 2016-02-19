<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once '../../bootstrap.php';

use Escpos\Escpos;
use Escpos\Printers\StarCapabilityProfile;
use Escpos\Connectors\FilePrintConnector;
use Escpos\Graphics\ImagePrintBuffer;

/* This example shows the printing of Latvian text on the Star TUP 592 printer */
$profile = StarCapabilityProfile::getInstance();

/* Option 1: Native character encoding */
$connector = new FilePrintConnector("php://stdout");
$printer = new Escpos($connector, $profile);
$printer->text("Glāžšķūņa rūķīši dzērumā čiepj Baha koncertflīģeļu vākus\n");
$printer->cut();
$printer->close();

/* Option 2: Image-based output (formatting not available using this output) */
$buffer = new ImagePrintBuffer();
$connector = new FilePrintConnector("php://stdout");
$printer = new Escpos($connector, $profile);
$printer->setPrintBuffer($buffer);
$printer->text("Glāžšķūņa rūķīši dzērumā čiepj Baha koncertflīģeļu vākus\n");
$printer->cut();
$printer->close();
