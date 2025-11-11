<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Gamelog</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <nav>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="view-login.php" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                                aria-current="page">
                                Login
                            </a>
                            <a href="view-register.php"
                                class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                                Register
                            </a>
                            <a href="../juego/view-juego.php"
                                class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                                Juegos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </nav>
    <?php
    session_start();
    if (isset($_SESSION['register_error'])) {
        foreach ($_SESSION['register_error'] as $error) {
            echo "<p class='text-red-500 text-center'>$error</p>";
        }
        unset($_SESSION['register_error']);
    }
    ?>
    <form action="../../controller/login/controller-register.php" method="post" accept-charset="UTF-8"
        class="max-w-sm mx-auto">
        <div class="mb-5">
            <h1 class="block mb-2 text-2xl font-bold text-gray-900 light:text-black">Registrar Usuario</h1>
        </div>

        <div class="mb-5">
            <label for="usuario" class="block mb-2 text-sm font-medium text-gray-900 light:text-black">Usuario</label>
            <input value="<?php echo $_SESSION["ultimos_datos"]['usuario'] ?? ''; ?>" type="text" id="usuario"
                name="usuario"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"
                placeholder="Usuario" required />
            <ul class="mt-2 text-xs text-gray-600">
                <li>• Entre 3 a 20 caracteres</li>
                <li>• Solo letras, números y guiones bajos</li>
            </ul>
        </div>

        <div class="mb-5">
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 light:text-black">Nombre</label>
            <input value="<?php echo $_SESSION["ultimos_datos"]['nombre'] ?? ''; ?>" type="text" id="nombre"
                name="nombre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"
                placeholder="Nombre" required />
            <ul class="mt-2 text-xs text-gray-600">
                <li>• Entre 1 y 50 caracteres</li>
                <li>• Solo letras y espacios</li>
            </ul>
        </div>

        <div class="mb-5">
            <label for="apellidos"
                class="block mb-2 text-sm font-medium text-gray-900 light:text-black">Apellidos</label>
            <input value="<?php echo $_SESSION["ultimos_datos"]['apellidos'] ?? ''; ?>" type="text" id="apellidos"
                name="apellidos"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"
                placeholder="Apellidos" required />
            <ul class="mt-2 text-xs text-gray-600">
                <li>• Entre 1 y 50 caracteres</li>
                <li>• Solo letras y espacios</li>
            </ul>
        </div>

        <div class="mb-5">
            <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 light:text-black">Correo
                Electrónico</label>
            <input value="<?php echo $_SESSION["ultimos_datos"]['correo'] ?? ''; ?>" type="text" id="correo"
                name="correo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"
                placeholder="Correo Electrónico" required />
        </div>

        <div class="mb-5">
            <label for="contraseña"
                class="block mb-2 text-sm font-medium text-gray-900 light:text-black">Contraseña</label>
            <input type="password" id="contraseña" name="contraseña"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"
                required />
            <ul class="mt-2 text-xs text-gray-600">
                <li>• Mínimo 8 caracteres</li>
                <li>• Al menos una letra</li>
                <li>• Al menos un número</li>
                <li>• Al menos un carácter especial (@$!%*#?&)</li>
            </ul>
        </div>

        <div class="mb-5">
            <label for="verificarContraseña"
                class="block mb-2 text-sm font-medium text-gray-900 light:text-black">Verificar Contraseña</label>
            <input type="password" id="verificarContraseña" name="verificarContraseña"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"
                required />
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center light:bg-blue-600 light:hover:bg-blue-700 light:focus:ring-blue-800">
            Registrarse
        </button>
    </form>
</body>

</html>