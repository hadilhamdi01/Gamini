var playing = false;
var score = 0;
var livesLeft = 3;
var fruits = ["apple", "banana", "cherries", "grapes", "kiwi", "mango", "orange", "peach", "pear", "watermelon"];
var step;
var $;
var i;
var j;
var action;
var location;
var clearInterval;
var setInterval;
var setTimeout;
var timeForABomb = 0;
var bomba;
var scoreToPut;
var alert;
var prompt;

$(function(){
    $('#startreset').click(function(){
        if(playing){
            location.reload();
        } else {
            startGame();
        }
    });

    $('#replay').click(function(){
        location.reload();
    });

    $('#quit').click(function(){
        window.location.href = 'jouer.php';
    });
    

    function startGame() {
        playing = true;
        bomba = true;
        livesLeft = 3;
        score = 0;
        $('#gameover').hide();
        $('#score-value').html(score);
        $('#lifesLeft').show();
        $('#startreset').hide(); // Masquer le bouton "Jouer"
        addHearts();
        startAction();
    }

    function endGame() {
        playing = false;
        $('#startreset').hide(); // Masquer le bouton "Jouer"
        $('#lifesLeft').hide();
        $('#final-score-value').html(score);
        $('#gameover').show();
        stopAction();
    }

    $('#fruit1').mouseover(function(){
        if (playing) {
            score++;
            $('#score-value').html(score);
            $('#slicesound')[0].play();
            timeForABomb = -0.5;
            clearInterval(action);
            $('#fruit1').hide("explode", 500);
            setTimeout(startAction, 1000);
            if (score > 99) {
                endGame();
            }
        }
    });

    $('#bomb').mouseover(function(){
        if (playing) {
            $('#bombsound')[0].play();
            $('#fruit1').hide();
            $('#bomb').hide("explode", 500);
            clearInterval(action);
            endGame();
        }
    });

    function addHearts(){
        $('#lifesLeft').empty();
        for (i = 0; i < livesLeft; i++){
            $("#lifesLeft").append("<img src='images/heart.png' class='life'>");
        }
    }

    function startAction(){
        step = Math.round(Math.random() * 5) + 1;
        timeForABomb = Math.random();
        if (timeForABomb < 0.8) {
            $('#fruit1').show();
            chooseFruit();
            $('#fruit1').css({ left: 530 * Math.random() + 10, top: -50 });
        }
        action = setInterval(function(){
            if (timeForABomb < 0.8) {
                $('#fruit1').css('top', $('#fruit1').position().top + step);
                if ($('#fruit1').position().top > $('#fruitsContainer').height()) {
                    if (livesLeft > 1) {
                        livesLeft--;
                        addHearts();
                        $('#fruit1').show();
                        chooseFruit();
                        $('#fruit1').css({ left: 530 * Math.random() + 10, top: -50 });
                        step = Math.round(Math.random() * 5) + 1;
                    } else {
                        endGame();
                    }
                }
            } else {
                if (bomba) {
                    $('#fruit1').hide();
                    $('#bomb').show();
                    $('#bomb').css({ left: 530 * Math.random() + 10, top: -50 });
                    bomba = false;
                }
                $('#bomb').css('top', $('#bomb').position().top + step);
                if ($('#bomb').position().top > $('#fruitsContainer').height()) {
                    $('#fruit1').show();
                    chooseFruit();
                    $('#fruit1').css({ left: 530 * Math.random() + 10, top: -50 });
                    step = Math.round(Math.random() * 5) + 1;
                    timeForABomb = -1;
                    bomba = true;
                }
            }
        }, 10);
    }

    function chooseFruit(){
        $('#fruit1').attr('src', 'images/' + fruits[Math.floor(9 * Math.random())] + '.png');
    }

    function stopAction() {
        clearInterval(action);
        $('#fruit1').hide();
        $('#bomb').hide();
    }
});
