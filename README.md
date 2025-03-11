## Descripción General de la API

Esta API permite la autenticación y gestión de usuarios registrados.

## Pasos para iniciar

1. Clonar el repositorio.
2. Iniciar el servidor con el comando:
    ```bash
    php artisan serve
    ```
3. Crear la base de datos:
    ```sql
    CREATE DATABASE inventario;
    ```
4. Importar la base de datos desde el archivo `inventario.sql` ubicado en la carpeta `database`.

## Base URL

Servidor local de desarrollo: `http://localhost/api`

## Documentación Adicional

Puedes encontrar la documentación completa de la API en SwaggerHub: [Documentación de la API](https://app.swaggerhub.com/apis-docs/juansebastianparadac/inventario/1.0.0)

openapi: 3.0.0
info:
  title: Laravel API
  description: API de Laravel documentada con Swagger
  version: 1.0.0
servers:
  - url: http://localhost/api
    description: Servidor local de desarrollo

paths:
  /login:
    post:
      summary: Iniciar sesión
      description: Autentica a un usuario y devuelve un token JWT
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                email:
                  type: string
                  example: user@example.com
                password:
                  type: string
                  example: password123
      responses:
        '200':
          description: Inicio de sesión exitoso
          content:
            application/json:
              schema:
                type: object
                properties:
                  token:
                    type: string
        '401':
          description: Credenciales incorrectas

  /usuarios:
    get:
      summary: Obtener todos los usuarios
      description: Retorna una lista de usuarios registrados
      responses:
        '200':
          description: Lista de usuarios obtenida con éxito
          content:
            application/json:
              schema:
                type: array
                items:
                  $ref: '#/components/schemas/User'
    post:
      summary: Crear un nuevo usuario
      description: Registra un nuevo usuario en la base de datos
      requestBody:
        required: true
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/User'
      responses:
        '201':
          description: Usuario creado con éxito

  /usuarios/{id}:
    get:
      summary: Obtener un usuario por ID
      description: Retorna los datos de un usuario específico
      parameters:
        - name: id
          in: path
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: Datos del usuario obtenidos con éxito
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/User'
    put:
      summary: Actualizar un usuario
      description: Modifica los datos de un usuario existente
      parameters:
        - name: id
          in: path
          required: true
          schema:
            type: integer
      requestBody:
        required: true
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/User'
      responses:
        '200':
          description: Usuario actualizado con éxito
    delete:
      summary: Eliminar un usuario
      description: Elimina un usuario de la base de datos
      parameters:
        - name: id
          in: path
          required: true
          schema:
            type: integer
      responses:
        '204':
          description: Usuario eliminado con éxito

components:
  schemas:
    User:
      type: object
      properties:
        id:
          type: integer
          example: 1
        name:
          type: string
          example: Juan Pérez
        email:
          type: string
          example: user@example.com
        password:
          type: string
          example: password123

