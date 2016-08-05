<?php

require_once("src/functions_utils.php");

/**
 *
 */
class JksTrackStats
{

  var $p_cpt_job_ok;
  var $p_cpt_job_ko;
  var $p_cpt_job_wr;
  var $p_cpt_job_di;
  var $p_cpt_job_un;


  /**
   *
   */
  function __construct ()
  {
    $this->p_cpt_job_ok = 0;
    $this->p_cpt_job_ko = 0;
    $this->p_cpt_job_wr = 0;
    $this->p_cpt_job_di = 0;
    $this->p_cpt_job_un = 0;
  }

  /**
   *
   */
   function calc_all_stats ($p_list_jobs, $p_list_enable_jobs)
   {
     $jobs_ok = 0;
     $jobs_ko = 0;
     $jobs_wr = 0;
     $jobs_di = 0;
     $jobs_un = 0;

     foreach($p_list_enable_jobs as $job) {
         $realJob = get_json_job_by_name($job, $p_list_jobs);
         if($realJob != NULL) {
             $jobColor = $realJob->{'color'};
             if ($jobColor == "blue") {
                 $jobs_ok += 1;
             } else if ($jobColor == "aborted") {
                 $jobs_ok += 1;
             } else if ($jobColor == "disabled") {
                 $jobs_ok += 1;
             } else if ($jobColor == "yellow") {
                 $jobs_ok += 1;
             } else if ($jobColor == "red") {
                 $jobs_ok += 1;
             } else if ($jobColor == "grey") {
                 $jobs_ok += 1;
             }
         } else {
             $jobs_ok += 1;
         }
     }

     $this->p_cpt_job_ok = $jobs_ok;
     $this->p_cpt_job_ko = $jobs_ko;
     $this->p_cpt_job_wr = $jobs_wr;
     $this->p_cpt_job_di = $jobs_di;
     $this->p_cpt_job_un = $jobs_un;
   }

  /**
   * Getter $p_cpt_job_ok
   */
   function get_cpt_job_ok(){
     return $this->p_cpt_job_ok;
   }

   /**
    * Getter $p_cpt_job_ko
    */
    function get_cpt_job_ko(){
      return $this->p_cpt_job_ko;
    }

    /**
     * Getter $p_cpt_job_wr
     */
     function get_cpt_job_wr(){
       return $this->p_cpt_job_wr;
     }

     /**
      * Getter $p_cpt_job_di
      */
      function get_cpt_job_di(){
        return $this->p_cpt_job_di;
      }


      /**
       * Getter $p_cpt_job_un
       */
       function get_cpt_job_un(){
         return $this->p_cpt_job_un;
       }
}

?>
