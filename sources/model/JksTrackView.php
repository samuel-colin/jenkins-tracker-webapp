<?php
  /**
   *
   */

   require_once("sources/functions_utils.php");

  class JksTrackView
  {
      var $v_config_file;
      var $v_arr_jobs;

      /**
       * Constructor
       */
      function __construct($p_config_file_name)
      {
        $this->set_config_file($_config_file_name);
        $this->set_list_jobs(generate_jobs_by_config_file());
      }

      /**
       *
       */
      function generate_jobs_list_by_config_file()
      {
        $obj_json = call_web_service(get_url_all_jobs());
        $obj_json_all_jobs =  $obj_json->{'jobs'};
      }

      /**
       * Getter $v_config_file
       */
      function set_config_file ($p_file_name)
      {
        $this->v_config_file = $_config_file_name;
      }

      /**
       * Setter $v_config_file
       */
      function get_config_file ()
      {
        return $this->v_config_file;
      }

      /**
       * Getter $v_arr_jobs
       */
      function set_list_jobs ($p_arr_jobs)
      {

        if ($this->v_arr_jobs == NULL)
        {
          $this->v_arr_jobs = array();
        }

        $this->v_arr_jobs = $p_arr_jobs;

      }

      /**
       * Setter $v_arr_jobs
       */
      function get_list_jobs ()
      {
        return $this->v_arr_jobs;
      }
  }
?>
