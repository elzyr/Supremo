<?php
session_start();

class Przedmiot
{
    private string $nazwa;
    private string $opis;
    private int $idPrzedmiotu;

    public function __constructor(string $nazwa, string $opis)
    {
        $this->nazwa = validateInput($nazwa);
        $this->opis = validateInput($opis);
    }

    
}
