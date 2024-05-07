<?php
trait DateHelpers{
    public function getMonthNumberDays(){
        return (int) $this->format('t');
    }
    public function getCurrentDayNumber(){
        return (int) $this->format('j');
    }
    public function getMonthNumber(){
        return (int) $this->format('n');
    }
    public function getMonthName(){
        return $this->format('F');
    }
    public function getYear(){
        return $this->format('Y');
    }
}

class ObecnaData extends DateTimeImmutable{
    use DateHelpers;
    public function __construct(){
        parent::__construct();
    }
}

class KalendarzData extends DateTime{
    use DateHelpers;
    public function __construct(){
        parent::__construct();
        $this->modify('first day of this month');
    }

    public function getMonthStartDayOfWeek(){
        return (int) $this->format('w');
    }
}

class Kalendarz{
    protected $currentDate;
    protected $calendarDate;

    protected $dayLabels=['Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela'];
    protected $monthLabels=['Styczeń','Luty','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'];
    protected $sundayFirst=true;
    protected $weeks=[];

    public function __construct(ObecnaData $currentDate,KalendarzData $calendarDate){
        $this->currentDate=$currentDate;
        $this->calendarDate=clone $calendarDate;
        $this->calendarDate->modify('first day of this month');
    }
    public function getDayLabels(){
        return $this->dayLabels;
    }
    public function getMonthLabels(){
        return $this->monthLabels;
    }
    public function setSundayFirst($bool){
        $this->sundayFirst=$bool;

        if(!$this->sundayFirst){
            array_push($this->dayLabels,array_shift($this->dayLabels));
        }
    }
    public function setMonth($monthNumber){
        $this->calendarDate->setDate($this->calendarDate->getYear(),$monthNumber,1);
    }
    public function getCalendarMonth(){
        return $this->calendarDate->getMonthName();
    }
    public function getCalendarDate() {
        return $this->calendarDate;
    }
    public function getMonthFirstDay(){
        return $this->calendarDate->getMonthStartDayOfWeek();
    }
    public function getWeeks(){
        return $this->weeks;
    }
    public function create(){
        $days=array_fill(0,($this->getMonthFirstDay()-1),['currentMonth'=>false,'dayNumber'=>'']);
        for($x=1;$x<=$this->calendarDate->getMonthNumberDays();$x++){
            $days[]=['currentMonth'=>true,'dayNumber'=>$x];
        }
        $this->weeks=array_chunk($days,7);

        $firstWeek=$this->weeks[0];
        $prevMonth=clone $this->calendarDate;
        $prevMonth->modify('-1 month');
        $prevMonthNumDays=$prevMonth->getMonthNumberDays();

        for($x=6;$x>=0;$x--){
            if(!$firstWeek[$x]['dayNumber']){
                $firstWeek[$x]['dayNumber']=$prevMonthNumDays;
                $prevMonthNumDays-=1;
            }
        }
        $this->weeks[0]=$firstWeek;

        $lastWeek=$this->weeks[count($this->weeks)-1];
        $nextMonth=clone $this->calendarDate;
        $nextMonth->modify('+1 month');

        $c=1;
        for($x=0;$x<7;$x++){
            if(!isset($lastWeek[$x])){
                $lastWeek[$x]['currentMonth']=false;
                $lastWeek[$x]['dayNumber']=$c;
                $c++;
            }
        }
        $this->weeks[count($this->weeks)-1]=$lastWeek;
    }
}

?>