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

      $data = array(
         'article' => $this->userstat->getTotalArticle(),
         'comment' => $this->userstat->getTotalComment(),
         'like' => $this->userstat->getTotalLike(),
         'list' => $this->userstat->getUserStat()
      );

      $this->load->view('stat_head');
      $this->load->view('stat_body_list', $data);
      $this->load->view('stat_foot');
   }

   public function artLike(){
      $this->load->model('articlestat');

      $list = $this->articlestat->byLike();

      $this->load->view('stat_head');
      $this->load->view('artLike', array('list' => $list) );
      $this->load->view('stat_foot');
   }

   public function artComment(){
      $this->load->model('articlestat');

      $list = $this->articlestat->byComment();

      $this->load->view('stat_head');
      $this->load->view('artComment', array('list' => $list) );
      $this->load->view('stat_foot');
   }

   public function commentMost(){
      $this->load->model('userstat');

      $list = $this->userstat->commentMost();

      $this->load->view('stat_head');
      $this->load->view('commentMost', array('list' => $list) );
      $this->load->view('stat_foot');
   }
}
