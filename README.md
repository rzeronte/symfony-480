- [Instalacion](#instalación)
- [Makefile](#makefile)
- [Custom commands](#custom-commands)
- [Documentación](#documentación)
- [Reporte cobertura](#documentación)
- [Usuario de pruebas](#usuario-de-pruebas)

---

# Instalación

```
mkdir symfony-480
cd symfony-480
git clone https://github.com/rzeronte/symfony-480.git .
make build
make up
make reset-app
```

---

# Makefile

La aplicación dispone de un `Makefile` que permitirá interactuar con la aplicación:

![Descripción de la imagen](./doc/screenshoot_makefile.png)

---

# Reset de la aplicación

Si deseamos resetear la aplicación a un estado inicial:
```
make reset-app
```

Este comando ejecutará en orden los siguientes:

- `make reset-db`: Resetea BBDD y lanza migraciones
- `make jwt-generate-keypair`: Genera los secretos para JWT
- `make load-fixtures`: Carga de fixtures
- `make test`: Lanza los tests
- `make coverage`: Genera reporte de coverage
- `make php-cs-fixer`: Lanza linter con autofix
- `make phpstan`: Lanza analizador estático

---

# Custom commands

Disponemos de una serie de comandos personalizados para la aplicación:

1) `` make reset-db``

![Descripción de la imagen](./doc/screenshoot_reset_database.png)

---

2) `` make jwt-generate-keypair``

![Descripción de la imagen](./doc/screenshoot_jwt.png)

---
3) `` make load-fixtures``

![Descripción de la imagen](./doc/screenshoot_load_fixtures.png)

---

4) `` make test``

![Descripción de la imagen](./doc/screenshoot_unittest.png)

---

5) `` make coverage``

![Descripción de la imagen](./doc/screenshoot_cli_coverage.png)

---

6) `` make php-cs-fixer``

![Descripción de la imagen](./doc/screenshoot_csfixer.png)

---

7) `` make phpstan``

![Descripción de la imagen](./doc/screenshoot_phpstan.png)

# Documentación

La aplicación ofrece la documentación a través del endpoint `api/docs`.

![Descripción de la imagen](./doc/screenshoot_swagger.png)

---

# Reporte cobertura

En la carpeta `report` se puede encontrar en formato HTML el reporte de covertura.

![Descripción de la imagen](./doc/screenshoot_coverage.png)

---

# Usuario de pruebas

Aunque podréis registrar un nuevo usuario si quereis. Se incluye uno en fixtures para pruebas

- email: `dev@testing.com` 
- password: `password`

![Descripción de la imagen](./doc/screenshoot_usertest.png)
