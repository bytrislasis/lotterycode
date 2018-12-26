<?php
public function lottery (){
  $orjinalhash = file_get_contents("https://blockchain.info/q/latesthash");
  $hash  = substr(trim($orjinalhash),16,48);
  $split = str_split( $hash,4 );
  $uniq = array();
    for($i=0;$i<count( $split ); $i++){
        array_push($uniq,hexdec ( $split[$i])%50 );
    }
  $sixNumber  = array_chunk(array_unique( $uniq ),6);
  $data = array();
  $number ="";
    for($x=0; $x<count($sixNumber[0]); $x++){
        if($sixNumber[0][$x] == 0){
            $sixNumber[0][$x] = $sixNumber[1][0];
            $number .= sprintf('%02d',$sixNumber[1][0])."-";
        }else{
            $number .= sprintf('%02d',$sixNumber[0][$x])."-";
        }
    }
  $data[0] = $number;
  $data[1] = $hash;
  $data[2] = $orjinalhash;
  return $data;
}
?>
