<?php use_helper('mdText'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo __('mdNewsletter_title'); ?></title>
  </head>
  <body style="background:#FFFFFF; margin:0 auto;">
    <table cellpadding="0" cellspacing="0" style="border:none; width:600px; margin:0 auto;">
      <tr>
        <td><?php echo image_tag('/images/newsletter_header.jpg', array('absolute' => true)); ?></td>
      </tr>
      <tr>
        <td style="font-family:Lucida Grande; color:#333333; font-size:13px; margin:10px;">
          <p style="font-family:Lucida Grande; color:#333333; font-size:13px; margin:5px 0 15px 0; font-weight:bold;"><?php echo ucfirst($data['subject']); ?></p>
          
          <p style="font-family:Lucida Grande; color:#333333; font-size:12px; margin:5px 0 15px 0;"><?php echo nl2br($data['content']); ?></p>
        </td>
      </tr>
      <tr>
        <td><?php echo image_tag('/images/newsletter_footer.jpg', array('absolute' => true)); ?></td>
      </tr>
      <tr>
        <td bgcolor="#F0EFEE">
          <p style="color:#939598; text-align:center; font-size:9px;">Este email fue enviado a <a style="color:#DD4B38;" href="mailto:%email%">%email%</a>. Si le ha llegado por error o desea desuscribirse por favor haga click <a style="color:#DD4B38;" href="%unsuscribe_url%">aquí</a> |  www.agrotemario.com</p>
        </td>
      </tr>      
    </table>
  </body>
</html>
