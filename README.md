Integrantes (Grupo 29): Lautaro Lopez - Inti Derose

El proyecto se trata de una librería/biblioteca con libros, autores y usuarios que administran la pagina pudiendo tanto subir, editar y eliminar libros como asi tambien autores. 
La relación de 1 a N esta dada mediante la ID de autores que se conectan con sus libros, donde cada autor puede tener 1 o N libros, pero un libro solo puede tener un autor. 

Importar la DB:
Es la mima DB que en la entrega anterior. Importar el archivo 'db_libreria.sql' dentro de PHPMyAdmin para tener la base de datos completa. Si la base no existe se creara y se llenara con datos iniciales automáticamente gracias al auto-deploy.


--API REST--

Autores:
Cuando se muestran los datos se hace en forma de un arreglo de JSON. 

http://localhost/LibreriaTPE-API-REST/api/autores (GET) al llamar a la funcion "getAll" se trae una lista con todos los autores de la DB. Se le pueden aplicar 2 parametros, orderBy (Premiaciones y FechaNacimiento) que ademas se le puede pedir ascendentemente o descendentemente y filtrar por Genero Destacado.
Ejemplo de ordenado - http://localhost/LibreriaTPE-API-REST/api/autores?orderBy=FechaNacimiento&sort=desc
Ejemplo de filtrado - http://localhost/LibreriaTPE-API-REST/api/autores?GeneroDestacado="Terror"

http://localhost/LibreriaTPE-API-REST/api/autores/:id (GET) al llamar a la funcion "get" se trae al autor indicado por el id (/autores/:id) 
Ejemplo de traer uno por id - http://localhost/LibreriaTPE-API-REST/api/autores/4

http://localhost/LibreriaTPE-API-REST/api/autores/:id (DELETE) al llamar a la funcion "delete" se elimina el autor con el id pasado, en caso de no existir dicho autor se manjea de forma correcta el codigo de error 404, mostrando un mensaje al usuario. Al eliminar un autor (con libros) se realiza un eliminacion en cascada.
Ejemplo de eliminar un autor - http://localhost/LibreriaTPE-API-REST/api/autores/1

http://localhost/LibreriaTPE-API-REST/api/autores (POST) al llamar a la funcion "create" se crea un nuevo autor, para ello se pide completar todos los datos necesarios:
{
  "Nombre": "nombre del autor",
  "Premiaciones": 12,
  "GeneroDestacado": "nombre del genero",
  "FechaNacimiento": "YYYY/MM/DD"
}

http://localhost/LibreriaTPE-API-REST/api/autores/:id (PUT) al llamar a la funcion "update" se actualiza en la DB el autor con el id enviado. Solo se pueden modificar GeneroDestacado y Premiaciones.
Ejemplo de editar un autor - http://localhost/LibreriaTPE-API-REST/api/autores/2 (se deben enviar los siguientes datos)
{
  "Premiaciones": 9,
  "GeneroDestacado": "nombre del genero actualizado"
}


Libros:
Cuando se muestran los datos se hace en forma de un arreglo de JSON. 

http://localhost/LibreriaTPE-API-REST/api/libros (GET) al llamar a la funcion "getAll" se trae una lista con todos los libros de la DB. Se le pueden aplicar 3 parametros, orderBy (Titulo, Autor, Genero, CantidadPaginas y Editorial) que ademas se le puede pedir ascendentemente o descendentemente, tambien se puede filtrar por Autores y se puede pedir la paginacion eligiendo un limite de libro por pagina (por defecto muestra la lista entera de libros sin paginar)
Ejemplo de ordenado - http://localhost/LibreriaTPE-API-REST/api/libros?orderBy=Genero&sort=desc
Ejemplo de filtrado - http://localhost/LibreriaTPE-API-REST/api/libros?Autor=4
Ejemplo de paginacion - http://localhost/LibreriaTPE-API-REST/api/libros?limit=2&page=4

http://localhost/LibreriaTPE-API-REST/api/libros/:id (GET) al llamar a la funcion "get" se trae al libro indicado por el id (/libros/:id) 
Ejemplo de traer uno por id - http://localhost/LibreriaTPE-API-REST/api/libros/4

http://localhost/LibreriaTPE-API-REST/api/libros/:id (DELETE) al llamar a la funcion "delete" se elimina el libro con el id pasado, en caso de no existir dicho libro se manjea de forma correcta el codigo de error 404, mostrando un mensaje al usuario.
Ejemplo de eliminar un autor - http://localhost/LibreriaTPE-API-REST/api/libros/9

http://localhost/LibreriaTPE-API-REST/api/libros (POST) al llamar a la funcion "create" se crea un nuevo libro, para ello se pide completar todos los datos necesarios:
{
  "title": "nombre del libro",
  "author": 1,   (:ID DEL AUTOR)
  "pages": 230,
  "gender": "nombre del genero",
  "publisher": "nombre de la esditorial"
}

http://localhost/LibreriaTPE-API-REST/api/libros/:id (PUT) al llamar a la funcion "update" se actualiza en la DB el libro con el id enviado. Solo se pueden modificar GeneroDestacado y Premiaciones.
Ejemplo de editar un autor - http://localhost/LibreriaTPE-API-REST/api/libros/13 (se deben enviar los siguientes datos)
{
  "title": "nombre actualiazado del libro",
  "author": 4, 
  "pages": 169,
  "gender": "nombre actualizado del genero",
  "publisher": "nombre actualizado de la esditorial"
}