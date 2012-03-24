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
      $this->__getDateRange();

      $session = $this->session->all_userdata();

      $tmp = $this->session->userdata('from');
      $from = $tmp !== false ? date('Y/m/d', $tmp) : 0;
      $tmp = $this->session->userdata('to');
      $to = $tmp !== false ? date('Y/m/d', $tmp): 0;
      $head = array(
         'title' => '概況', 
         'from' => $from,
         'to' => $to
      );
      $data = array(
         'article' => $this->userstat->getTotalArticle(),
         'comment' => $this->userstat->getTotalComment(),
         'like' => $this->userstat->getTotalLike(),
         'list' => $this->userstat->getUserStat(),
      );

      $this->load->view('stat_head', $head);
      $this->load->view('stat_body_list', $data);
      $this->load->view('stat_foot');
   }

   public function artLike(){
      $this->load->model('articlestat');
      $this->__getDateRange();

      $tmp = $this->session->userdata('from');
      $from = $tmp !== false ? date('Y/m/d', $tmp) : 0;
      $tmp = $this->session->userdata('to');
      $to = $tmp !== false ? date('Y/m/d', $tmp): 0;
      $head = array(
         'title' => '熱門文章 (讚)', 
         'from' => $from,
         'to' => $to
      );
      $list = $this->articlestat->byLike();

      $this->load->view('stat_head', $head );
      $this->load->view('artLike', array('list' => $list) );
      $this->load->view('stat_foot');
   }

   public function artComment(){
      $this->load->model('articlestat');
      $this->__getDateRange();

      $tmp = $this->session->userdata('from');
      $from = $tmp !== false ? date('Y/m/d', $tmp) : 0;
      $tmp = $this->session->userdata('to');
      $to = $tmp !== false ? date('Y/m/d', $tmp): 0;
      $head = array(
         'title' => '熱門文章 (回覆)', 
         'from' => $from,
         'to' => $to
      );
      $list = $this->articlestat->byComment();

      $this->load->view('stat_head', $head );
      $this->load->view('artComment', array('list' => $list) );
      $this->load->view('stat_foot');
   }

   public function commentMost(){
      $this->load->model('userstat');
      $this->__getDateRange();

      $tmp = $this->session->userdata('from');
      $from = $tmp !== false ? date('Y/m/d', $tmp) : 0;
      $tmp = $this->session->userdata('to');
      $to = $tmp !== false ? date('Y/m/d', $tmp): 0;
      $head = array(
         'title' => '回覆踴躍', 
         'from' => $from,
         'to' => $to
      );
      $list = $this->userstat->commentMost();

      $this->load->view('stat_head', $head );
      $this->load->view('commentMost', array('list' => $list) );
      $this->load->view('stat_foot');
   }

   private function __getDateRange(){
      $from = $this->input->get_post('from');
      $to = $this->input->get_post('to');
      $range = array();
      if( $from != '' && $to != '' ){
         $from = strtotime($from);
         $to = strtotime($to);
         if( $from > $to ){
            $tmp = $from;
            $from = $to;
            $to = $tmp;
         }
         $range = array(
            'from' => $from,
            'to' => $to
         );
         $this->session->set_userdata($range);
      }
   }
}
