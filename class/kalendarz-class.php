<?php
class Calendar {  
    private $conn;
    private $dayLabels = array("Poniedziałek","Wtorek","Środa","Czwartek","Piątek","Sobota","Niedziela");
    private $currentYear=0;
    private $currentMonth=0;
    private $currentDay=0;
    private $currentDate=null;
    private $daysInMonth=0;
    private $naviHref= null;

    public function __construct(mysqli $conn){     
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
        $this->conn = $conn;
      
        if(isset($_GET['year'])){
            $this->currentYear = $_GET['year'];
        }else{
            $this->currentYear = date("Y",time());  
        }          
        if(isset($_GET['month'])){
            $this->currentMonth = $_GET['month'];
        }else{
            $this->currentMonth = date("m",time());
        }                  
         
        $this->daysInMonth=$this->getNumberDayInMonth($this->currentMonth,$this->currentYear);  
    }

    public function showDayInCalendar($user) {
        $content='<ul class="dates">';    
            $weeksInMonth = $this->getNumberWeeksInMonth($this->currentMonth,$this->currentYear);
            for( $i=0; $i<$weeksInMonth; $i++ ){
                for($j=1;$j<=7;$j++){
                    $content.=$this->getDay($i*7+$j, $user->getId());
                }
            }
        $content.='</ul>'; 
        $content.='<div class="clear"></div>';     

        return $content;   
    }

    private function getTaskInDay($day, $userId){
        $day = $this->conn->real_escape_string($day);
        $userId = $this->conn->real_escape_string($userId);

        $query = "SELECT DISTINCT z.*,zu.czyWazne FROM zadania z
                  INNER JOIN zadaniauzytkownikow zu ON zu.idZadania = z.idZadania
                  WHERE DATE(z.dataRozpoczecia) = '$day'
                  AND zu.idUzytkownika = '$userId'
                  ORDER BY z.dataRozpoczecia ASC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    private function isToday(int $month,int $day,int $year){
        if($year == date("Y",time()) && $month == date("n",time()) && $day == date("j",time())){
            return 1;
        }
        return 0;
    }

    private function getDay($cellNumber, $userId) {
        $firstDayOfTheWeek = date('N', strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
        $lastDayOfTheMonth = date('t', strtotime('last day of '.$this->currentYear.'-'.$this->currentMonth));
    
        if ($cellNumber % 7 == 0) {
            $currentDayInWeek = 7;
        } else {
            $currentDayInWeek = $cellNumber % 7;
        }
    
        $currentDayInMonth = $cellNumber - $firstDayOfTheWeek + 1;
        $classes = '';
        if ($currentDayInMonth < 1) {
            if ($this->currentMonth == 1) {
                $currentMonth = 12;
                $currentYear = $this->currentYear - 1;
            } else {
                $currentMonth = $this->currentMonth - 1;
                $currentYear = $this->currentYear;
            }
            $lastDayOfTheMonth = date('t', strtotime('last day of '.$currentYear.'-'.$currentMonth));
            $currentDayInMonth = $lastDayOfTheMonth - $firstDayOfTheWeek + $currentDayInWeek + 1;
            $this->currentDate = date('Y-m-d', strtotime($currentYear.'-'.$currentMonth.'-'.$currentDayInMonth));
            $classes .= 'cell otherMonth ';
        } elseif ($currentDayInMonth > $lastDayOfTheMonth) {
            if ($this->currentMonth == 12) {
                $currentMonth = 1;
                $currentYear = $this->currentYear + 1;
            } else {
                $currentMonth = $this->currentMonth + 1;
                $currentYear = $this->currentYear;
            }
            $currentDayInMonth -= $lastDayOfTheMonth;
            $this->currentDate = date('Y-m-d', strtotime($currentYear.'-'.$currentMonth.'-'.$currentDayInMonth));
            $classes .= 'cell otherMonth ';
        } else {
            $currentMonth = $this->currentMonth;
            $currentYear = $this->currentYear;
            $this->currentDate = date('Y-m-d', strtotime($currentYear.'-'.$currentMonth.'-'.$currentDayInMonth));
            if($this->isToday($currentMonth,$currentDayInMonth,$currentYear)){
                $classes .= 'cell Today ';
            }else{
                $classes .= 'cell inMonth ';
            }
        }

        $tasks = $this->getTaskInDay($this->currentDate, $userId);
        $TaskInDay = '';
        $count = 0;
        foreach ($tasks as $task) {
            if ($count < 3) {
                if ($task['czyWazne'] == 0) {
                    $TaskInDay .= '<a class="taskInDay" titleTask="'.$task['tytul'].'" descriptionTask="'.$task['opis'].'" href="zadanie.php?id='.$task['idZadania'].'"></a>';
                } else {
                    $TaskInDay .= '<a class="taskInDay important" titleTask="'.$task['tytul'].'" descriptionTask="'.$task['opis'].'" href="zadanie.php?id='.$task['idZadania'].'"></a>';
                }
            } else {
                break;
            }
            $count++;
        }
    
        $cellContent = $currentDayInMonth . $TaskInDay;
        $content = '<div class="' . $classes . '" onclick="window.location.href=\'plan-tygodnia.php?date=' . $this->currentDate . '\'">' . $cellContent . '</div>';
    
        return $content;
    }
    
   
    public function createHeader(){
        if ($this->currentMonth == 12) {
            $nextMonth = 1;
            $nextYear = intval($this->currentYear) + 1;
        } else {
            $nextMonth = intval($this->currentMonth) + 1;
            $nextYear = $this->currentYear;
        }
        
        if ($this->currentMonth == 1) {
            $preMonth = 12;
            $preYear = intval($this->currentYear) - 1;
        } else {
            $preMonth = intval($this->currentMonth) - 1;
            $preYear = $this->currentYear;
        }
        
        return
            '<div class="header">'.
                '<a class="prev" href="kalendarz.php?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                '<span class="YearMonth">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="kalendarz.php?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }

    public function createDaysOfWeek(){  
        $content='';         
        foreach($this->dayLabels as $index=>$label){
            $content .= '<li class="DayOfWeek">' . $label . '</li>';
 
        }
         
        return $content;
    }

    private function getNumberWeeksInMonth($month=null,$year=null){ 
        if( null==($year) ) {
            $year =  date("Y",time()); 
        }
        if(null==($month)) {
            $month = date("m",time());
        } 
        
        $daysInMonths = $this->getNumberDayInMonth($month,$year);
        if ($daysInMonths % 7 == 0) {
            $numOfweeks =$daysInMonths / 7 ;
        } else {
            $numOfweeks = 1 + intval($daysInMonths / 7);
        }
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));  //'N' zwraca dzien tygodnia 
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
         
        if($monthEndingDay<$monthStartDay){ 
            $numOfweeks++;
        }
         
        return $numOfweeks;
    }
 
    private function getNumberDayInMonth($month=null,$year=null){
        if(null==($year)){
            $year =  date("Y",time()); 
        }
        if(null==($month)){
            $month = date("m",time());
        } 
        return date('t',strtotime($year.'-'.$month.'-01')); //'t' zwraca liczbe dni w miesiącu
    }
     
}