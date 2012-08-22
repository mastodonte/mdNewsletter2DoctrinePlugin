<?php
header('Content-type: application/vnd.ms-excel; charset=UTF-8');
header("Content-Disposition: attachment; filename=newsletter_users.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<html>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <body>

    <h1>Listado de emails - <?php echo date('d/m/Y'); ?></h1>

    <table cellspacing="0" cellpadding="0">
      <?php foreach ($records as $record): ?>
        <tr>
          <td><?php echo $record['email']; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    
  </body>
</html>
