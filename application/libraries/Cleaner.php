<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cleaner {

   public function jsonClean($in){
      if( !is_array($in) || !array_key_exists('data',$in) ){
         // Not valid data
         return null;
      }

      $articles = $in['data'];

      return $articles;
   }

   private function getLikes($in){
      $list = $in['data'];
      foreach( $in as $val ){
         $out[] = $val['id'];
      }
      return $out;
   }

}
