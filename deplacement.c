#define DIMENSION 5
#include "verification.c"
#include <stdio.h>

int place(int *plateau, int couleur, int x, int y){
  // made by Pierre
  // fonction qui place la couleur au coordonnees x et y du plateau
  // couleur peut etre 0 pour vider la case
  if(plateau[y * DIMENSION +x] == 0 && x < DIMENSION && y < DIMENSION){
    plateau[y * DIMENSION +x] = couleur;
    return 1;
  }
  else{
    return 0;
  }
}

int deplacement(int *plateau, int x_depart, int y_depart, int x_arrive, int y_arrive){
  // made by Pierre
  // fonction qui effectu le deplacement d'un pion
  // return 1 si l'operation est correct, 0 sinon
  // condition: la case d'arrivé doit etre vide et suffisament proche
  if ((plateau[y_arrive * DIMENSION + x_arrive]==0) && x_arrive-x_depart<=1 && x_arrive-x_depart>=-1 && y_arrive-y_depart<=1 && y_arrive-y_depart>=-1 && (plateau[y_depart * DIMENSION + x_depart]!=0)){  // condition a simplifier
    plateau[y_arrive * DIMENSION +x_arrive] = plateau[y_depart * DIMENSION + x_depart];
    plateau[y_depart * DIMENSION +x_depart] = 0;
    return 1;
  }
  else{
    return 0;
  }
}


int phaseDeJeu1(int *plateau, int i){
  // cette fonction effectu un tour lors de la premiere phase de jeu
  // return 0 si le placement n'a pas pu etre effectue
  // return 1 le placement a ete effectue avec succes, on peut passer a la suite
  // return 2 si la partie est gagné
  // return 4 pour que la partie soit enregistre

  if ((i%2)+1 == 1){
    Color(1, 0);
    printf("Joueur 1 ");
  }
  else{
    Color(4, 0);
    printf("Joueur 2 ");
  }
  Color(15, 0);
  printf("; rentre les coordonnees de la ou tu veux poser ta piece: \n");
  int x = 0, y = 0, booleen;
  recuperation_de_coordonnee(&x, &y);
  if( x == 88 ){ //88 est la valeur ASCII correspondant au 'x'
    printf("\n sauvgarde");
    booleen = 4;
  }
  else{
    booleen = place(plateau, (i%2) +1, x, y); // effectu le placement du pion
    if(fini(plateau, x, y) == DIMENSION-1){ // verifie si la partie est fini
      booleen = 2;
    }
  }
  return booleen;
}

int phaseDeJeu2(int *plateau, int i){
  // cette fonction effectu un tour lors de la 2e phase de jeu
  // return 0 si le placement n'a pas pu etre effectue
  // return 1 le placement a ete effectue avec succe, on peut passer a la suite
  // return 2 si la partie est gagné
  //booleen est une variable tres mal nomme comme dans tous le programe
  int x = 0, y = 0, x2 = 0, y2 = 0, booleen;
  // elle etait a la base un simple indicateur de si l'operation avait pu etre effectue mais mtn elle sert aussi a indiquer que la partie est fini
  // cela permet de sortir de la boucle sans devoir faire sortir les coordonne du dernier mouvement dans le main.
  if ((i%2)+1 == 1){
    Color(1, 0);
    printf("Joueur 1 ");
  }
  else{
    Color(4, 0);
    printf("Joueur 2 ");
  }
  Color(15, 0);
  printf("; rentre les coordonnees de la piece que tu veux bouger: \n");
  recuperation_de_coordonnee(&x, &y);
  if( x == 88 ){
    printf("\n sauvgarde");
    booleen = 4;
  }
  else {
    printf("rentre les coordonnees de la ou tu veux poser ta piece: \n");
    recuperation_de_coordonnee(&x2, &y2);
    if (plateau[y *DIMENSION + x] == (i%2)+1) { // s'assurer que l'on deplace notre pion
      booleen = deplacement(plateau, x, y, x2, y2);
    }
    else{
      booleen = 0;
    }

    if(fini(plateau, x2, y2) == DIMENSION-1){ // verifie si la partie est fini
      booleen = 2;
    }
  }
  return booleen;
}
