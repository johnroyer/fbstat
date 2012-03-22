<?php

class ArticleStat extends CI_Model {

   public function __contruct(){
      parent::__contruct();
   }

   public function byLike(){
      $sql  = 'select a.id, a.message, count(b.user_id), c.name ';
      $sql .= 'from `article` as a  ';
      $sql .= 'left join `like` as b on a.id = b.article_id  ';
      $sql .= 'inner join `user` as c on a.user_id = c.id ';
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
      $sql  = 'select a.id, a.message, count(b.user_id), c.name ';
      $sql .= 'from `article` as a ';
      $sql .= 'left join `comment` as b on a.id = b.article_id  ';
      $sql .= 'inner join `user` as c on a.user_id = c.id ';
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
}
