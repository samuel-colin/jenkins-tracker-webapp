<?php
  /**
   *
   */

   require_once("sources/functions_utils.php");

  class JksTrackJob
  {
    var $v_name;
    var $v_color;
    var $v_url;
    var $v_stab_icon;
    var $v_test_icon;
    var $v_cov_icon;
    var $v_fail_flag;

    /**
     *
     */
    function __construct()
    {
      $this->v_name  = "black";
      $this->v_color = "";
      $this->v_url   = "";
      $this->v_stab_icon = "unknow.png";
      $this->v_test_icon = "unknow.png";
      $this->v_cov_icon  = "unknow.png";
      $this->v_fail_flag = true;
    }

    /**
     *
     */
    function set_with_json_obj ($p_json_obj)
    {
      $this->v_name  = "";
      $this->v_color = "black";
      $this->v_url   = "";
      $this->v_stab_icon = "unknow.png";
      $this->v_test_icon = "unknow.png";
      $this->v_cov_icon  = "unknow.png";
      $this->v_fail_flag = true;

      if($p_json_obj != NULL) {
          $this->v_name = $p_json_obj->{'name'};
          $this->v_url = $p_json_obj->{'url'};

          $job_json_color = $p_json_obj->{'color'};
          if ($job_json_color == "blue") {
              $this->v_color = "#4AC431";
          } else if ($job_json_color == "aborted" or $job_json_color == "disabled") {
              $this->v_color = "grey";
          } else if ($job_json_color == "yellow" or $job_json_color == "red" or $job_json_color == "grey") {
              $this->v_color = $job_json_color;
          }

          if ($job_json_color == "#4AC431") {
            $this->v_fail_flag  = false;
          } else {
            $this->v_fail_flag  = true;
          }
      }
    }

    /**
     * Getter $v_name
     */
    function get_name()
    {
      return $this->v_name;
    }

    /**
     * Getter $v_color
     */
    function get_color()
    {
      return $this->v_color;
    }

    /**
     * Getter $v_url
     */
    function get_url()
    {
      return $this->v_url;
    }

    /**
     * Getter $v_stab_icon
     */
    function get_stab_icon()
    {
      return $this->v_stab_icon;
    }

    /**
     * Getter $v_test_icon
     */
    function get_test_icon()
    {
      return $this->v_test_icon;
    }

    /**
     * Getter $v_cov_icon
     */
    function get_cov_icon()
    {
      return $this->v_cov_icon;
    }

    /**
     * Getter $v_fail_flag
     */
    function get_fail_flag()
    {
      return $this->v_fail_flag;
    }
  }
?>
