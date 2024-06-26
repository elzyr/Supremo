<?php

class Task
{
    private string $title;
    private string $description;
    private string $startDate;
    private string $endDate;
    private int $taskId;

    public function __construct(string $title, string $description, string $startDate, string $endDate, int $taskId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->taskId = $taskId;
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
        return $this->taskId;
    }


    static function load(int $taskId): ?Task
    {
        require("./php/dbConnect.php");
        $sql = "SELECT * FROM zadania WHERE idZadania=$taskId";
        $result = $conn->query($sql);
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $conn->close();
            return new Task($row["tytul"], $row["opis"], $row["dataRozpoczecia"], $row["dataZakonczenia"], $taskId);
        }
        $conn->close();
        return null;
    }

    static function create(string $title, string $description, string $startDate, string $endDate): ?Task
    {
        require("./php/dbConnect.php");
        $sql = "INSERT INTO zadania (dataRozpoczecia, dataZakonczenia, tytul, opis) VALUES ('$startDate', '$endDate', '$title', '$description')";
        if ($conn->query($sql) === TRUE) {
            $taskId = $conn->insert_id;
            $conn->close();
            return new Task($title, $description, $startDate, $endDate, $taskId);
        } else {
            $conn->close();
            return null;
        }
    }


    public function update(string $title, string $description, string $startDate, string $endDate): bool
    {
        require("./php/dbConnect.php");

        $updateQuery = "UPDATE zadania SET 
                    tytul = '$title', 
                    opis = '$description', 
                    dataRozpoczecia = '$startDate', 
                    dataZakonczenia = '$endDate'
                    WHERE idZadania = $this->taskId";

        if ($conn->query($updateQuery)) {
            $conn->close();
            return true;
        }

        $conn->close();
        return false;
    }

    public function delete(int $userId): bool
    {
        require("./php/dbConnect.php");
        $sql = "DELETE FROM zadaniaUzytkownikow WHERE idZadania=$this->taskId AND idUzytkownika=$userId";
        if (!$conn->query($sql)) {
            $conn->close();
            return false;
        }
        $sql = "SELECT COUNT(*) as count FROM zadaniaUzytkownikow WHERE idZadania=$this->taskId";
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
        } else {
            $conn->close();
            return false;
        }
        if ($count == 0) {
            $sql = "DELETE FROM zadania WHERE idZadania=$this->taskId";
            if (!$conn->query($sql)) {
                $conn->close();
                return false;
            }
        }
        $conn->close();
        return true;
    }

    public function checkUserPermission(int $userId): bool
    {
        require("./php/dbConnect.php");
        $sql = "SELECT * FROM zadaniaUzytkownikow WHERE idZadania=$this->taskId AND idUzytkownika=$userId";
        $result = $conn->query($sql);
        if ($result && $result->num_rows == 1) {
            $conn->close();
            return true;
        }
        $conn->close();
        return false;
    }

    static function checkUserAvailability(string $startDate, string $endDate, int $userId): bool
    {
        require("./php/dbConnect.php");
        $query = "SELECT * FROM zadania z
                  INNER JOIN zadaniauzytkownikow zu ON zu.idZadania = z.idZadania
                  WHERE zu.idUzytkownika = '$userId'
                  AND (
                      ('$startDate' BETWEEN z.dataRozpoczecia AND z.dataZakonczenia)
                      OR ('$endDate' BETWEEN z.dataRozpoczecia AND z.dataZakonczenia)
                      OR (z.dataRozpoczecia BETWEEN '$startDate' AND '$endDate')
                      OR (z.dataZakonczenia BETWEEN '$startDate' AND '$endDate')
                  )";
        $result = $conn->query($query);
        $conn->close();
        return ($result->num_rows == 0);
    }

    public function addUser(int $userId): bool
    {
        if (!(Task::checkUserAvailability($this->startDate, $this->endDate, $userId))) {
            return false;
        }
        require("./php/dbConnect.php");
        $query = "INSERT INTO zadaniauzytkownikow (idUzytkownika, idZadania) VALUES ('" . $userId . "', '" . $this->taskId . "')";
        $conn->query($query);
        $conn->close();
        return true;
    }

    public function isImportant($userId)
    {
        require("./php/dbConnect.php");
        $sql = "SELECT * FROM zadaniaUzytkownikow WHERE idZadania=$this->taskId and idUzytkownika=$userId";
        $result = $conn->query($sql);
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $conn->close();
            return $row["czyWazne"];
        }
        $conn->close();
        return null;
    }
    public function setImportantValue($value, $userId): bool
    {
        require("./php/dbConnect.php");

        $updateQuery = "UPDATE zadaniaUzytkownikow SET 
                    czyWazne = $value
                    WHERE idZadania = $this->taskId AND idUzytkownika = $userId";

        if ($conn->query($updateQuery)) {
            $conn->close();
            return true;
        }

        $conn->close();
        return false;
    }
}
function validateDates($startDate, $endDate)
{
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $startHour = $start->format('H:i');
    $endHour = $end->format('H:i');
    $minHour = new DateTime('08:00');
    $maxHour = new DateTime('20:00');
    if ($start > $end) {
        return "Data rozpoczęcia nie może być późniejsza niż data zakończenia.";
    } else if ($start->format('Y-m-d') !== $end->format('Y-m-d')) {
        return "Data rozpoczęcia i zakończenia musi być tego samego dnia.";
    } else if (new DateTime($startHour) < $minHour || new DateTime($startHour) > $maxHour || new DateTime($endHour) < $minHour || new DateTime($endHour) > $maxHour) {
        return "Czas zadania musi być w przedziale 8:00 - 20:00";
    }
    return true;
}
