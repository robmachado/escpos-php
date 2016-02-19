<?php

namespace Escpos\Printers;

/**
 * This capability profile is designed for non-Epson printers sold online. Without knowing
 * their character encoding table, only CP437 output is assumed, and graphics() calls will
 * be disabled, as it usually prints junk on these models.
 */
use  Escpos\Printers\DefaultCapabilityProfile;
        
class SimpleCapabilityProfile extends DefaultCapabilityProfile
{
    /**
     * 
     * @return type
     */
    public function getSupportedCodePages() {
        /* Use only CP437 output */
        return array(0 => CodePage::CP437);
    }
    
    /**
     * 
     * @return boolean
     */
    public function getSupportsGraphics() {
        /* Ask the driver to use bitImage wherever possible instead of graphics */
        return false;
    }
}
