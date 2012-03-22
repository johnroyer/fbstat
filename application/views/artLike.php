<table>
   <tr>
      <td>作者</td>
      <td>讚</td>
      <td>內容</td>
   </tr>

<?php
   foreach($list as $art){   ?>

   <tr>
   <td width="120"><?php echo $art['name']; ?></td>
   <td><?php echo $art['like']; ?></td>
   <td><?php echo $art['message']; ?></td>
   </tr>

<?php  }   ?>

</table>
