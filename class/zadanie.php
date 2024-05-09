<?php
session_start();
include("./php/validateInput.php");

class Zadanie  // nwm jak to przetestowac ale cos napisalem
{
    private string $tytul;
    private string $opis;
    private string $dataRozpoczecia;
    private string $dataZakonczenia;
    private int $idZadania;

    public function __constructor(string $tytul, string $opis, string $dataRozpoczecia, string $dataZakonczenia)
    {
        $this->tytul = validateInput($tytul);
        $this->opis = validateInput($opis);
        $this->dataRozpoczecia = validateInput($dataRozpoczecia);
        $this->dataZakonczenia = validateInput($dataZakonczenia);
    }

    public function getTitle(): string
    {
        return $this->tytul;
    }

    public function getDescription(): string
    {
        return $this->opis;
    }

    public function getStartDate(): string
    {
        return $this->dataRozpoczecia;
    }

    public function getEndDate(): string
    {
        return $this->dataZakonczenia;
    }

    public function getId(): int
    {
        return $this->idZadania;
    }

    public function create (string $tytul, string $opis, string $dataRozpoczecia, string $dataZakonczenia): bool
    {
        require("./php/dbConnect.php");
        $sql = "INSERT INTO zadania (tytul, opis, data_rozpoczecia, data_zakonczenia) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $tytul, $opis, $dataRozpoczecia, $dataZakonczenia);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return true;
    }

    public function update (string $tytul, string $opis, string $dataRozpoczecia, string $dataZakonczenia): bool
    {
        require("./php/dbConnect.php");
        $sql = "UPDATE zadania SET tytul=?, opis=?, data_rozpoczecia=?, data_zakonczenia=? WHERE idZadania=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $tytul, $opis, $dataRozpoczecia, $dataZakonczenia, $this->idZadania);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return true;
    }

    public function delete (int $idZadania): bool
    {
        require("./php/dbConnect.php");
        $sql = "DELETE FROM zadania WHERE idZadania=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idZadania);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return true;
    }

    public function load (int $idZadania): bool
    {
        require("./php/dbConnect.php");
        $sql = "SELECT * FROM zadania WHERE idZadania=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idZadania);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->idZadania = $row["idZadania"];
            $this->tytul = $row["tytul"];
            $this->opis = $row["opis"];
            $this->dataRozpoczecia = $row["data_rozpoczecia"];
            $this->dataZakonczenia = $row["data_zakonczenia"];
            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();
        $conn->close();
        return false;
    }


}
