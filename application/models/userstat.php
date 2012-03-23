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

   public function commentMost(){
      $sql  = 'select a.id, c.name, a.message, count(b.comment) ';
      $sql .= 'from `comment` as b ';
      $sql .= 'inner join `article` as a on a.id = b.article_id ';
      $sql .= 'inner join `user` as c on b.user_id = c.id ';
      $sql .= 'group by a.id, c.id ';
      $sql .= 'order by count(b.comment) desc ';

      $query = $this->db->query($sql);
      $list = array();

      foreach($query->result_array() as $row ){
         $list[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'message' => mb_substr($row['message'], 0, 50),
            'comment' => $row['count(b.comment)'] 
         );
      }
      return $list;
   }

}


?>
