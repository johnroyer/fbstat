<?php

class Renew extends CI_Model {

   public function __contruct(){
      parent::__contruct();
   }

   public function newArticle($data){
      $updated = 0;

      $comment = $data['comment'];
      $like = $data['like'];
      $data['user_id'] = $this->getUserId($data['user']);
      $data['link'] = $data['link'] == '' ? 'null' : $data['link'];
      unset($data['comment']);
      unset($data['like']);
      unset($data['user']);

      // Update Article
      $updated += $this->insert('article', $data);

      // Update Comments
      $updated += $this->newComment($data['id'], $comment);

      // Update Likes
      $updated += $this->newLike($data['id'], $like);

      return $updated;
   }

   private function newComment($art_id, $data){
      $updated = 0;
      foreach($data as $co){
         $commentData = array(
            'article_id' => $art_id ,
            'user_id' => $this->getUserId($co['user']),
            'comment' => $co['comment']
         );
         $updated += $this->insert('comment', $commentData);
      }
      return $updated;
   }
   
   private function newLike($art_id, $data){
      $updated = 0;
      foreach( $data as $user ){
         $db = array(
            'article_id' => $art_id ,
            'user_id' => $this->getUserId($user)
         );
         $updated += $this->insert('like', $db);
      }
      return $updated;
   }

   private function getUserId($in){
      $this->newUser($in);
      return $in['id'];
   }

   private function newUser($data){
      return $this->insert('user', $data);
   }

   private function insert($table, $data){
      if( $this->db->insert($table, $data) !== false ){
         // insert sccessful
         return $this->db->affected_rows();
      }else{
         // insert fail
         return 0;
      }
   }
}
