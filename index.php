<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <header class="bg-teal-400 py-5">
            <h1 class="text-center text-5xl font-black">
                Juego de Picas y Fijas
            </h1>
        </header>
    
        <main 
            id="frm"
            name="frm"
            class="max-w-7xl mx-auto py-20 grid md:grid-cols-2"
        >
            <div class="p-5">
                <form 
                    class="space-y-5"
                >
                    <div class="flex flex-col space-y-5">
                        <p 
                            htmlFor="usernum"
                            class="text-4xl font-black"
                        >
                            Número
                        </p>
                        <input 
                            id="guess" 
                            name="guess"
                            type="number" 
                            min="1000"
                            max="9999"
                            class="w-full bg-white border border-gray-200 p-2"                            
                        />
                    </div>
                    <input 
                        id="btnQuery"
                        class="bg-blue-600 hover:bg-blue-700 cursor-pointer w-full p-2 text-white text-center font-black uppercase disabled:opacity-40"
                        value="Consultar" 
                    />
                </form>                
            </div>

            <div class="border border-dashed border-slate-300 p-5 rounded-lg space-y-10 overflow-y-auto h-96">
                <p 
                    htmlFor="usernum"
                    class="text-4xl font-black"
                >
                    Intentos
                </p>    
                <div
                    id="results"
                    name="results"
                >
                </div>
            </div>
        </main>
        <main 
            id="endgame"
            name="endgame"
            class="max-w-7xl mx-auto py-20 grid md:grid-cols-1"
        >
            <p 
                class="text-8xl"
            >
                Ganaste.... el Número es: <span id="number_guessed"></span>
            </p>
            <div 
                class="max-w-2xl mx-auto pt-5"
            >
                <input 
                    id="btnReset"
                    class="bg-red-600 hover:bg-red-700 hover:cursor-pointer w-full p-2 text-white text-center font-black uppercase disabled:opacity-40"
                    value="Reiniciar juego" 
                />
            </div>
        </main>
        <?php
            /**
             * Se utilizan cookies para el almacenamiento del número, en caso de actualizar la página, 
             * Pero se puede evitar el uso de Cookies y trabajar con la línea
             * $numToGuess = numberGuess();
            */

            //Se consulta si existe la cookie con el número a adivinar
            if(!isset($_COOKIE["numToGuess"])) {
                /** Si no existe la cookie se llama la función para la creación del número y se cifra el mismo 
                 * para evitar que sea vista por el usuario 
                 * Se persiste en el sistema por un día
                */

                $numToGuess = numberGuess();
                setcookie("numToGuess", base64_encode($numToGuess), time() + (86400 * 30), "/");
                setcookie("attempts", 0, time() + (86400 * 30), "/");
            }
                    
            // Función para crear el número
            function numberGuess() {
                //Se crea un número de 4 cifras
                return strval(rand(1000, 9999));
            }            
        ?>
    </body>
</html>