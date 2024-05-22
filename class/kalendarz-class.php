<?php
class Calendar {  

    public function __construct(){     
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }
 
    private $dayLabels = array("Poniedziałek","Wtorek","Środa","Czwartek","Piątek","Sobota","Niedziela");
    private $currentYear=0;
    private $currentMonth=0;
    private $currentDay=0;
    private $currentDate=null;
    private $daysInMonth=0;
    private $naviHref= null;
  
    public function show() {
        $year  = null;
        $month = null;   
        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }else if(null==$year){
            $year = date("Y",time());  
        }          
        if(isset($_GET['month'])){
            $month = $_GET['month'];
        }else if(null==$month){
            $month = date("m",time());
        }                  
         
        $this->currentYear=$year;
        $this->currentMonth=$month;
        $this->daysInMonth=$this->getNumberDayInMonth($month,$year);  
         
        $content='<div id="calendar">'.
                        '<div class="box">'.
                        $this->createHeader().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label">'.$this->createDaysOfWeek().'</ul>';   
                                $content.='<div class="clear"></div>';     
                                $content.='<ul class="dates">';    
                                 
                                $weeksInMonth = $this->getNumberWeeksInMonth($month,$year);
                                for( $i=0; $i<$weeksInMonth; $i++ ){
                                    for($j=1;$j<=7;$j++){
                                        $content.=$this->getDay($i*7+$j);
                                    }
                                }
                                $content.='</ul>'; 
                                $content.='<div class="clear"></div>';     
                        $content.='</div>';
        $content.='</div>';
        return $content;   
    }
     
   
    private function getDay($cellNumber) {
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
            $classes .= 'otherDate ';
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
            $classes .= 'otherDate ';
        } else {
            $currentMonth = $this->currentMonth;
            $currentYear = $this->currentYear;
            $this->currentDate = date('Y-m-d', strtotime($currentYear.'-'.$currentMonth.'-'.$currentDayInMonth));
            $classes .= 'Date ';
        }
        $cellContent = $currentDayInMonth;
        $liElement = '<a class="' . $classes . '" href="plan-tygodnia.php?date=' . $this->currentDate . '">' . $cellContent . '</a>';


        return $liElement;
    }
     

    private function createHeader(){
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
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                    '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }

    private function createDaysOfWeek(){  
                 
        $content='';
         
        foreach($this->dayLabels as $index=>$label){
            $content .= '<li class="';
            if ($label == 6) {
                $content .= 'end title';
            } else {
                $content .= 'start title';
            }
            $content .= ' title">' . $label . '</li>';
 
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