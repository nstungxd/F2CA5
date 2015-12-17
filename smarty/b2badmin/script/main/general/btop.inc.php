<table border="0" cellpadding="2" cellspacing="2">
    <tr>
        <td>
		    <?php  if(GetVar('file')	== "ge-backup"){?>
			   <img src="<?php  echo  ADMIN_IMAGES?>tablebackup-icon.gif">
		    <?php  }else{?>	
			  <a href="index.php?file=ge-backup&view=edit&AX=Yes"><img style="border:0px" src="<?php  echo  ADMIN_IMAGES?>tablebackup-icon-IN.gif"></a>
		    <?php  }?>
		  </td>
      <!--<td>
		    <?php  if(GetVar('file')== "ge-source"){?>
			   <img src="<?php  echo  ADMIN_IMAGES?>sourcebackup-icon.gif">
		    <?php  }else{?>	
			   <a href="index.php?file=ge-source&view=edit&AX=Yes"><img style="border:0px" src="<?php  echo  ADMIN_IMAGES?>sourcebackup-icon-in.gif"></a>
		    <?php  }?>
		</td>-->
    <td>
		    <?php  if(GetVar('file')== "ge-fullbkup"){?>
			 <img src="<?php  echo  ADMIN_IMAGES?>fullbackup-icon.gif">
		    <?php  }else{?>	
			 <a href="index.php?file=ge-fullbkup&view=edit&AX=Yes"><img  style="border:0px" src="<?php  echo  ADMIN_IMAGES?>fullbackup-icon-in.gif"></a>
		  <?php  }?>
		</td>
    <!--
     <td>
		<?php  if(GetVar('file')== "ge-restore"){?>
			<img src="<?php  echo  ADMIN_IMAGES?>restorebackup-icon.gif">
		<?php  }else{?>	
			<a href="index.php?file=ge-restore&view=edit&AX=Yes"><img src="<?php  echo  ADMIN_IMAGES?>restorebackup-icon-in.gif"style="border:0px"></a>
		<?php  }?></td>
    -->
    </tr>
</table>