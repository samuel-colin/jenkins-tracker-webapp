<?php

    function callWebService ($url) {
        $objJson = file_get_contents($url);
        return json_decode($objJson);
    }
    
    function getElementsInFile ($file) {
        $listElts = array();
        
        if (file_exists($file)) {
            $myFile = fopen($file, 'r+');
            
            if ($myFile != NULL) {
                while(($line = fgets($myFile)) !== false) {
                    array_push($listElts, rtrim($line, "\n"));
                }
                
                fclose($myFile);
            
                return $listElts;
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    function getJobsByView ($view) {
        $objJson = callWebService("http://pic-java/jenkins/view/$view/api/json");
        return $objJson->{'jobs'};
    }
    
?>