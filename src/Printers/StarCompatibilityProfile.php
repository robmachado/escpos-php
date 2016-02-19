<?php

namespace Escpos\Printers;

use Escpos\Printers\DefaultCapabilityProfile;

class StarCapabilityProfile extends DefaultCapabilityProfile
{
    
    
    public function getSupportedCodePages() {
        // TODO include Spec B here.
        
        
    }
    
    // TODO, some function to tell Escpos.php to use ESC GS t n instead of ESC t n
}