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

   public function index(){
      if( $this->__isLogin() == true ){
         $data['isLogin'] = 'true';
         $data['logoutUrl'] = $this->fb->getLogoutUrl();

         $feedUri = $this->config->item('groupId').'/feed';
         $json = $this->fb->api($feedUri);
         $data['json'] = $json;
      }else{
         $data['isLogin'] = 'false';
         $data['loginUrl'] = $this->fb->getLoginUrl();
      }

      $this->load->view('feed_overview', $data);
   }

   public function Update(){
      // Stat Update
      $data = array(
         'key' => 'lastupdate',
         'val' => time()
      );
      $this->db->update('stat', $data);
   }

   private function __isLogin(){
      $user = $this->fb->getUser();
      if($user){
         try{
            $this->fb->api('me');
         }catch(FacebookApiException $e){
            $user = null;
         }
      }
      if($user){
         return true;
      }else{
         return false;
      }
   }

}
