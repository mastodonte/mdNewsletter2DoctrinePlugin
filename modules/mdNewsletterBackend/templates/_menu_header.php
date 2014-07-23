<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Newsletter <b class="caret"></b></a>
  <ul class="dropdown-menu">
    <div id='triangle'></div>
      <li>
        <a href="<?php echo url_for('@md_newsletter_template'); ?>">Templates</a>
      </li>
      <li>
        <a href="<?php echo url_for('@md_newsletter_subscriber'); ?>">Suscriptos</a>
      </li>
      <li>
        <a href="<?php echo url_for('@md_newsletter_queue'); ?>">Envios</a>
      </li>
      <li>
        <a href="<?php echo url_for('@md_newsletter_log'); ?>">Logs</a>
      </li>            
  </ul>
</li>