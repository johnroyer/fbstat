<?php

class ArticleStat extends CI_Model {

   public function __contruct(){
      parent::__contruct();
   }

   public function byLike(){
      $range = $this->getRange();

      $sql  = 'select a.id, a.message, count(b.user_id), c.name ';
      $sql .= 'from `article` as a  ';
      $sql .= 'left join `like` as b on a.id = b.article_id  ';
      $sql .= 'inner join `user` as c on a.user_id = c.id ';
      $sql .= $range;
      $sql .= 'group by a.id ';
      $sql .= 'order by count(b.user_id) desc ';

      $query = $this->db->query($sql);
      $list = array();

      foreach($query->result_array() as $row){
         $list[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'message' => mb_substr($row['message'], 0, 100),
            'like' => $row['count(b.user_id)']
         );
      }
      return $list;
   }

   public function byComment(){
      $range = $this->getRange();

      $sql  = 'select a.id, a.message, count(b.user_id), c.name ';
      $sql .= 'from `article` as a ';
      $sql .= 'left join `comment` as b on a.id = b.article_id  ';
      $sql .= 'inner join `user` as c on a.user_id = c.id ';
      $sql .= $range;
      $sql .= 'group by a.id  ';
      $sql .= 'order by count(b.user_id) desc ';

      $query = $this->db->query($sql);
      $list = array();

      foreach($query->result_array() as $row){
         $list[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'message' => mb_substr($row['message'], 0, 100),
            'comment' => $row['count(b.user_id)']
         );
      }
      return $list;
   }

   private function getRange(){
      $tmp = $this->session->userdata('from');
      $from = $tmp !== false ? $tmp - 1 : 0;
      $tmp = $this->session->userdata('to');
      $to = $tmp !== false ? $tmp + 1: 0;

      $range = ' ';
      if( $from != 0 && $to != 0 ){
         $range = "where a.created_time > $from and a.created_time < $to ";
      }
      return $range;
   }
}
