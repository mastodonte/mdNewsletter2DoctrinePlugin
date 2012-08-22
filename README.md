mdNewsletter2DoctrinePlugin
===========================

Advanced management newsletter

--------------------
Instalacion Backend
--------------------
1- Habilitar modulos en el settings del backend: mdNewsletterLogBackend, mdSubscriberBackend, mdNewsletterTemplateBackend, mdQueueBackend

2- Para incluir el menu del backend incluir en el _header.php de la aplicacion: <?php include_partial('mdNewsletterBackend/menu_header'); ?>

3- Instalar el cron que realiza los envios: */10 * * * * /usr/local/bin/php /home/mastodonte/symfony mdNewsletter:observer

	Con esta configuracion se envian 80 emails cada 10 minutos o sea que se envian 480/hora.
	Estos parametros dependen mucho de las limitaciones que tenga el servidor de correo configurado.

	El valor 80 esta harcoded en el task.

4- Si se quiere agregar un nuevo template de email se debera:

	4.1- Extender la clase de el formulario BasemdNewsletterTemplateForm cuyo nombre sera: $nombreTemplate . 'Form'

	4.2- Crear archivo con el formulario de creacion de nombre '_form_' . $nombreTemplate en el modulo mdNewsletterTemplateBackend

	4.3- Crear archivo con el template del newsletter de nombre '_template_' . $nombreTemplate en el modulo mdNewsletterMailing

	4.4- Customizar el template _selector_templates.php segun aplicacion que se encuentra en el modulo mdNewsletterTemplateBackend

NOTAS:

1- Se debe tener un archivo llamado newsletter_header.jpg y uno newsletter_footer.jpg ambos contienen
		el header y footer de los newsletter comunes: 2.1, 2.2
   
		- Ambos deben estar en la carpeta images de la aplicacion, no de el modulo de newsletter.
		- Es importante que la extension sea .jpg de lo contrario puede que la imagen no se muestre.

2- Configurar las siguientes variables en el app.yml

all:

  observer:

    taskSymfonyUrl: http://symfony/

    taskFrontendUrl: http://www.example.com/

		Utilizadas para los links de unsuscribe del footer que se genera en el momento de hacer el envio segun destinatario
		Se aconseja ver "que agrega symfony" cuando se realiza url_for en un task y sustituirlo en taskSymfonyUrl

  domain:

    url: www.example.com

		Nombre de dominio sin "http://" usado para colocar links en los templates de newsletter


3- En forma predeterminada existen 3 templates distintos:

     3.1- Template con las ultimas noticias

     3.2- Template basico con titulo y cuerpo

     3.3- Template avanzado con imagenes para header, footer y body

--------------------
Instalacion Frontend
--------------------
1- Se debera incluir el siguiente componente: include_component('mdNewsletterFrontend', 'register');

--------------------
TODO
--------------------
Crear listas de emails

--------------------
Autor: Gaston Caldeiro

Email: chugas488@gmail.com

