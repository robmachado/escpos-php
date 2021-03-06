<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once '../../bootstrap.php';

/* Change to the correct path if you copy this example! */
use Escpos\Escpos;
use Escpos\Connectors\FilePrintConnector;

/**
 * On Linux, use the usblp module to make your printer available as a device
 * file. This is generally the default behaviour if you don't install any
 * vendor drivers.
 *
 * Once this is done, use a FilePrintConnector to open the device.
 *
 * Troubleshooting: On Debian, you must be in the lp group to access this file.
 * dmesg to see what happens when you plug in your printer to make sure no
 * other drivers are unloading the module.
 */
try {
    // Enter the device file for your USB printer here
    $connector = new FilePrintConnector("../temp/teste.prn");
    //$connector = new FilePrintConnector("/dev/usb/lp0");
    //$connector = new FilePrintConnector("/dev/usb/lp1");
    //$connector = new FilePrintConnector("/dev/usb/lp2");
    /* Print a "Hello world" receipt" */
    $printer = new Escpos($connector);
    $printer->text("Hello World!\n");
    $printer->cut();
    /* Close printer */
    $printer->close();
} catch(Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}
