<?php
session_start();
include("./php/validateInput.php");

class Zadanie  // nwm jak to przetestowac ale cos napisalem
{
    private string $title;
    private string $description;
    private string $startDate;
    private string $endDate;
    private int $id;

    public function __constructor(string $title, string $description, string $startDate, string $endDate)
    {
        $this->title = validateInput($title);
        $this->description = validateInput($description);
        $this->startDate = validateInput($startDate);
        $this->endDate = validateInput($endDate);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function create (string $title, string $description, string $startDate, string $endDate): bool
    {
        require("./php/dbConnect.php");
        $sql = "INSERT INTO zadania (tytul, opis, data_rozpoczecia, data_zakonczenia) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $description, $startDate, $endDate);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return true;
    }

    public function update (string $title, string $description, string $startDate, string $endDate): bool
    {
        require("./php/dbConnect.php");
        $sql = "UPDATE zadania SET tytul=?, opis=?, data_rozpoczecia=?, data_zakonczenia=? WHERE idZadania=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $description, $startDate, $endDate, $this->id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return true;
    }

    public function delete (int $id): bool
    {
        require("./php/dbConnect.php");
        $sql = "DELETE FROM zadania WHERE idZadania=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return true;
    }

    public function load (int $id): bool
    {
        require("./php/dbConnect.php");
        $sql = "SELECT * FROM zadania WHERE idZadania=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->id = $row["idZadania"];
            $this->title = $row["tytul"];
            $this->description = $row["opis"];
            $this->startDate = $row["data_rozpoczecia"];
            $this->endDate = $row["data_zakonczenia"];
            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();
        $conn->close();
        return false;
    }


}
