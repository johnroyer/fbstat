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
      $range = $this->getRange();

      $this->db->from('article');
      $this->db->where('user_id', $id);
      if( $range['from'] != 0 && $range['to'] != 0 ){
         $this->db->where('created_time > ', $range['from']);
         $this->db->where('created_time < ', $range['to']);
      }
      return $this->db->count_all_results();
   }

   public function countComment($id){
      $range = $this->getRange();

      $this->db->from('comment');
      $this->db->where('user_id', $id);
      if( $range['from'] != 0 && $range['to'] != 0 ){
         $this->db->where('created_time > ', $range['from']);
         $this->db->where('created_time < ', $range['to']);
      }
      return $this->db->count_all_results();
   }

   public function countLike($id){
      $range = $this->getRange();

      $this->db->from('like');
      $this->db->where('user_id', $id);
      if( $range['from'] != 0 && $range['to'] != 0 ){
         $this->db->where('created_time > ', $range['from']);
         $this->db->where('created_time < ', $range['to']);
      }
      return $this->db->count_all_results();
   }

   public function getTotalArticle(){
      $range = $this->getRange();

      $this->db->from('article');
      if( $range['from'] != 0 && $range['to'] != 0 ){
         $this->db->where('created_time > ', $range['from']);
         $this->db->where('created_time < ', $range['to']);
      }
      return $this->db->count_all_results();
   }

   public function getTotalComment(){
      $range = $this->getRange();

      $this->db->from('comment');
      if( $range['from'] != 0 && $range['to'] != 0 ){
         $this->db->where('created_time > ', $range['from']);
         $this->db->where('created_time < ', $range['to']);
      }
      return $this->db->count_all_results();
   }

   public function getTotalLike(){
      $range = $this->getRange();

      $this->db->from('like');
      if( $range['from'] != 0 && $range['to'] != 0 ){
         $this->db->where('created_time > ', $range['from']);
         $this->db->where('created_time < ', $range['to']);
      }
      return $this->db->count_all_results();
   }

   public function commentMost(){
      $tmp = $this->session->userdata('from');
      $from = $tmp !== false ? $tmp - 1 : 0;
      $tmp = $this->session->userdata('to');
      $to = $tmp !== false ? $tmp + 1: 0;

      $sql  = 'select a.id, c.name, a.message, count(b.comment) ';
      $sql .= 'from `comment` as b ';
      $sql .= 'inner join `article` as a on a.id = b.article_id ';
      $sql .= 'inner join `user` as c on b.user_id = c.id ';
      if( $from != 0 && $to != 0 ){
         $sql .= "where b.created_time > $from and b.created_time < $to ";
      }
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

   private function getRange(){
      $tmp = $this->session->userdata('from');
      $from = $tmp !== false ? $tmp - 1 : 0;
      $tmp = $this->session->userdata('to');
      $to = $tmp !== false ? $tmp + 1: 0;
      $range = array(
         'from' => $from,
         'to' => $to
      );
      return $range;
   }
}


?>
