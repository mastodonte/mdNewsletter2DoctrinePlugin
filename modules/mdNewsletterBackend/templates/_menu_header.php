<li class="<?php echo (has_slot('newsletter') ? 'current' : ''); ?>">
  <a href="<?php echo url_for('@md_newsletter_template'); ?>"><?php echo 'Newsletter'; ?></a>
  <ul>
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
