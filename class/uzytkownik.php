<?php
session_start();
include("./php/validateInput.php");
class Uzytkownik
{

    private string $email;
    private string $hashedPassword;

    private int $id;
    private string $name;

    public function __construct(string $email, string $password)
    {
        $this->email = validateInput($email);
        $this->hashedPassword = md5(validateInput($password));
    }

    public function login(): bool
    {
        require("./php/dbConnect.php");
        $sql = "SELECT * FROM uzytkownicy WHERE email=? AND haslo=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $this->email, $this->hashedPassword);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->id = $row["idUzytkownika"];
            $this->name = $row["imie"];
            $this->saveToSession();
        }
        $stmt->close();
        $conn->close();
        return ($result->num_rows == 1);
    }

    public function logout(): void
    {
        unset($_SESSION['uzytkownik']);
    }

    private function checkAvailability(): bool
    {
        require("./php/dbConnect.php");
        $sql = "SELECT * FROM uzytkownicy WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",  $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return ($result->num_rows == 0);
    }
    public function create(string $imie, string $nazwisko, string $nrTelefonu): bool
    {
        if (!$this->checkAvailability()) {
            return false;
        }
        require("./php/dbConnect.php");
        $sql = "INSERT INTO uzytkownicy (imie, nazwisko,email,nrTelefonu, haslo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", validateInput($imie), validateInput($nazwisko), $this->email, validateInput($nrTelefonu), $this->hashedPassword);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return true;
    }

    private function saveToSession(): void
    {
        $_SESSION['uzytkownik'] = serialize($this);
    }

    public static function loadFromSession(): ?Uzytkownik
    {
        if (isset($_SESSION['uzytkownik'])) {
            return unserialize($_SESSION['uzytkownik']);
        }
        return null;
    }

    public function changePassword(string $newPassword): void
    {
        $newHashedPassword = md5($newPassword);
        require("./php/dbConnect.php");
        $sql = "UPDATE uzytkownicy SET haslo=? WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $newHashedPassword, $this->email);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
