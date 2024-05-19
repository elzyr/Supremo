<?php
session_start();

class Przedmiot
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Create a new przedmiot
    public function createPrzedmiot($nazwa)
    {
        $sql = 'INSERT INTO przedmiot (nazwa) VALUES (:nazwa)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nazwa' => $nazwa]);
        return $this->pdo->lastInsertId();
    }

    // Get przedmiot by ID
    public function getPrzedmiotById($idPrzedmiotu)
    {
        $sql = 'SELECT * FROM przedmiot WHERE idPrzedmiotu = :idPrzedmiotu';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idPrzedmiotu' => $idPrzedmiotu]);
        return $stmt->fetch();
    }

    // Update przedmiot
    public function updatePrzedmiot($idPrzedmiotu, $nazwa)
    {
        $sql = 'UPDATE przedmiot SET nazwa = :nazwa WHERE idPrzedmiotu = :idPrzedmiotu';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['idPrzedmiotu' => $idPrzedmiotu, 'nazwa' => $nazwa]);
    }

    // Delete przedmiot
    public function deletePrzedmiot($idPrzedmiotu)
    {
        $sql = 'DELETE FROM przedmiot WHERE idPrzedmiotu = :idPrzedmiotu';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['idPrzedmiotu' => $idPrzedmiotu]);
    }

    // Add an activity to przedmiot
    public function addActivity($idPrzedmiotu, $nazwa)
    {
        $sql = 'INSERT INTO aktywnosci (idPrzedmiotu, nazwa) VALUES (:idPrzedmiotu, :nazwa)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idPrzedmiotu' => $idPrzedmiotu, 'nazwa' => $nazwa]);
        return $this->pdo->lastInsertId();
    }

    // Get activities for przedmiot
    public function getActivities($idPrzedmiotu)
    {
        $sql = 'SELECT * FROM aktywnosci WHERE idPrzedmiotu = :idPrzedmiotu';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idPrzedmiotu' => $idPrzedmiotu]);
        return $stmt->fetchAll();
    }

    // Add a grade for a user in an activity
    public function addGrade($idUzytkownika, $idPrzedmiotu, $idAktywnosci, $ocena)
    {
        $sql = 'INSERT INTO oceny (idUzytkownika, idPrzedmiotu, idAktywnosci, ocena) VALUES (:idUzytkownika, :idPrzedmiotu, :idAktywnosci, :ocena)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idUzytkownika' => $idUzytkownika, 'idPrzedmiotu' => $idPrzedmiotu, 'idAktywnosci' => $idAktywnosci, 'ocena' => $ocena]);
        return $this->pdo->lastInsertId();
    }

    // Get grades for a user in a specific subject
    public function getGrades($idUzytkownika, $idPrzedmiotu)
    {
        $sql = 'SELECT * FROM oceny WHERE idUzytkownika = :idUzytkownika AND idPrzedmiotu = :idPrzedmiotu';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idUzytkownika' => $idUzytkownika, 'idPrzedmiotu' => $idPrzedmiotu]);
        return $stmt->fetchAll();
    }
}
