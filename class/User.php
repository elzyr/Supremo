<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("./php/validateInput.php");

if (!class_exists('User')) {
    class User
    {
        private string $email;
        private string $hashedPassword;
        private int $id;
        private string $name;
        private string $phoneNumber; 

        public function __construct(string $email, string $password)
        {
            $this->email = validateInput($email);
            $this->hashedPassword = md5(validateInput($password));
        }

        public function login(): bool
        {
            require("./php/dbConnect.php");
            $sql = "SELECT * FROM uzytkownicy WHERE email='$this->email' AND haslo='$this->hashedPassword'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->id = $row["idUzytkownika"];
                $this->name = $row["imie"];
                $this->phoneNumber = $row["nrTelefonu"];
                $this->saveToSession();
                $conn->close();
                return true;
            }
            $conn->close();
            return false;
        }

        public function logout(): void
        {
            unset($_SESSION['user']);
        }

        private function checkAvailability(): bool
        {
            require("./php/dbConnect.php");
            $sql = "SELECT * FROM uzytkownicy WHERE email='$this->email'";
            $result = $conn->query($sql);
            if ($result) {
                $isAvailable = ($result->num_rows == 0);
                $result->close();
                $conn->close();
                return $isAvailable;
            } else {
                $conn->close();
                return false;
            }
        }

        public function create(string $firstName, string $lastName, string $phoneNumber): bool
        {
            if (!$this->checkAvailability()) {
                return false;
            }
            require("./php/dbConnect.php");
            $firstName = validateInput($firstName);
            $lastName = validateInput($lastName);
            $phoneNumber = validateInput($phoneNumber);
            $sql = "INSERT INTO uzytkownicy (imie, nazwisko, email, nrTelefonu, haslo) VALUES ('$firstName', '$lastName', '$this->email', '$phoneNumber', '$this->hashedPassword')";
            if ($conn->query($sql) === TRUE) {
                $conn->close();
                return true;
            } else {
                $conn->close();
                return false;
            }
        }

        private function saveToSession(): void
        {
            $_SESSION['user'] = serialize($this);
        }

        public static function loadFromSession(): ?User
        {
            if (isset($_SESSION['user'])) {
                $user = unserialize($_SESSION['user']);
                if ($user instanceof User) {
                    return $user;
                }
            }
            return null;
        }

        public function changePassword(string $newPassword): void
        {
            $newHashedPassword = md5($newPassword);
            require("./php/dbConnect.php");
            $email = $this->email;
            $sql = "UPDATE uzytkownicy SET haslo='$newHashedPassword' WHERE email='$email'";
            $conn->query($sql);
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

        public function getId(): int
        {
            return $this->id;
        }

        public function getPhoneNumber(): string
        {
            return $this->phoneNumber;
        }
    }
}

if (!function_exists('displayErrorMessage')) {
    function displayErrorMessage($message)
    {
        setcookie("error_message", "$message", time() + 5, "/");
        echo '<script type="text/javascript">
           window.history.back();
          </script>';
    }
}
?>
