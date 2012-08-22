<div style="display:none">
  <div id="suscribers_import_form">
    <h1>Importar Usuarios</h1>
    <hr />
    <p>Seleccione el archivo y luego presione Importar.</p>
    <p>Importante! Las extension permitida es: .xls</p>
    
    <form enctype="multipart/form-data" method="POST" action="<?php echo url_for('mdSubscriberBackend/importar'); ?>"><br />
      <input type="file" name="suscribers_import" />
      <input type="submit" value="Importar" />
    </form>
    <br />
    <hr />
  </div>
</div>
