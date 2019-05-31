<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 30/05/2019
 * Time: 15:49
 */

class Timesegment
{
    public $inizio;
    public $fine;

    public function __construct($inizio,$fine){
        $this->inizio=$inizio;
        $this->fine=$fine;
    }

}