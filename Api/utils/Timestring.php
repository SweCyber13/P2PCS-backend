<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 29/05/2019
 * Time: 22:33
 */

class Timestring
{
    private $length=96;
    private $minute_block=15;
    //la stringa di default sono tutti zeri
    private $defaultstr="000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000";

    public $string;
    //1 is free 0 is occupie

    public function __construct($string="000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000") {
        $this->string=$string;
    }

    public function make($start,$end) {
        //generate a 96 char string of 1 or 0 where 1s are the multiple 15 minutes blocks from start to end
        //both start and end are converted into minutes and a day has 1440 minutes
        //then there are 96 15 minutes blocks
        $result="";
        $limit=$this->length*$this->minute_block;
        for ($i = 0; $i < $limit; $i=$i+$this->minute_block) {
            if($i>=$start && $i<$end) {
                $result=$result."1";
            }
            else {
                $result=$result."0";
            }
        }
        $this->string=$result;
    }

    public function decode(){
        //ritorna le disponibilità come array numerico, gli indici pari sono i minuti di inizio dispari sono la fine
        $arr=array();
        $one=false;
        for ($i = 0; $i < strlen($this->string); $i++){
            if($this->string[$i]=="1"&&!$one){
                //start time found
                $time=$i*$this->minute_block;
                array_push($arr,$time);
                $one=true;
            }
            else {
                if($this->string[$i]=="0"&&$one) {
                    //end time found
                    $time=$i*$this->minute_block;
                    array_push($arr,$time);
                    $one=false;
                }
            }
        }
        //check if last one in 1
        if($this->string[$this->length-1]=="1")
        {
            $time=$this->length*$this->minute_block;
            array_push($arr,$time);
        }
        return $arr;

    }

    function xor_string(Timestring $string, $update=false) {
        //l'utente passa una stringa, sono da controllare che tutti gli 1 presenti sulla stringa passata ci siano anche su quella attuale
        //se $update è vero cambia il valore del campo stringa se e solo se i caratteri che valgono 1 della
        // stringa passata valgono 1 anche su campo $string del chiamante
        for ($i = 0; $i < strlen($string->string); $i++){
            if($string->string[$i]=="1"&&$this->string[$i]=="0"){
                return false;
            }
        }

        if($update){
            for ($i = 0; $i < strlen($string->string); $i++){
                if($string->string[$i]=="1"){
                    $this->string[$i]="0";
                }
            }
        }

        return true;
    }

    function update_string(Timestring $string) {
        //l'utente passa una nuova stringa, sono da aggiungere gli uno della stringa passata a quella attuale
        for ($i = 0; $i < strlen($string->string); $i++){
            if($string->string[$i]=="1"){
                $this->string[$i]="1";
            }
        }
    }
}