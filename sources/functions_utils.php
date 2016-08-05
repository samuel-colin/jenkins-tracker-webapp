<?php

/**
 * Call a Web Service
 */
function call_web_service ($url) {
    $objJson = file_get_contents($url);
    return json_decode($objJson);
}

/**
 * Generate the URL for all Jenkins jobs
 */
function get_url_all_jobs($url_jenkins) {
    return $url_jenkins+"/api/json?pretty=true";
}

/**
 * Generate the URL for a specific job
 */
function get_url_one_job($url_jenkins, $p_job_name) {
    return $url_jenkins+"/job/$p_job_name/api/json?pretty=true";
}

/**
 * Parse configuration file in paramateter and get all jobs in him
 * 1 job name => 1 line
 */
function get_list_jobs_name_by_file ($p_file) {
    $list_jobs = array();

    if (file_exists($p_file)) {
        $file_config = fopen($p_file, 'r+');

        if ($file_config != NULL) {
            while(($line = fgets($file_config)) !== false) {
                array_push($list_jobs, rtrim($line, "\n"));
            }

            fclose($file_config);

            return $list_jobs;
        } else {
            return NULL;
        }
    } else {
        return NULL;
    }
}

/**
 * Get Job Json Object by his name
 */
function get_json_job_by_name ($p_job_name, $p_list_json_jobs) {
    if (!empty($p_list_json_jobs)) {
        foreach($p_list_json_jobs as $job) {
            if ($job->{'name'} == $p_job_name) {
                echo "#1 : ".$job;
                return $job;
            }
        }
    }
    else
    {
      echo "#2 : EMPTY LIST";
    }

    return NULL;
}

/**
 *
 */
function get_json_job_health_by_name ($p_job_name) {
    $objJson = call_web_service(get_url_one_job($p_job_name));
    return $objJson->{'healthReport'};
}

/**
 *
 */
function get_json_job_by_name ($p_job_name) {
    return call_web_service(get_url_one_job($p_job_name));
}


?>
