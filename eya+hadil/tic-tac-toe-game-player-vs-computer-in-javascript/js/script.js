var cpuIcon = 'X'; // Définir le symbole du CPU par défaut comme 'X'
var playerIcon = 'O'; // Définir le symbole du joueur par défaut comme 'O'
var AIMove; // Variable pour stocker le prochain coup de l'IA

// Définir l'état initial de la grille: 1 pour le CPU, -1 pour le joueur, 0 pour vide
var liveBoard = [0, 0, 0, 0, 0, 0, 0, 0, 0]; // Grille vide au début

// Définir les lignes gagnantes possibles
var winningLines = [
  [0, 1, 2],
  [3, 4, 5],
  [6, 7, 8],
  [0, 3, 6],
  [1, 4, 7],
  [2, 5, 8],
  [0, 4, 8],
  [2, 4, 6]
];

// Interface Utilisateur (UI)
// Fonction pour afficher la grille
function renderBoard(board) {
  board.forEach(function(el, i) {
    var squareId = '#' + i.toString(); // Obtenir l'ID de la case
    if (el === -1) {
      $(squareId).text(playerIcon); // Mettre le symbole du joueur dans la case
    } else if (el === 1) {
      $(squareId).text(cpuIcon); // Mettre le symbole du CPU dans la case
    }
  });
  
  $('.square:contains(X)').addClass('x-marker'); // Ajouter une classe pour les cases contenant 'X'
  $('.square:contains(O)').addClass('o-marker'); // Ajouter une classe pour les cases contenant 'O'
}

// Fonction pour animer la ligne gagnante
function animateWinLine() {
  var idxOfArray = winningLines.map(function(winLines) {
    return winLines.map(function(winLine) {
      return liveBoard[winLine]; // Obtenir l'état des cases de chaque ligne gagnante
    }).reduce(function(prev, cur) {
      return prev + cur; // Somme des états des cases
    });
  });
  var squaresToAnimate = winningLines[idxOfArray.indexOf(Math.abs(3))]; // Trouver la ligne gagnante
  
  squaresToAnimate.forEach(function(el) {
    $('#' + el).fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200).fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200); // Animer les cases de la ligne gagnante
  });
}

// Modals
// Fonction pour choisir le marqueur
function chooseMarker() {
  $('.modal-container').css('display', 'block'); // Afficher la modal
  $('.choose-modal').addClass('animated bounceInUp'); // Ajouter une animation à la modal
  
  $('.button-area span').click(function() {
    var marker = $(this).text(); // Obtenir le texte du bouton cliqué
    playerIcon = (marker === 'X' ? 'X' : 'O'); // Définir le symbole du joueur
    cpuIcon = (marker === 'X' ? 'O' : 'X'); // Définir le symbole du CPU

    $('.choose-modal').addClass('animated bounceOutDown'); // Ajouter une animation de sortie à la modal
    setTimeout(function() {
      $('.modal-container').css('display', 'none'); // Masquer la modal
      $('.choose-modal').css('display','none');
      startNewGame(); // Commencer une nouvelle partie
    }, 700);
    
    $('.button-area span').off(); // Désactiver les événements de clic
  });
}

// Fonction pour afficher le message de fin de partie
function endGameMessage(result) {
  $('.end-game-modal h3').text(result); // Afficher le message de fin de partie
  
  $('.modal-container').css('display', 'block'); // Afficher la modal de fin de partie
  $('.end-game-modal').css('display','block').removeClass('animated bounceOutDown').addClass('animated bounceInUp');
 
  // Ajouter l'événement de clic pour le bouton "Rejouer"
  $('#replay-button').click(function() {
    $('.end-game-modal').removeClass('animated bounceInUp').addClass('animated bounceOutDown');
    
    setTimeout(function() {
      $('.modal-container').css('display', 'none');
      startNewGame(); // Commencer une nouvelle partie
    }, 700);
    
    $('#replay-button').off(); // Désactiver les événements de clic
  });

  // Ajouter l'événement de clic pour le bouton "Quitter"
  $('#quit-button').click(function() {
    window.location.href = 'joueur.php'; // Rediriger vers la page joueur.php
  });
}

// Gameplay
// Fonction pour commencer une nouvelle partie
function startNewGame() {
  liveBoard = [0, 0, 0, 0, 0, 0, 0, 0, 0]; // Réinitialiser la grille
  $('.square').text("").removeClass('o-marker x-marker'); // Réinitialiser l'affichage de la grille
  renderBoard(liveBoard); // Afficher la grille réinitialisée
  playerTakeTurn(); // Lancer le tour du joueur
}

