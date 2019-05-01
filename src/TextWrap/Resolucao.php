<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {

	/**
	* {@inheritdoc}
	*/
    public function textWrap(string $text, int $length): array {
        $ret = array();
        $i=0;
        while($i<strlen($text)){
            $aux = "";
            $lineSize = $length;
            $breakLine = false;
            $breakWord = false;
            while(!$breakLine){
                if($text[$i] != " "){
                    for($j=$i;$j<strlen($text);$j++){
                        if($text[$j] == " ")
                            break;
                    }
                    $ws = $j-$i;
                    if($ws<=$lineSize){
                        if($aux != "")
                            $aux.=" ";
                        $last = $i+$ws-1;
                        $frst = $i;
                        for($j = $frst;$j<=$last;$j++){
                            $aux.=$text[$j];
                            $i++;
                            $lineSize--;
                        }
                    }
                    else{
                        if($ws>$length)
                            $breakWord = true;
                        $breakLine = true;
                    }
                }
                else{
                    //$aux.= " ";
                    $lineSize--;
                    $i++;
                }
                if($breakWord){
                    array_push($ret, $aux);
                    $aux = "";
                    $last = $i+$length-1;
                    $frst = $i;
                    for($j=$frst;$j<=$last;$j++){
                         $aux.=$text[$j];
                         $i++; 
                     }
                }
                if($lineSize <= 0)
                    $breakLine = true;
                if($i>=strlen($text))
                    $breakLine = true;
            }
            array_push($ret,$aux);
        }
        if(count($ret)==0)
            return array("");
        return $ret;
    }
}
