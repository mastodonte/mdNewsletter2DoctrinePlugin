<?php sfContext::getInstance()->switchTo('frontend'); ?>

<?php use_helper('Date'); ?>

<?php $count = $noticias->count(); ?>
<?php $limit = ceil($count / 2); ?>

<?php $data = $noticias->getRawValue()->getData(); ?>

<?php $column_one = array_slice($data, 0, $limit); ?>
<?php $column_two = array_slice($data, $limit); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo __('mdNewsletter_title'); ?></title>
  </head>

  <body>

    <table border="0" cellpadding="0" cellspacing="0" width="814">
      <tbody>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3" style="border-bottom:1px solid #258957;" height="73">
            <?php echo image_tag('/images/logo-agrotemario.png', array('absolute' => true, 'size' => '310x42')); ?>
            <p style="font-size: 35px; font-weight: bold; margin: 5px 0 0 25px;; float: left;">/</p>
            <p style="font-size: 24px; font-weight: bold; margin:12px 0 0 5px; float: left;">Las noticias más relevantes de la semana</p>
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="689" width="18">&nbsp;</td>
          <td valign="top" width="358">
          <?php $i = 1; ?>
          <?php foreach($column_one as $noticia): ?>

            <?php $instance = mdMediaManager::getInstance(mdMediaManager::MIXED, $noticia)->load('galeria'); ?>
            
            <div style="float: left; <?php echo ($i % 2 == 0 ? 'background: none repeat scroll 0% 0% rgb(235, 233, 233);' : ''); ?> margin-top: 10px; border-bottom: 1px solid #1D1D1B">
              <?php echo image_tag($instance->getAvatarUrl('galeria', array(mdWebOptions::WIDTH => '101', mdWebOptions::HEIGHT => '101', mdWebOptions::CODE => mdWebCodes::CROPRESIZE)), array('absolute' => true, 'size' => '101x101', 'style' => 'float: left; margin: 5px;')); ?>
              
              <p style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; margin-bottom:0px; float: left; margin-left:5px; font-size:13px; color:#258957; width: 200px;"><?php echo $noticia->getTitle(); ?></p>

              <p style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-style:italic; color:#666666; margin-left:5px; float: left; margin-top:0px;"><?php echo format_date($noticia->getPublish(), 'dd/MM/yyyy', 'es'); ?></p>
              
              <p style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; color: rgb(68, 68, 69); margin-left: 5px; float: left; margin-top: 0px; width: 240px;"><?php echo $noticia->getCopete(); ?>&nbsp;<a href="<?php echo url_for('@noticia?id=' . $noticia->getId() . '&slug=' . $noticia->getSlug(), true); ?>" style="color:#444445; text-decoration:none;">[ + ]</a></p>
            </div>
          <?php $i++; ?>
          <?php endforeach; ?>
          </td>

          <td width="60">&nbsp;</td>
          <?php $i = 1; ?>
          <td valign="top" width="358">
          <?php foreach($column_two as $noticia): ?>

              <?php $instance = mdMediaManager::getInstance(mdMediaManager::MIXED, $noticia)->load('galeria'); ?>

              <div style="float: left; <?php echo ($i % 2 == 0 ? 'background: none repeat scroll 0% 0% rgb(235, 233, 233);' : ''); ?> margin-top: 10px; border-bottom: 1px solid #1D1D1B">
                <?php echo image_tag($instance->getAvatarUrl('galeria', array(mdWebOptions::WIDTH => '101', mdWebOptions::HEIGHT => '101', mdWebOptions::CODE => mdWebCodes::CROPRESIZE)), array('absolute' => true, 'size' => '101x101', 'style' => 'float: left; margin: 5px;')); ?>

                <p style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; margin-bottom:0px; float: left; margin-left:5px; font-size:13px; color:#258957; width: 200px;"><?php echo $noticia->getTitle(); ?></p>

                <p style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-style:italic; color:#666666; margin-left:5px; float: left; margin-top:0px;"><?php echo format_date($noticia->getPublish(), 'dd/MM/yyyy', 'es'); ?></p>

                <p style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; color: rgb(68, 68, 69); margin-left: 5px; float: left; margin-top: 0px; width: 240px;"><?php echo $noticia->getCopete(); ?>&nbsp;<a href="<?php echo url_for('@noticia?id=' . $noticia->getId() . '&slug=' . $noticia->getSlug(), true); ?>" style="color:#444445; text-decoration:none;">[ + ]</a></p>
              </div>
          <?php $i++; ?>
          <?php endforeach; ?>
          </td>
          <td width="20">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#F0EFEE">&nbsp;</td>
          <td colspan="3" bgcolor="#F0EFEE">
            <p style="color:#939598; text-align:center; font-size:9px;">Este email fue enviado a <a style="color:#DD4B38;" href="mailto:%email%">%email%</a>. Si le ha llegado por error o desea desuscribirse por favor haga click <a style="color:#DD4B38;" href="%unsuscribe_url%">aquí</a> |  www.agrotemario.com</p>
          </td>
          <td bgcolor="#F0EFEE">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
<?php sfContext::getInstance()->switchTo('backend'); ?>
