<?php

/**
 * 
 **/
class Stat extends CI_Controller {

   public function __contruct(){
      parent::__contruct();
   }

   public function index(){
      $this->load->model('userstat');

      $list = $this->userstat->getUserStat();

      $this->load->view('stat_head');
      $this->load->view('stat_body_list', array('list' => $list ) );
      $this->load->view('stat_foot');
   }
}
