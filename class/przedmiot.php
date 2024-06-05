<?php

class Przedmiot
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Create a new przedmiot
    public function createPrzedmiot($nazwa)
    {
        $sql = 'INSERT INTO przedmiot (nazwa) VALUES (?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $nazwa);
        $stmt->execute();
        return $stmt->insert_id;
    }

    // Get przedmiot by ID
    public function getPrzedmiotById($idPrzedmiotu)
    {
        $sql = 'SELECT * FROM przedmiot WHERE idPrzedmiotu = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $idPrzedmiotu);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update przedmiot
    public function updatePrzedmiot($idPrzedmiotu, $nazwa)
    {
        $sql = 'UPDATE przedmiot SET nazwa = ? WHERE idPrzedmiotu = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $nazwa, $idPrzedmiotu);
        return $stmt->execute();
    }

    // Delete przedmiot
    public function deletePrzedmiot($idPrzedmiotu)
    {
        $sql = 'DELETE FROM przedmiot WHERE idPrzedmiotu = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $idPrzedmiotu);
        return $stmt->execute();
    }

    // Add an activity to przedmiot
    public function addActivity($idPrzedmiotu, $nazwa)
    {
        $sql = 'INSERT INTO aktywnosci (idPrzedmiotu, nazwa) VALUES (?, ?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('is', $idPrzedmiotu, $nazwa);
        $stmt->execute();
        return $stmt->insert_id;
    }

    // Get activities for przedmiot
    public function getActivities($idPrzedmiotu)
    {
        $sql = 'SELECT * FROM aktywnosci WHERE idPrzedmiotu = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $idPrzedmiotu);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Add a grade for a user in an activity
    public function addGrade($idUzytkownika, $idPrzedmiotu, $idAktywnosci, $ocena)
    {
        $sql = 'INSERT INTO oceny (idUzytkownika, idPrzedmiotu, idAktywnosci, ocena) VALUES (?, ?, ?, ?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iiii', $idUzytkownika, $idPrzedmiotu, $idAktywnosci, $ocena);
        $stmt->execute();
        return $stmt->insert_id;
    }

    // Get grades for a user in a specific subject
    public function getGrades($idUzytkownika, $idPrzedmiotu)
    {
        $sql = 'SELECT * FROM oceny WHERE idUzytkownika = ? AND idPrzedmiotu = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $idUzytkownika, $idPrzedmiotu);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Show subjects that a user is enrolled in
    public function getSubjectsByUser($idUzytkownika)
    {
        $sql = 'SELECT * FROM przedmiot WHERE idUzytkownika = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $idUzytkownika);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Get grades from an activity
    public function getGradesFromActivity($idUzytkownika, $idPrzedmiotu)
    {
        $sql = 'SELECT a.nazwa AS nazwa, o.ocena
                FROM oceny o
                JOIN aktywnosci a ON o.idAktywnosci = a.idAktywnosci
                WHERE o.idUzytkownika = ? AND o.idPrzedmiotu = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $idUzytkownika, $idPrzedmiotu);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTitle($idPrzedmiotu)
    {
        $sql = 'SELECT nazwa FROM przedmiot WHERE idPrzedmiotu = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $idPrzedmiotu);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['nazwa'];
    }
}
?>