<?php
	header('Content-type: application/json');
	
    $num = base64_decode($_COOKIE["numToGuess"]);
    $attempts = $_COOKIE["attempts"] + 1;
	$guess = $_POST['guess'];
    
    $picas = 0;
    $fijas = 0;
    
    for ($i = 0; $i < strlen($num); $i++) {
        // Si el dígito está en la misma posición, es una fija
        if ($num[$i] === $guess[$i]) {
            $fijas++;
        }
        // Si el dígito está en la cadena pero en una posición diferente, es una pica
        elseif (strpos($num, $guess[$i]) !== false) {
            $picas++;
        }
    }

    //Se crea un array para manejar la respuesta en formato JSON en la respuesta AJAX
    $response_array['result'] = "<p class='text-2xl'>                                     
                                    Intento <span class='text-rose-600'>$attempts</span>: <span class='text-blue-600'>$guess</span> tiene 
                                    Picas: <span class='text-red-600'>$picas</span> | 
                                    Fijas: <span class='text-green-600'>$fijas<span> 
                                </p>";

    /**
     * Si el usuario adivina el número la respuesta en envía la respuesta $response_array['endgame'] = true;  
     * para mostrar en el front la finalización del juego
     * **/

    if($fijas===4){
        $response_array['endgame'] = true;
        $response_array['number_guessed'] = $num;
        unset($_COOKIE["numToGuess"]);
        setcookie("numToGuess","", time() - (86400 * 30), "/");
        setcookie("attempts","", time() - (86400 * 30), "/");
    } else {
        $response_array['endgame'] = false;
    }
    $response_array['attempts'] = $attempts;
    
    setcookie("attempts", $attempts++, time() + (86400 * 30), "/");

	echo json_encode($response_array);
?>