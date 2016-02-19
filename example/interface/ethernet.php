<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once '../../bootstrap.php';

/* Change to the correct path if you copy this example! */
use Escpos\Escpos;
use Escpos\Connectors\NetworkPrintConnector;

/* Most printers are open on port 9100, so you just need to know the IP 
 * address of your receipt printer, and then fsockopen() it on that port.
 */
try {
    $connector = new NetworkPrintConnector("10.x.x.x", 9100);
    /* Print a "Hello world" receipt" */
    $printer = new Escpos($connector);
    $printer->text("Hello World!\n");
    $printer->cut();
    /* Close printer */
    $printer->close();
} catch(Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}

