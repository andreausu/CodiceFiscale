<?php

namespace CodiceFiscale;


class Calculator
{
    private $mesi = ['A', 'B', 'C', 'D', 'E', 'H', 'L', 'M', 'P', 'R', 'S', 'T'];
    private $vocali = ['A', 'E', 'I', 'O', 'U'];
    private $consonanti = ['B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'];
    private $numeri = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    private $alfabeto = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    private $matriceCodiceControllo = ["01" => 1, "00" => 0, "11" => 0, "10" => 1, "21" => 5, "20" => 2, "31" => 7, "30" => 3, "41" => 9, "40" => 4, "51" => 13, "50" => 5, "61" => 15, "60" => 6, "71" => 17, "70" => 7, "81" => 19, "80" => 8, "91" => 21, "90" => 9, "101" => 1, "100" => 0, "111" => 0, "110" => 1, "121" => 5, "120" => 2, "131" => 7, "130" => 3, "141" => 9, "140" => 4, "151" => 13, "150" => 5, "161" => 15, "160" => 6, "171" => 17, "170" => 7, "181" => 19, "180" => 8, "191" => 21, "190" => 9, "201" => 2, "200" => 10, "211" => 4, "210" => 11, "221" => 18, "220" => 12, "231" => 20, "230" => 13, "241" => 11, "240" => 14, "251" => 3, "250" => 15, "261" => 6, "260" => 16, "271" => 8, "270" => 17, "281" => 12, "280" => 18, "291" => 14, "290" => 19, "301" => 16, "300" => 20, "311" => 10, "310" => 21, "321" => 22, "320" => 22, "331" => 25, "330" => 23, "341" => 24, "340" => 24, "351" => 23, "350" => 25];


    public function calcola($nome, $cognome, $sesso, \DateTime $dataNascita, $codiceComune)
    {
        $codiceFiscale = '';
        $nome = $this->sanitizeString($nome);
        $cognome = $this->sanitizeString($cognome);
        $sesso = $this->sanitizeString($sesso);

        $giorno = $dataNascita->format('d');
        $mese = $dataNascita->format('n');
        $anno = $dataNascita->format('y');


        // inizia con il calcolo dei primi sei caratteri corrispondenti al nome e cognome
        $codiceFiscale = $this->calcolaCognome($cognome) . $this->calcolaNome($nome);

        // calcola i dati corrispondenti alla data di nascita
        if ($sesso == 'F') {
            $giorno += 40;
        }
        $codiceFiscale .= $anno . $this->mesi[$mese - 1] . $giorno;

        // aggiunge il codice del comune
        $codiceFiscale .= $codiceComune;

        // e finalmente calcola il codice controllo
        $codiceControllo = 0;
        $alfanumerico = array_merge($this->numeri, $this->alfabeto);
        for ($i = 0; $i < 15; $i++) {
            $codiceControllo += $this->matriceCodiceControllo[strval(array_search($codiceFiscale[$i], $alfanumerico)) . strval((($i + 1) % 2))];
        }
        $codiceFiscale .= $this->alfabeto[$codiceControllo % 26];

        return $codiceFiscale;
    }

    /**
     * @param string $string
     */
    private function calcolaNome($string)
    {
        $i = 0;
        $res = '';
        $cons = '';
        while (strlen($cons) < 4 && ($i + 1 <= strlen($string))) {
            if (array_search($string[$i], $this->consonanti) !== false) {
                $cons .= $string[$i];
            }
            $i++;
        }

        if (strlen($cons) > 3) {
            $res = $cons[0] . $cons[2] . $cons[3];
            return $res;
        } else {
            $res = $cons;
        }

        // Se non bastano prendo le vocali
        $i = 0;
        while (strlen($res) < 3 && ($i + 1 <= strlen($string))) {
            if (array_search($string[$i], $this->vocali) !== false) {
                $res .= $string[$i];
            }
            $i++;
        }
        $res .= "XXX";
        return substr($res, 0, 3);
    }

    /**
     * @param string $string
     */
    private function calcolaCognome($string)
    {
        $res = '';
        $i = 0;
        while(strlen($res) < 3 && ($i + 1 <= strlen($string))) {
            if (array_search($string[$i], $this->consonanti) !== false) {
                $res .= $string[$i];
            }
            $i++;
        }

        // Se non bastano le consonanti, prendo le vocali
        $i = 0;
        while(strlen($res) < 3 && ($i + 1 <= strlen($string))) {
            if (array_search($string[$i], $this->vocali) !== false) {
                $res .= $string[$i];
            }
            $i++;
        }

        $res .= "XXX";
        return substr($res, 0, 3);
    }

    private function sanitizeString($string)
    {
        $string = trim($string);
        $string = strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT', $string));
        $string = str_replace(' ', '', $string);
        return $string;
    }
}