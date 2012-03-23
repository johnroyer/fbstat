<table>
   <tr>
      <td>作者</td>
      <td>回覆數</td>
      <td>文章</td>
   </tr>

<?php
   foreach($list as $row){   ?>

   <tr>
   <td width="120"><?php echo $row['name']; ?></td>
   <td><?php echo $row['comment']; ?></td>
   <td><?php echo $row['message']; ?></td>
   </tr>

<?php  }   ?>

</table>
