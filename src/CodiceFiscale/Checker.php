<?php

namespace CodiceFiscale;


class Checker
{
    public function isFormallyCorrect($codiceFiscale)
    {
        // This is done because preg_match returns an integer
        if (preg_match('/[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]/', $codiceFiscale)) {
            return true;
        } else {
            return false;
        }
    }
}