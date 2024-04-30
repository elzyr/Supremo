<?php
session_start();
include("./php/validateInput.php");
class Uzytkownik
{

    private string $email;
    private string $hashedPassword;

    private int $id;
    private string $imie;

    public function __construct(string $email, string $password)
    {
        $this->email = validateInput($email);
        $this->hashedPassword = md5(validateInput($password));
    }

    public function getEmail(): string
    {
        return $this->email;
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

    public function saveToSession(): void
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

    public function login(): bool
    {
        require("./php/dbConnect.php");
        $sql = "SELECT * FROM uzytkownicy WHERE email=? AND haslo=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $this->email, $this->hashedPassword);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $this->id = $result->fetch_assoc()["idUzytkownika"];
        }
        $stmt->close();
        $conn->close();
        return ($result->num_rows == 1);
    }

    public function logout(): void
    {
        unset($_SESSION['uzytkownik']);
    }
}
