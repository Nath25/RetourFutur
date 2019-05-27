<?php

class TimeTravel
{

    public $start;
    public $interval;
    public $end;

    public function __construct($start, $interval)
    {
        $this->start = $start;
        $this->interval = $interval;
    }

    public function finalDate()
    {
        $date = date_create($this->start);
        date_sub($date, date_interval_create_from_date_string($this->interval."seconds"));
        return $this->end = date_format($date, 'd-m-Y H:i:s.');
    }

    public function getTravelInfo()
    {
        $nbrSecParJour = 3600*24;
        $nbrSecParAn = $nbrSecParJour*365.25;
        $nbrSecParMois = $nbrSecParJour*30;

        $nbrAnnees = floor($this->interval / $nbrSecParAn);
        $reste = $this->interval % $nbrSecParAn;

        $nbrMois = floor($reste / $nbrSecParMois);
        $reste = $reste % $nbrSecParMois;

        $nbrSemaines = floor($reste / ($nbrSecParJour*7));
        $reste = $reste % ($nbrSecParJour*7);

        $nbrJours = floor($reste / $nbrSecParJour);
        $reste = $reste % $nbrSecParJour;

        $nbrHeures = floor($reste / 3600);
        $reste = $reste % 3600;

        $nbrMinutes = floor($reste / 60);
        $reste = $reste % 60;

        return "Soit : ".$nbrAnnees." année(s), ".$nbrMois." mois, ".$nbrSemaines." semaine(s), ".$nbrJours." jour(s), "
        .$nbrHeures." heure(s), ".$nbrMinutes." minute(s) et ".$reste. " seconde(s).";
    }

    public function backToTheFutureStepByStep($step)
    {

        $begin = new DateTime( $this->end );
        $end = new DateTime( $this->start );

        $daterange = new DatePeriod($begin, $step, $end);
        foreach ($daterange as $date){
           echo $date->format("d-m-Y, H:i:s") . "<br>";
            
        }
        

    }



    

}





