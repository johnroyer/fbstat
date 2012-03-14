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

         // Checking Pagination
         if( $this->input->get('act') == "prev" ){
            $feedUri = $this->session->userdata('prev');
         }elseif( $this->input->get('act') == "next" ){
            $feedUri = $this->session->userdata('next');
         }else{
            $feedUri = $this->config->item('groupId').'/feed';
         }
         $json = $this->fb->api($feedUri);

         $this->__savePaging($json);

         $this->load->library('cleaner');
         $out = $this->cleaner->jsonClean($json);
         $data['json'] = $out;

      }else{
         $data['isLogin'] = 'false';
         $data['loginUrl'] = $this->fb->getLoginUrl();
      }

      $this->load->view('feed_overview', $data);
   }

   public function Update(){
      $this->load->library('cleaner');
      $this->load->model('renew');

      $totalUpdate = 0;
      $feedUri = $this->config->item('groupId').'/feed';
      while( 1 ){
         $feed = $this->fb->api($feedUri);
         if( !array_key_exists('data', $feed) ){
            // End of feed or invalid data
            break;
         }

         $updated = 0;
         $json = $this->cleaner->jsonClean( $feed );
         foreach( $json as $art ){
            $updated += $this->renew->newArticle($art);
         }
         $totalUpdate += $updated;

         if( $updated == 0 ){
            // No more updates
            break;
         }

         // Find next Page
         if( array_key_exists('paging', $feed) ){
            $page = $feed['paging'];
            $feedUri = str_replace('https://graph.facebook.com/','',$page['next']);
         }else{
            break;
         }
      }
      echo "$totalUpdate data updated";

      // Stat Update
      $data = array(
         'key' => 'lastupdate',
         'val' => time()
      );
      $this->db->update('stat', $data);
   }

   public function truncate(){
      $this->db->query('TRUNCATE TABLE  `article`');
      $this->db->query('TRUNCATE TABLE  `comment`');
      $this->db->query('TRUNCATE TABLE  `like`');
      $this->db->query('TRUNCATE TABLE  `user`');
      echo "table truncated";
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

   private function __savePaging($json){
      if( array_key_exists('paging',$json) ){
         $page = $json['paging'];
         $prev = str_replace('https://graph.facebook.com/','',$page['previous']);
         $next = str_replace('https://graph.facebook.com/','',$page['next']);
      }else{
         $prev = $this->config->item('groupId').'/feed';
         $next = $this->config->item('groupId').'/feed';
      }
      $p = array( 
         'prev' => $prev,
         'next' => $next );
      $this->session->set_userdata($p);
   }

}
