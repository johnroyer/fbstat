<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {

   private $fb;

   public function __construct(){
      parent::__construct();
      require('facebook.php');
      $this->fb = new Facebook( array(
         'appId' => $this->config->item('appId'), 
         'secret' => $this->config->item('secret') )
      );

   }
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
