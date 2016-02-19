<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once '../../bootstrap.php';
/* Change to the correct path if you copy this example! */
use Escpos\Escpos;
use Escpos\Connectors\WindowsPrintConnector;

/**
 * Assuming your printer is available at LPT1,
 * simpy instantiate a WindowsPrintConnector to it.
 * 
 * When troubleshooting, make sure you can send it 
 * data from the command-line first:
 *     echo "Hello World" > LPT1
 */
try {
    $connector = new WindowsPrintConnector("LPT1");
    // A FilePrintConnector will also work, but on non-Windows systems, writes
    // to an actual file called 'LPT1' rather than giving a useful error.
    // $connector = new FilePrintConnector("LPT1");
    /* Print a "Hello world" receipt" */
    $printer = new Escpos($connector);
    $printer->text("Hello World!\n");
    $printer->cut();
    /* Close printer */
    $printer->close();
} catch(Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}
