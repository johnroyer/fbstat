<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cleaner {

   public function jsonClean($in){
      if( !is_array($in) || !array_key_exists('data',$in) ){
         // Not valid data
         return null;
      }

      $articles = $in['data'];
      $out = $this->getArticles($articles);

      return $out;
   }

   private function getArticles($in){
      foreach( $in as $val ){
         $art = array(
            'id' => $val['id'],
            'user' => $val['from'],
            'message' => $val['message'], 
            'link' => array_key_exists('link',$val) ? $val['link'] : '',
            'comment' => $this->getComments( $val['comments'] ),
            'like' => $this->getLikes( $val['likes'] )
         );
         $list[] = $art;
      }
      return $list;
   }

   private function getComments($in){
      if( !array_key_exists('data',$in) ){
         // No comment
         return null;
      }
      $list = $in['data'];
      foreach( $list as $val ){
         $out[] = array(
            'user' => $val['from'],
            'comment' => $val['message']
         );
      }
      return $out;
   }

   private function getLikes($in){
      if( !array_key_exists('data',$in) ){
         // Empty data set
         return null;
      }
      $list = $in['data'];
      foreach( $list as $val ){
         $out[] = $val['id'];
      }
      return $out;
   }

}