// Fonction pour gérer le tour du joueur
function playerTakeTurn() {
  $('.square:empty').hover(function() {
    $(this).text(playerIcon).css('cursor', 'pointer'); // Afficher le symbole du joueur au survol
  }, function() {
    $(this).text(''); // Effacer le symbole au retrait du survol
  });

  $('.square:empty').click(function() {
    $(this).css('cursor', 'default');
    liveBoard[parseInt($(this).attr('id'))] = -1; // Mettre à jour l'état de la case cliquée
    renderBoard(liveBoard); // Afficher la grille mise à jour
    
    var result = checkVictory(liveBoard); // Vérifier la victoire après le coup du joueur
    if (result) {    
      setTimeout(function() { endGameMessage(result); }, 700); // Afficher le message de fin de partie si nécessaire
    } else {
      setTimeout(aiTakeTurn, 100); // Lancer le tour de l'IA
    }
    $('.square').off(); // Désactiver les événements de clic
  });
}

// Fonction pour gérer le tour de l'IA
function aiTakeTurn() {
  miniMax(liveBoard, 'aiPlayer'); // Appeler l'algorithme minimax pour déterminer le coup de l'IA
  liveBoard[AIMove] = 1; // Mettre à jour l'état de la case choisie par l'IA
  renderBoard(liveBoard); // Afficher la grille mise à jour
  
  var result = checkVictory(liveBoard); // Vérifier la victoire après le coup de l'IA
  if (result) {
    animateWinLine(); // Animer la ligne gagnante si nécessaire
    setTimeout(function() { endGameMessage(result); }, 700); // Afficher le message de fin de partie
  } else {
    playerTakeTurn(); // Lancer le tour du joueur
  }
}

// Utilitaires
// Fonction pour vérifier la victoire
function checkVictory(board) {
  var squaresInPlay = board.reduce(function(prev, cur) {
    return Math.abs(prev) + Math.abs(cur); // Compter les cases jouées
  }, 0); // Ajouter un 0 initial pour éviter des erreurs
  
  var outcome = winningLines.map(function(winLines) {
    return winLines.map(function(winLine) {
      return board[winLine]; // Obtenir l'état des cases de chaque ligne gagnante
    }).reduce(function(prev, cur) {
      return prev + cur; // Somme des états des cases
    });
  }).filter(function(winLineTotal) {
    return Math.abs(winLineTotal) === 3; // Filtrer les lignes gagnantes
  });

  if (outcome.length > 0 && outcome[0] === 3) {
    return 'tu échoues'; // Retourner 'tu échoues' si le CPU gagne
  } else if (outcome.length > 0 && outcome[0] === -3) {
    return 'tu as gagné'; // Retourner 'tu as gagné' si le joueur gagne
  } else if (squaresInPlay === 9) {
    return 'match nul'; // Retourner 'match nul' si toutes les cases sont jouées
  } else {
    return false; // Retourner false si la partie n'est pas encore terminée
  }
}

// Fonction pour obtenir les mouvements disponibles
function availableMoves(board) {
  return board.map(function(el, i) {
    if (el === 0) {
      return i; // Retourner les indices des cases vides
    }
  }).filter(function(e) {
    return (typeof e !== "undefined");
  });
}

// IA
// Algorithme minimax
function miniMax(state, player) {
  // Cas de base: vérifier un état final et retourner le score du point de vue de l'IA
  var rv = checkVictory(state);
  if (rv === 'tu échoues') {
    return 10; // Retourner 10 si l'IA gagne
  }
  if (rv === 'tu as gagné') {
    return -10; // Retourner -10 si l'IA perd
  }
  if (rv === 'match nul') {
    return 0; // Retourner 0 en cas d'égalité
  }

  var moves = [];
  var scores = [];
  // Pour chaque case disponible: faire des mouvements récursifs et ajouter le score + mouvement associé aux tableaux moves et scores
  availableMoves(state).forEach(function(square) {
    state[square] = (player === 'aiPlayer') ? 1 : -1; // Simuler le coup
    scores.push(miniMax(state, (player === 'aiPlayer') ? 'opponent' : 'aiPlayer')); // Calculer le score du coup
    moves.push(square); // Ajouter le mouvement
    state[square] = 0; // Réinitialiser la case
  });

  // Calculer et retourner le meilleur score parmi les mouvements disponibles. Suivre le meilleur mouvement dans la variable AIMove
  if (player === 'aiPlayer') {
    AIMove = moves[scores.indexOf(Math.max.apply(Math, scores))]; // Obtenir le meilleur mouvement pour l'IA
    return Math.max.apply(Math, scores); // Retourner le meilleur score pour l'IA
  } else {
    return Math.min.apply(Math, scores); // Retourner le meilleur score pour l'adversaire
  }
}

// Afficher la grille initiale
renderBoard(liveBoard);

// Afficher la modal pour choisir le marqueur
chooseMarker();
