<h1>TudaiWeb2Tpe2023</h1>

<h2>Facultad de Ciencias Exactas | Universidad Nacional del Centro de la Provincia de Buenos Aires</h2>

<h3>Tecnicatura Universitaria en Desarrollo de Aplicaciones Informáticas</h3>

<h4>Trabajo Práctico Especial realizado de manera colaborativa entre Echazú, Candela Azul y Fernández, Daniela Antonella para la materia Web II.</h4>

<h2>Endpoints</h4>

<h4>GET /user/token</h4>
<p>Este Endpoint se utiliza para obtener un Token de acceso para realizar las consultas Token Protected [TP].</p>

*Ejemplo:* http://localhost/carpeta/subcarpeta/api/user/token

<p>Mediante la pestaña de Autorización, seleccionar Autorización Básica (Basic Auth) y completar los campos de Usuario (webadmin) y Contraseña (admin).</p>

<p>Si los datos ingresados son correctos, se obtendrá un Token de acceso.</p>

<p>Para realizar las consultas y modificaciones [TP] - Mediante la pestaña de Autorización, seleccionar Bearer Token y completar el campo Token con el Token de acceso obtenido, sin agregar la palabra Bearer.</p>

<h4>GET /libros</h4>
<p>Este Endpoint devuelve la lista de libros de la base de datos dentro de la tabla "books".</p>

*Ejemplo:* http://localhost/carpeta/subcarpeta/api/libros

<p>Puede recibir distintas opciones parametrizadas:</p>

<p>Parámetros de ordenamiento:</p>
<ul>
  <li>?sort_by: Este parámentro recibe un String y devuelve una lista con todos los libros ordenados por dicho campo, si el parámetro no está definido o el campo no existe, su valor por defecto es id_book.</li>
  <li>?order: Este parámetro recibe un número de tipo Integer y ordena de manera descendente (0) o ascendente (1), si el parámetro no está definido o el número ingresado no es válido, su valor por defecto es 1.</li>
</ul>

*Ejemplo:* http://localhost/carpeta/subcarpeta/api/libros?sort_by=title&order=0

<p>Parámetros de paginado:</p>
<ul>
  <li>?page: Este parámentro recibe un número de tipo Integer e indica la página que se quiere recuperar, si el parámetro no está definido o el número ingresado no es válido, su valor por defecto es 1.</li>
  <li>?per_page: Este parámetro recibe un número de tipo Integer que define la cantidad de elementos contenidos en cada página, si el parámetro no está definido o el número ingresado no es válido, su valor por defecto es 10.
</ul>

*Ejemplo:* http://localhost/carpeta/subcarpeta/api/libros?page=1&per_page=10

<h4>GET /libros/:ID</h4>
<p>Este Endpoint devuelve el libro con el ID indicado.</p>

*Ejemplo:* http://localhost/carpeta/subcarpeta/api/libros/21

<h4>GET /libros/autor/:ID_A</h4>
<p>Este Endpoint filtra los libros por la ID del autor y devuelve todos los que pertenecen al mismo.</p>

*Ejemplo:* http://localhost/carpeta/subcarpeta/api/libros/autor/1


<h4>POST /libros [TP]</h4>
<p>Este Endpoint crea un nuevo recurso luego de recibir un objeto JSON en el body del HTTP Request.</p>

*Ejemplo:* http://localhost/carpeta/subcarpeta/api/libros

```json
{
    "title": "Libro",
    "publication_date": 2023,
    "id_author": 1,
    "synopsis": "Soy una sinopsis"
}
```

<h4>PUT /libros/:ID [TP]</h4>
<p>Este Endpoint actualiza un recurso luego de recibir un objeto JSON en el body del HTTP Request.</p>

*Ejemplo:* http://localhost/carpeta/subcarpeta/api/libros/62

```json
{
    "id_book": 62,
    "title": "Libro",
    "publication_date": 2023,
    "id_author": 1,
    "synopsis": "Soy una sinopsis actualizada"
}
```
