$(document).ready(function() 
{
    $("#endgame").hide(true);
    $("#guess").trigger("focus");

    $("#btnQuery").click(function( event ) {
        queryNumber();
    });

    $('#guess').keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            queryNumber();
        }
    });

    $("#btnReset").click(function( event ) {
        window.location.reload();
    });

    function queryNumber() {
        $guess = $("#guess").val();
        if($guess.length === 0 || $guess.length === 1 || $guess.length === 2  || $guess.length === 3 || $guess.length > 4 ) {
            alert("Debe digitar un número de 4 cifras")
            return
        }
        else {            
            $.ajax({
                cache: false,
                type: 'POST',
                data: '&guess='+$("#guess").val(),
                url: 'util.php',
                success: function(response) {
                    $("#results").prepend(response['result']);                    
                    if(response['endgame']){
                        $("#frm").hide(response['endgame']);
                        $("#number_guessed").append(response['number_guessed']);
                        $("#endgame").show();
                    }
                },
                complete: function(response) {
                    $("#guess").val("");
                    $("#guess").trigger("focus");
                }
            });
        }
    }
});