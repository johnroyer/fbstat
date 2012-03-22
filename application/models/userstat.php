<?php 

class Userstat extends CI_Model {

   public function __contruct(){
      parent::__contruct();
   }

   public function getUserStat(){
      $query = $this->db->get('user');
      $user = array();
      foreach( $query->result_array() as $row ){
         $user[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'article' => $this->countArticle($row['id']),
            'comment' => $this->countComment($row['id']),
            'like' => $this->countLike($row['id'])
         );
      }

      return $user;
   }

   public function countArticle($id){
      $this->db->from('article');
      $this->db->where('user_id', $id);
      return $this->db->count_all_results();
   }

   public function countComment($id){
      $this->db->from('comment');
      $this->db->where('user_id', $id);
      return $this->db->count_all_results();
   }

   public function countLike($id){
      $this->db->from('like');
      $this->db->where('user_id', $id);
      return $this->db->count_all_results();
   }

   public function getTotalArticle(){
      $this->db->from('article');
      return $this->db->count_all_results();
   }

   public function getTotalComment(){
      $this->db->from('comment');
      return $this->db->count_all_results();
   }

   public function getTotalLike(){
      $this->db->from('like');
      return $this->db->count_all_results();
   }

}


?>
