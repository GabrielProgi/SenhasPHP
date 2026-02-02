<?php

class PasswordGenerator {
    private int $length;
    private bool $useLetters;
    private bool $useNumbers;
    private bool $useSymbols;
    
    
    public function __construct($length, $useLetters, $useNumbers, $useSymbols) {
        
        $this->length = max(4, min(128, (int)$length));
        $this->useLetters = (bool)$useLetters;
        $this->useNumbers = (bool)$useNumbers;
        $this->useSymbols = (bool)$useSymbols;
    }
    
    public function generate(): string {
        $sets = [];
        
        
        if ($this->useLetters) {
            $sets[] = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($this->useNumbers) {
            $sets[] = '0123456789';
        }
        if ($this->useSymbols) {
            $sets[] = '!@#$%^&*()_+-=[]{}|;:,.<>?';
        }
        
        
        if (empty($sets)) {
            $sets[] = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        
        
        $allChars = implode('', $sets);
        $maxIndex = strlen($allChars) - 1;
        $password = '';
        
        
        try {
            for ($i = 0; $i < $this->length; $i++) {
                $password .= $allChars[random_int(0, $maxIndex)];
            }
        } catch (Exception $e) {
            for ($i = 0; $i < $this->length; $i++) {
                $password .= $allChars[mt_rand(0, $maxIndex)];
            }
        }
        
        return $password;
    }
}
?>