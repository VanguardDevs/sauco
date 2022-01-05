# SAUCO

![logo](https://github.com/jodaz/sauco/blob/main/docs/sauco_logo.png?raw=true)

## Requisitos de instalación

- PHP ^8.0
- Composer ^2.1 
- Apache2 ^2.4
- NodeJS ^14.17.6
- Architectura 64bit

## Estructura del proyecto

```
- docs: Documentos
- packages
---- backend: Servidor principal
---- dashboard: Frontend de la app interna de recaudación interna.
---- common: paquetes comunes para todas las React Apps
---- maintenance: scripts de mantenimiento para la base de datos
---- sirim: Sistema Legacy
```

## Instalación

### Backend Y Legacy

1. Acceder al directorio del proyecto según sea el caso `/packages/backend`, `/packages/sirim`
2. Instalar dependencias con `composer install`
3. Corregir las variables de entorno usando el `.env.example`
4. Correr las migraciones `php artisan migrate --seed`. Esto generará una base de datos limpia

### Frontend

1. Instalar las dependencias con `yarn install`
2. Para la compilación, corregir las variables de entorno ubicadas en cada app
    - `.env.local` para el desarrollo
    - `.env.production.local` en producción

### Maintenance

Revisar [README](https://github.com/jodaz/sauco/tree/main/packages/maintenance#readme)

## Contribuidores

- [jodaz](https://github.com/jodaz)
- [ELNOOB3100](https://github.com/ELNOOB3100)
- [Papelonin](https://github.com/Papelonin)
