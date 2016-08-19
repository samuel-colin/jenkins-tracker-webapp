<?php

require_once("sources/functions_utils.php");
require_once("sources/model/JksTrackStats.php");
require_once("sources/model/JksTrackJob.php");


/**
 * Display header
 * @author Samuel COLiN <https://github.com/samuel-colin>
 * @since 1.0
 *
 * @return string : The HTML stream of headers page
 */
function display_header () {
    $html  = "<!DOCTYPE html>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "    <title>Jenkins Tracker WebApp</title>";
    $html .= "    <link rel='shortcut icon' type='image/vnd.microsoft.icon' href='favicon.ico'>";
    $html .= "    <link rel='stylesheet' href='styles/main.css'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<h2>JENKINS TRACKER</h2>";
    return $html;
}


/**
 * Display content
 * @author Samuel COLiN <https://github.com/samuel-colin>
 * @since 1.0
 *
 * @param string $title       : Title of the part
 * @param string $file        : Configuration file
 * @param string $url_jenkins : Jenkins URL
 *
 * @return string : The HTML stream of headers page
 */
function display_content($title, $file, $url_jenkins) {
    $listJobs  = get_list_jobs_name_by_file($file);

    $html  = "<table>";

    if ($listJobs != NULL) {
        $countJobs = count($listJobs);
        $html .= "<tr><td><h3>$title ($countJobs jobs)</h3></td></tr>";

        $allJobs   = get_json_job_by_name($url_jenkins);

        $html .= "<tr><td>".display_stats($allJobs, $listJobs)."</td></tr>";

        $html .= "<tr><td>".display_jobs($allJobs, $listJobs)."</td></tr>";
    } else {
        $html .= "<tr><td><h3>$title (/!\ Erreur lors de l'ouverture du fichier)</h3></tr></td>";
    }

    $html .= "</table>";

    return $html;
}


/**
 * Display statistics part
 * @author Samuel COLiN <https://github.com/samuel-colin>
 * @since 1.0
 *
 * @param string $p_list_jobs        : List of all Jenkins jobs
 * @param string $p_list_enable_jobs : List of all jobs in the configuration file
 *
 * @return string : The HTML stream of headers page
 */
function display_stats($p_list_jobs, $p_list_enable_jobs) {
    $jks_track_stats = new JksTrackStats();
    $jks_track_stats->calc_all_stats($p_list_jobs, $p_list_enable_jobs);

    $html = "<table>";
    $html .= "<tr>";
    $html .= "<td id='stat-ok'>".$jks_track_stats->get_cpt_job_ok()."</td>";
    $html .= "<td id='stat-ko'>".$jks_track_stats->get_cpt_job_ko()."</td>";
    $html .= "<td id='stat-warn'>".$jks_track_stats->get_cpt_job_wr()."</td>";
    $html .= "<td id='stat-dis'>".$jks_track_stats->get_cpt_job_di()."</td>";
    $html .= "<td id='stat-unk'>".$jks_track_stats->get_cpt_job_un()."</td>";
    $html .= "</tr>";
    $html .=  "</table>";
    return $html;
}


/**
 * Display jobs part
 * @author Samuel COLiN <https://github.com/samuel-colin>
 * @since 1.0
 *
 * @param string $p_list_jobs        : List of all Jenkins jobs
 * @param string $p_list_enable_jobs : List of all jobs in the configuration file
 *
 * @return string : The HTML stream of headers page
 */
function display_jobs ($p_list_jobs, $p_list_enable_jobs) {
    $html = "<table>";

    $cpt_max_col=25;
    $cpt=0;
    foreach($p_list_enable_jobs as $job) {
        if ($cpt_max_col == $cpt) {
            $html .= "</table>";
            $html .= "<table>";
            $cpt = 0;
        }

        $job_json = get_json_job_by_name($job, $p_list_jobs);
        $job_model = new JksTrackJob();
        $job_model->set_with_json_obj($job_json);

        $html .= "<tr style='margin-right:20px;'>";
        $html .= "<td style='background-color:".$job_model->get_color().";width:5px;'></td>";
        if ($job_model->get_fail_flag()) {
            $id_style = "one-job";
        } else {
            $id_style = "one-job-fail";
        }
        $html .= "<td id='$id_style'><a href='".$job_model->get_url()."' target='_blank'>".$job_model->get_name()."</a></td>";

        $html .= "<td>";
        $html .= "<img src='icons/".$job_model->get_stab_icon()."' title='Stabilité du build'/>";
        $html .= "<img src='icons/".$job_model->get_test_icon()."' title='Résultats des tests'/>";
        $html .= "<img src='icons/".$job_model->get_cov_icon()."'  title='Coverage'/>";
        $html .= "</td>";

        $html .= "</tr>";

        $cpt = $cpt +1;
    }

    $html .= "</table>";

    return $html;
}


/**
 * Display footer
 * @author Samuel COLiN <https://github.com/samuel-colin>
 * @since 1.0
 *
 * @return string : The HTML stream of headers page
 */
function display_footer() {
    $html  = "</body>";
    $html .= "</html>";
    return $html;
}

?>
