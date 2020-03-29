<?php 
    $answers = $_POST['all_answers'];
    


    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="foto_conf_trust_warmth.csv"');
    $fp = fopen('./data/foto_conf_trust_warmth.csv', 'a');
    $data = explode(",",$answers);
    foreach ( $data as $line ){
        $val = explode("-", $line);
        $sz = sizeof($val);
        if($sz >=3){
            fputcsv($fp, $val);
        }
    }
    fclose($fp);
    
?>