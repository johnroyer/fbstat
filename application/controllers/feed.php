<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {

   public function index()
   {

      $this->load->view('feed_overview');
   }

   public function Update(){
      // Stat Update
      $data = array(
         'key' => 'lastupdate',
         'val' => time()
      );
      $this->db->update('stat', $data);
   }

}
