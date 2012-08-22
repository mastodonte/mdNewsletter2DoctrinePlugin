<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo __('mdNewsletter_title'); ?></title>
</head>

<body>
<table width="800" border="0" cellspacing="5" cellpadding="5" style="background-color:#FFFFFF; margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;">
  <tr>
    <th scope="col">
      <a href="<?php echo __('mdNewsletter_url del sitio'); ?>" target="_top">
        <?php echo image_tag('/uploads/newsletter/pic_header_' . $object->getId() . '.jpg', array('absolute' => true, 'border' => '0')); ?>
      </a>
    </th>
  </tr>
  <tr>
    <td style="text-align: center;font-family: Verdana, Geneva, sans-serif; font-size: 28px;"">
        <?php echo nl2br($data['mdFirstEmbedTemplate']['copete_header']); ?>
    </td>
  </tr>
  <tr>
    <td>
      <?php echo image_tag('/uploads/newsletter/pic_body_' . $object->getId() . '.jpg', array('absolute' => true)); ?>
    </td>
  </tr>
  <tr>
    <td style="text-align: center; font-family: Verdana, Geneva, sans-serif; font-size: 28px;">
        <?php echo nl2br($data['mdFirstEmbedTemplate']['copete_footer']); ?>
    </td>
  </tr>
  <tr>
    <td>
      <?php echo image_tag('/uploads/newsletter/pic_footer_' . $object->getId() . '.jpg', array('absolute' => true)); ?>
    </td>
  </tr>
  <tr>
    <td bgcolor="#F0EFEE">
      <p style="color:#939598; text-align:center; font-size:9px;">Este email fue enviado a <a style="color:#DD4B38;" href="mailto:%email%">%email%</a>. Si le ha llegado por error o desea desuscribirse por favor haga click <a style="color:#DD4B38;" href="%unsuscribe_url%">aquí</a> |  www.agrotemario.com</p>
    </td>
  </tr>
</table>
</body>
</html>
