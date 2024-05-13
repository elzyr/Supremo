<?php
class PlanTygodnia
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function timeToHourIndex($dateTime, $baseTime = '08:00:00')
    {
        $timeOnly = date('H:i:s', strtotime($dateTime));
        $baseTimeOnly = date('H:i:s', strtotime($baseTime));

        $currentSeconds = strtotime("1970-01-01 $timeOnly UTC");
        $baseSeconds = strtotime("1970-01-01 $baseTimeOnly UTC");

        return (int)(($currentSeconds - $baseSeconds) / 60);
    }

    public function calculateWidth($startTimeIndex, $endTimeIndex)
    {
        $totalSlots = 720; // 12 godzin * 60 minut
        $duration = $endTimeIndex - $startTimeIndex;
        return ($duration / $totalSlots) * 100;
    }

    public function generateEmptySlots($startTimeIndex, $endTimeIndex)
    {
        if ($startTimeIndex >= $endTimeIndex) {
            return '';
        }
        $width = $this->calculateWidth($startTimeIndex, $endTimeIndex);
        return "<div class='empty-slot' style='flex: 0 0 {$width}%'></div>";
    }

    public function getTasksForDay($day, $userId)
    {
        $day = $this->conn->real_escape_string($day);
        $userId = $this->conn->real_escape_string($userId);

        $query = "SELECT DISTINCT z.* FROM zadania z
                  INNER JOIN zadaniauzytkownikow zu ON zu.idZadania = z.idZadania
                  WHERE DATE(z.dataRozpoczecia) = '$day'
                  AND zu.idUzytkownika = '$userId'
                  ORDER BY z.dataRozpoczecia ASC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function displayDayTasks(DateTime $date, $days, $user)
    {
        echo '<div class="container">';
        foreach ($days as $index => $dayName) {
            $dayDate = $date->format('Y-m-d');
            $dayTasks = $this->getTasksForDay($dayDate, $user->getId());
            echo '<div class="day-container">';
            echo "<h2 class='day-header'>$dayName - $dayDate</h2>";
            echo '<div class="task-container">';

            $lastEndTimeIndex = 0;
            $endOfDayIndex = $this->timeToHourIndex('20:00');

            foreach ($dayTasks as $task) {
                $startIndex = $this->timeToHourIndex($task['dataRozpoczecia']);
                $endIndex = $this->timeToHourIndex($task['dataZakonczenia']);

                if ($lastEndTimeIndex < $startIndex) {
                    echo $this->generateEmptySlots($lastEndTimeIndex, $startIndex);
                }

                $width = $this->calculateWidth($startIndex, $endIndex);
                echo "<div class='task' style='flex: 0 0 {$width}%' title='{$task['opis']}'>{$task['tytul']}</div>";

                $lastEndTimeIndex = $endIndex;
            }


            if ($lastEndTimeIndex < $endOfDayIndex) {
                echo $this->generateEmptySlots($lastEndTimeIndex, $endOfDayIndex);
            }

            echo '</div></div>';
            $date->add(new DateInterval('P1D'));
        }
        echo '</div>';
    }
}
