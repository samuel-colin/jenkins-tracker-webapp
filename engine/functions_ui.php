<?php

    require_once("engine/functions_utils.php");
    
    function display($input_file) {
        //get all views on properties file
        $list_view = getElementsInFile($input_file);
        
        $html  = "<table>";
        
        foreach($list_view as $view) {
            $view2 = str_replace(" ", "%20", $view);
            $all_jobs = getJobsByView($view2);
            
            $countJobs = count($all_jobs);
            
            $html .= "<tr><td><h3>$view ($countJobs jobs)</h3></td></tr>";
            
            $html .= "<tr><td>".displayStats($all_jobs)."</td></tr>";
            $html .= "<tr><td>".displayJobs($all_jobs)."</td></tr>";
        }
        
        $html .= "</table>";
        
        return $html;
    }

    function displayHeader () {
        $html  = "<!DOCTYPE html>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "    <title>Jenkins Checker</title>";
        $html .= "    <link rel='shortcut icon' type='image/vnd.microsoft.icon' href='favicon.ico'>";
        $html .= "    <link rel='stylesheet' href='styles/main.css'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<h5>&copy;2016 - V00.02 - Samuel COLIN</h5>";
        $html .= "<h2>JENKINS CHECKER</h2>";
        return $html;
    }
    
    function displayFooter() {
        $html = "</body>";
        $html .= "</html>";
        return $html;
    }
    
    function displayJobs($all_jobs) {
        $html = "<table>";
        
        $cptMax=2;
        $cpt=0;
        foreach($all_jobs as $job) {
            if ($cptMax == $cpt) {
                $html .= "</table>";
                $html .= "<table>";
                $cpt = 0;
            }

            $colorValue = "black";
            $jobUrl     = "";
            $stabIcon   = "unknow.png";
            $testIcon   = "unknow.png";
            $covIcon    = "unknow.png";
            
            $jobName = $job->{'name'};
            $jobColor = $job->{'color'};
            $jobUrl = $job->{'url'};
            
            if ($jobColor == "blue") {
                $colorValue = "#4AC431";
            } else if ($jobColor == "aborted" or $jobColor == "disabled") {
                $colorValue = "grey";
            } else if ($jobColor == "yellow" or $jobColor == "red" or $jobColor == "grey") {
                $colorValue = $jobColor;
            }
            
            $html .= "<tr style='margin-right:20px;'>";
            $html .= "<td style='background-color:$colorValue;width:5px;'></td>";
            if ($colorValue == "#4AC431") {
                $html .= "<td id='one-job'><a href='$jobUrl' target='_blank'>$jobName</a></td>";
            } else {
                $html .= "<td id='one-job-fail'><a href='$jobUrl' target='_blank'>$jobName</a></td>";
            }
            $html .= "</tr>";
            
            $cpt = $cpt +1;
        }
        
        $html .= "</table>";
        return $html;
    }
    
    function displayStats($listJobs) {
        $cptJobOk = 0;
        $cptJobKo = 0;
        $cptJobWr = 0;
        $cptJobDi = 0;
        $cptJobUn = 0;
        
        foreach($listJobs as $job) {
            if($job != NULL) {
                $jobColor = $job->{'color'};
                if ($jobColor == "blue") {
                    $cptJobOk += 1;
                } else if ($jobColor == "aborted") {
                    $cptJobKo += 1;
                } else if ($jobColor == "disabled") {
                    $cptJobDi += 1;
                } else if ($jobColor == "yellow") {
                    $cptJobWr += 1;
                } else if ($jobColor == "red") {
                    $cptJobKo += 1;
                } else if ($jobColor == "grey") {
                    $cptJobDi += 1;
                }
                
            } else {
                $cptJobUn += 1;
            }
            
        }
        $html = "<table>";
        $html .= "<tr>";
        $html .= "<td id='stat-ok'>".$cptJobOk."</td>";
        $html .= "<td id='stat-ko'>".$cptJobKo."</td>";
        $html .= "<td id='stat-warn'>".$cptJobWr."</td>";
        $html .= "<td id='stat-dis'>".$cptJobDi."</td>";
        $html .= "<td id='stat-unk'>".$cptJobUn."</td>";
        $html .= "</tr>";
        $html .=  "</table>";
        return $html;
    }

?>