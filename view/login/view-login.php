<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <nav>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="#" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium" aria-current="page">
                                Login
                            </a>
                            <a href="view-register.html" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                                Register
                            </a>
                            <a href="../juego/view-juego.html" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                                Juegos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </nav>

    <form action="../../controller/login/controller-login.php" method="post" accept-charset="UTF-8" class="max-w-sm mx-auto">
        <div class="mb-5">
            <label for="usuario" class="block mb-2 text-sm font-medium text-gray-900 light:text-black">Usuario</label>
            <input type="text" id="usuario" name="usuario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500" placeholder="Usuario" required  />
        </div>
        <div class="mb-5">
            <label for="contraseña" class="block mb-2 text-sm font-medium text-gray-900 light:text-black">Contraseña</label>
            <input type="password" id="contraseña" name="contraseña" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500" required/>
        </div>
        <div class="flex items-start mb-5">
            <div class="flex items-center h-5">
                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 light:bg-gray-700 light:border-gray-600 light:focus:ring-blue-600 light:ring-offset-gray-800 light:focus:ring-offset-gray-800"/>
            </div>
            <label for="remember" class="ms-2 text-sm font-medium text-gray-900 light:text-black">Recordarme</label>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center light:bg-blue-600 light:hover:bg-blue-700 light:focus:ring-blue-800">Iniciar Sesion</button>
    </form>
</body>
</html>