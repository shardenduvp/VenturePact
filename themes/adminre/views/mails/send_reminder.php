Hi <?php echo $data[1]['client_name']; ?>,<br /><br />

Just a reminder that you have a pending invoice of Amount: $<?php echo $data[0]['amount'] ?> against the Module: <?php echo $data[0]['module'] ?> for the project <?php echo $data[1]['project_name']; ?>.
<br /><br />
Feel free to <a href="<?php echo Yii::app()->createAbsoluteUrl('site/call');?>">Schedule a call</a> if you need any assistance. <br /><br />


All the best!<br />
VenturePact Team	