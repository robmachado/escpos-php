<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once '../bootstrap.php';


/**
 * This demonstrates available character encodings. Escpos-php accepts UTF-8,
 * and converts this to lower-level data to the printer. This is a complex area, so be
 * prepared to code a model-specific hack ('CapabilityProfile') for your printer.
 * 
 * If you run into trouble, please file an issue on GitHub, including at a minimum:
 * - A UTF-8 test string in the language you're working in, and
 * - A test print or link to a technical document which lists the available
 *      code pages ('character code tables') for your printer.
 * 
 * The DefaultCapabilityProfile works for Espson-branded printers. For other models, you
 * must use/create a PrinterCapabilityProfile for your printer containing a list of code
 * page numbers for your printer- otherwise you will get mojibake.
 * 
 * If you do not intend to use non-English characters, then use SimpleCapabilityProfile,
 * which has only the default encoding, effectively disabling code page changes.
 */

include(dirname(__FILE__) . '/resources/character-encoding-test-strings.inc');

use Escpos\Escpos;
use Escpos\Connectors\FilePrintConnector;
use Escpos\Printers\DefaultCapabilityProfile;

try {
    // Enter connector and capability profile (to match your printer)
    $connector = new FilePrintConnector("php://stdout");
    $profile = DefaultCapabilityProfile::getInstance();
    /* Print a series of receipts containing i18n example strings */
    $printer = new Escpos($connector, $profile);
    $printer -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT | Escpos::MODE_EMPHASIZED | Escpos::MODE_DOUBLE_WIDTH);
    $printer -> text("Implemented languages\n");
    $printer -> selectPrintMode();
    foreach($inputsOk as $label => $str) {
        $printer -> setEmphasis(true);
        $printer -> text($label . ":\n");
        $printer -> setEmphasis(false);
        $printer -> text($str);
    }
    $printer -> feed();
    $printer -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT | Escpos::MODE_EMPHASIZED | Escpos::MODE_DOUBLE_WIDTH);
    $printer -> text("Works in progress\n");
    $printer -> selectPrintMode();
    foreach($inputsNotOk as $label => $str) {
        $printer -> setEmphasis(true);
        $printer -> text($label . ":\n");
        $printer -> setEmphasis(false);
        $printer -> text($str);
    }
    $printer -> cut();
    /* Close printer */
    $printer -> close();
} catch(Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
