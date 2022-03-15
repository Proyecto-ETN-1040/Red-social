# Red Social Acad�mica
***
Gu�a para hacer correr el programa.
***

### Programas necesarios para el correcto funcionamiento de la aplicaci�n.
***
1. **WampServer**
   - Ir a la pagina => https://www.wampserver.com
   - Seleccionar la opci�n DOWNLOAD.
   - Escoger el tipo de procesador de la maquina donde se instalara(32 o 64 bits), y 
     aparecera un formulario.
   - Para el correcto funcionamiento debe asegurarse de tener instalado los Visual C++
     necesarios para su ordenador, para ello dirigirse al 2do WARNING que se encuentra
     en la parte baja del formulario y abrir en una nueva ventana el link mostrado.
   - En la nueva ventana presionar el boton DOWNLOAD, y seleccionar los tres archivos que se
     muestra en pantalla, y presionar NEXT, se descargaran estos archivos y proceda a 
     instalarlos.
   - Una vez instalados estos programas, volver a la primera ventana y dirigirse a la parte
     superior del formulario y presionar la opcion => you can download it directly.
   - Se abrira una nueva interfaz y se descargara WampServer automaticamente.
   - Ir al archivo descargado y ejecutar como administrador para poder instalarlo.
   - Proceda a instalar dando Next en las ventanas sin cambiar los valores por defecto.
   - Una vez instalado aparecera dos recuadros, en el cual el primer recuadro indica si quiere 
     cambiar el buscador por defecto y el segundo recuadro indica si quiere a�adir un editor
     de texto para Wamp, preferentemente darno No en estas opciones (Si lo desea puede agregar
     un buscador y editor de texto de su preferencia).
   - Con esto se completa la instalacion, dar Next y Finish.
   - Para encender el servidor local haga doble click en el icono de WampServer, y empezaran a
     iniciarse los servicios de WampServer, en la barra de tareas aparecera un icono rojo, cuando
     este icono este en verde significa que todos los servicios de WampServer esta funcionando
     correctamente(este paso es necesario cada vez que encienda su ordenador)

### Instalar la aplicaci�n en WampServer
***
1. **Codigo del Proyecto**
   - Para poder ejecutar el codigo del proyecto este debe estar en una carpeta espec�fica, para
     ello copiar la carpeta 'redso' que descargo junto con este archivo en la siguiente direcci�n
     de su ordenador => C:\wampXX\www (XX sera 32 o 64 dependiendo el wamp que descarg�).

2. **Base de Datos**
   - En el buscador de su preferencia coloque la siguiente direccion => 
     http://localhost/phpmyadmin/
   - Se abrira la interfaz de phpmyadmin, que es el gestor de BBDD, en Usuario poner root y dejar
     la contrase�a vac�a y presionar Continuar, se abrira el gestor de BBDD.
   - Crear una nueva BBDD con el nombre 'redsocial_db' y con cotejamiento 'utf8_unicode_ci',
     presionar el boton 'Crear'.
   - En la barra de opciones presionar la opci�n 'Importar' y se vera una nueva interfaz.
   - Presionar la opci�n 'Seleccionar archivo' y escoger el archivo 'redsocial_db' que descarg�
     junto con este archivo.
   - En la secci�n de formato asegurese que esta con la opci�n 'SQL'.
   - Finalmente presionar el boton 'Continuar' y con esto se cargar� la BBDD.

### Ejecutar la aplicaci�n
***
   - En el buscador de su preferencia, coloque lo siguiente: => localhost/redso
     con esto se abrira la aplicaci�n, mostrado la pantalla de Inicio de Sesi�n.
   - Para acceder dentro de la Red Social puede ingresar con el usuario de prueba:
     Usuario : usuarioprueba
     Contrase�a : usuario123
     Poniendo los datos anteriores podra ingresar al sistema.
   - Finalmente para que el servicio de mensajer�a funcione abra la consola de su ordenador(cmd)
     y copie la instrucci�n 'cd/wampXX/www/redso' (Recuerde cambiar XX).
   - Finalmente copie la instrucci�n 'php bin/server.php' y pulse ENTER, con esto el servidor
     estar� iniciado para el servicio de mensajer�a. 


