...existing code...
# Requisitos funcionales — Gamelog

## Resumen
Al abrir la web mostraré todos los artículos de forma pública. Solo los usuarios autenticados podrán insertar, editar o eliminar artículos. El resto de usuarios  solo podrá ver los artículos.

## Navegación principal
- En la página principal ofreceré opciones para:
  - Iniciar sesión (login)
  - Registrarse (registro)

## Flujo de autenticación y permisos
1. Mostraré artículos públicamente para todos.
2. Si el usuario inicia sesión:
   - Le permitiré ver y editar únicamente sus propios artículos.
3. Si el usuario no inicia sesión:
   - Solo tendrá lectura de artículos (sin opciones de insertar/editar/eliminar).

## Registro e inicio de sesión
- Crearé formulario de registro y formulario de inicio de sesión que persistan datos en una base de datos.
- Al registrar:
  - Comprobaré si el usuario ya existe.
  - Pediré la contraseña dos veces y validaré que coincidan.
  - Validaré la fortaleza de la contraseña (ver requisitos abajo).
  - Guardaré la contraseña de forma segura (hash).
  - Mantendré los datos del formulario si hay errores (repoblar campos).
- Al iniciar sesión:
  - Comprobaré si el usuario existe.
  - Verificaré la contraseña almacenada con hash.

## Validaciones y seguridad
- Validaré la existencia del usuario en ambos casos (login y registro).
- contraseñas:
  - hashing seguro (password_hash / password_verify).
  - Requisitos mínimos (ejemplo):
    - Mínimo 8 caracteres
    - Al menos una letra
    - Al menos un número
    - Al menos un carácter especial
- Manejaré errores claros y mostraré todos los mensajes de validación al usuario.
- Evitaré mostrar información sensible en los mensajes de error.

## Sesiones y cookies
- Mantendré la sesión de usuario activa al menos 40 minutos tras autenticación.
- Usaré sesiones para controlar autenticación y permisos en el servidor.
- Evaluaré el uso de cookies para:
  - "Recordarme" (persistencia opcional, con token seguro).
  - No almacenar información sensible en cookies.
- Consideraré renovación de sesión/expiración y protección contra secuestro de sesión.

## UX / Mensajes
- Mostraré en el formulario de registro:
  - Los requisitos de la contraseña.
  - Errores de validación (lista completa).
- Repoblaré campos del formulario si el registro falla.

## Checklist (acción)
- [X] Crear formularios: login y registro (HTML + validaciones cliente/servidor).
- [X] Implementar pdo-usuario.php con:
  - registro (hashing)
  - autenticación (password_verify)
- [X] Validaciones en servidor en `/model/verificacion.php`.
- [/] Mostrar errores en las vistas y repoblar campos.
- [ ] Control de sesiones (40 min) y opción "recordarme" segura.
- [ ] Permisos en la capa de negocio para CRUD de artículos (solo autor puede editar/eliminar).
- [ ] Pruebas manuales y casos de aceptación.

## Casos de aceptación
- Puedo registrarme con contraseña que cumple requisitos y ver mi sesión iniciada.
- No puedo registrarme si el nombre ya existe.
- Si estoy autenticado puedo editar solo mis propios artículos.
- Un usuario anónimo solo puede ver artículos.
- Errores de validación se muestran claramente y todos juntos en el formulario.