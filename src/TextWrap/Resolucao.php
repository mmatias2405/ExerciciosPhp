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
                    $ws = $this->wordSize($text, $i);
                    if($aux!="")
                        $ws++;
                    if($ws<=$lineSize){
                        if($aux!=""){
                            $aux.=" ";
                            $lineSize--;
                            $ws--;
                        }
                        $aux.=$this->slice($text, $i, $i+$ws-1);
                        $i+=$ws;
                        $lineSize-=$ws;
                    }
                    else{
                        if($ws>$length)
                            $breakWord = true;
                        $breakLine = true;
                    }
                }
                else
                    $i++;
                if($breakWord){
                    if($aux!= "")
                        array_push($ret, $aux);
                    $aux = "";
                    $aux.=$this->slice($text, $i, $i+$length-1);
                    $i+=$length;
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
    /*
        Essa função retorna o tamanho de uma palavra(do i até o próximo espaço " "), supondo que o i esteja indicando a primeira letra da palavra. 
    */
    private function wordSize(string $text, int $frst) : int {
        for($i = $frst; $i < strlen($text); $i++){
            if($text[$i]==" ")
                return $i-$frst;
        }
        return $i-$frst;
    }
    /*
        Essa função retorna uma nova string que é uma fatia da string recebida como parametro, partindo de $text[$frst] até $text[$last];
    */
    private function slice(string $text, int $frst, int $last): string {
        $ret = "";
        for($i = $frst; $i<=$last; $i++){
            $ret.=$text[$i];
        }
        return $ret;
    }
}
