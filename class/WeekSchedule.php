<?php
class WeekSchedule
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }


    public function renderDay($dayName, $dayDate, $tasks, $startOfDay, $endOfDay)
    {
        echo "<div class='day-container'>";
        echo "<h2 class='day-header'>$dayName - $dayDate</h2>";
        echo "<div class='day-time'><span class='start-of-day'>{$startOfDay}</span><span class='end-of-day'>{$endOfDay}</span></div>";
        echo '<div class="task-container">';

        $lastEndTimeIndex = 0;
        $endOfDayIndex = $this->timeToHourIndex($endOfDay);

        foreach ($tasks as $task) {
            $startIndex = $this->timeToHourIndex($task['dataRozpoczecia']);
            $endIndex = $this->timeToHourIndex($task['dataZakonczenia']);

            if ($lastEndTimeIndex < $startIndex) {
                echo $this->generateEmptySlots($lastEndTimeIndex, $startIndex, $dayDate);
            }

            $width = $this->calculateWidth($startIndex, $endIndex);
            $startTime = date('H:i', strtotime($task['dataRozpoczecia']));
            $endTime = date('H:i', strtotime($task['dataZakonczenia']));
            echo $this->renderTask($task, $startTime, $endTime, $width);

            $lastEndTimeIndex = $endIndex;
        }

        if ($lastEndTimeIndex < $endOfDayIndex) {
            echo $this->generateEmptySlots($lastEndTimeIndex, $endOfDayIndex, $dayDate);
        }

        echo '</div></div>';
    }

    public function displayDayTasks(DateTime $date, $days, $user)
    {
        echo '<div class="container">';
        foreach ($days as $index => $dayName) {
            $dayDate = $date->format('Y-m-d');
            $dayTasks = $this->getTasksForDay($dayDate, $user->getId());
            $startOfDay = '08:00';
            $endOfDay = '20:00';

            $this->renderDay($dayName, $dayDate, $dayTasks, $startOfDay, $endOfDay);

            $date->add(new DateInterval('P1D'));
        }
        echo '</div>';
    }

    private function timeToHourIndex($dateTime, $baseTime = '08:00:00')
    {
        $timeOnly = date('H:i', strtotime($dateTime));
        $baseTimeOnly = date('H:i', strtotime($baseTime));

        $currentSeconds = strtotime("1970-01-01 $timeOnly UTC");
        $baseSeconds = strtotime("1970-01-01 $baseTimeOnly UTC");

        return (int)(($currentSeconds - $baseSeconds) / 60);
    }

    private function calculateWidth($startTimeIndex, $endTimeIndex)
    {
        $totalSlots = 720; // 12 godzin * 60 minut
        $duration = $endTimeIndex - $startTimeIndex;
        return ($duration / $totalSlots) * 100;
    }

    private function generateEmptySlots($startTimeIndex, $endTimeIndex, $date)
    {
        if ($startTimeIndex >= $endTimeIndex) {
            return '';
        }
        $width = $this->calculateWidth($startTimeIndex, $endTimeIndex);
        return "<div class='empty-slot' data-date='$date' style='flex: 0 0 {$width}%' title='dodaj zadanie' onclick='window.location.href=\"dodaj-zadanie.php?taskDate=" . $date . "\"'></div>";
    }


    private function getTasksForDay($day, $userId)
    {
        $day = $this->conn->real_escape_string($day);
        $userId = $this->conn->real_escape_string($userId);

        $query = "SELECT DISTINCT * FROM zadania z
                  INNER JOIN zadaniauzytkownikow zu ON zu.idZadania = z.idZadania
                  WHERE DATE(z.dataRozpoczecia) = '$day'
                  AND zu.idUzytkownika = '$userId'
                  ORDER BY z.dataRozpoczecia ASC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    private function renderTask($task, $startTime, $endTime, $width)
    {
        $importantClass = $task['czyWazne'] == 1 ? 'important' : '';
        return "<a href='zadanie.php?id={$task['idZadania']}' class='task {$importantClass}' style='flex: 0 0 {$width}%'>
        <div class='task-time start-time'>{$startTime}</div>
        <div class='task-title'>{$task['tytul']}</div>
        <div class='task-time end-time'>{$endTime}</div>
      </a>";
    }
}
