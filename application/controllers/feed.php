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

         $data['json'] = $this->__getFeed();


      }else{
         $data['isLogin'] = 'false';
         $data['loginUrl'] = $this->fb->getLoginUrl( array(
            'scope' => 'user_groups, friends_groups')
         );
      }

      $this->load->view('feed_overview', $data);
   }

   public function next(){
      // code...  
   }

   public function prev(){
      // code...
   }

   private function __getFeed(){
      $data['logoutUrl'] = $this->fb->getLogoutUrl();
      $feedUri = $this->config->item('groupId').'/feed';
      $json = $this->fb->api($feedUri);

      //Paging
      $page = $json['paging'];
      $next = str_replace('https://graph.facebook.com/','',$page['next']);
      $prev = str_replace('https://graph.facebook.com/','',$page['previous']);
      $this->session->set_userdata( array(
        'next' => $next,
        'prev' => $prev )
      );

      return $json;
 
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
