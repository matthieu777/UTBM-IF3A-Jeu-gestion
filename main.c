#include <stdio.h>

#define DIMENSION 5   //on part du principe que le plateau a une dimension fixe pour le moment

int affichage(int *plateau){
  //made by Pierre
  //fonction qui affiche le plateau
  printf("            ");
  for (int i = 0; i < DIMENSION; i++) {
    printf("%c   ", i  + 49);
  }
  printf("\n          ");
  for (int i = 0; i < DIMENSION; i++) {
    printf("---------------------\n        ");
    printf("%c |", i+65);
    for (int j = 0; j < DIMENSION; j++){
      if(plateau[i*DIMENSION + j] == 0){printf("   |");}
      else{printf(" %d |", plateau[i*DIMENSION + j]);}
    }
    printf("\n          ");
  }
  printf("---------------------\n\n\n");
}

int place(int *plateau, int couleur, int x, int y){
  //made by Pierre
  //fonction qui place la couleur au coordonnees x et y du plateau
  //couleur peut etre 0 pour vider la case
  if(plateau[y * DIMENSION +x] == 0 && x < DIMENSION && y < DIMENSION){

    plateau[y * DIMENSION +x] = couleur;
    return 1;
  }
  else{return 0;}
}

int deplacement(int *plateau, int x_depart, int y_depart, int x_arrive, int y_arrive){
  //made by Pierre
  //fonction qui effectu le deplacement d'un pion
  //return 1 si l'operation est correct, 0 sinon
  // condition: la case d'arrivé doit etre vide et suffisament proche
  if ((plateau[y_arrive * DIMENSION + x_arrive]==0) && x_arrive-x_depart<=1 && x_arrive-x_depart>=-1 && y_arrive-y_depart<=1 && y_arrive-y_depart>=-1 && (plateau[y_depart * DIMENSION + x_depart]!=0)){  // condition a simplifier
    int couleur = plateau[y_depart * DIMENSION + x_depart];
    plateau[y_depart * DIMENSION +x_depart] = 0;
    plateau[y_arrive * DIMENSION +x_arrive] = couleur;
    return 1;
  }
  else{return 0;}
}

int fini(int *plateau, int x, int y){
  //made by Pierre    PAS FINI
  //fonction qui parcour toutes les possibilités au tour d'un seul point ( le dernier jouer)
  int couleur = plateau[y * DIMENSION + x];
  int nbr_alligne = 1 ; //nbr de pions sur l'allignement
  int bloque1 = 0 , bloque2 = 0, ligne = 0;
  // bloque => booleen qui dit indique si il y a un trou dans la ligne se qui bloquera l'incrementation de nbr_alligne
  //check horizontale
  for (int i = 1; i < DIMENSION; i++) {
    if (x + i < DIMENSION){ // si on sort du plateau
      if (plateau[y * DIMENSION + x + i] == couleur){
        if(bloque1 == 0){nbr_alligne ++;}}
      else{bloque1 = 1;}
    }
    if (x - i >=0){ // symetrique
      if (plateau[y * DIMENSION + x - i] == couleur){
        if(bloque2 == 0){nbr_alligne ++;}}
      else{bloque2 = 1;}
    }
  }
  if (nbr_alligne == 0) {ligne = 1;}

  //check verticale
  nbr_alligne = 1, bloque1 = 0, bloque2 = 0;
  for (int i = 1; i < DIMENSION; i++) {
    if (y + i < DIMENSION){ // si on sort du plateau
      if (plateau[(y + i) * DIMENSION + x] == couleur){
        if(bloque1 == 0){nbr_alligne ++;}}
      else{bloque1 = 1;}
    }
    if (y - i >= 0){ // symetrique
      if (plateau[(y - i) * DIMENSION + x] == couleur){
        if(bloque2 == 0){nbr_alligne ++;}}
      else{bloque2 = 1;}
    }
  }
  if (nbr_alligne == 0) {ligne = 2;}

  //check diagonale \.
  nbr_alligne = 1, bloque1 = 0, bloque2 = 0;
  for (int i = 1; i < DIMENSION; i++) {
    if (y + i < DIMENSION && x + i < DIMENSION){ // si on sort du plateau
      if (plateau[(y + i) * DIMENSION + x + i] == couleur){
        if(bloque1 == 0){nbr_alligne ++;}}
      else{bloque1 = 1;}
    }
    if (y - i >= 0 && x - i >= 0){ // symetrique
      if (plateau[(y - i) * DIMENSION + x - i] == couleur){
        if(bloque2 == 0){nbr_alligne ++;}}
      else{bloque2 = 1;}
    }
  }
  if (nbr_alligne == 0) {ligne = 3;}

  //check autre diagonale /
  nbr_alligne = 1, bloque1 = 0, bloque2 = 0;
  for (int i = 1; i < DIMENSION; i++) {
    if (y + i < DIMENSION && x - i >= 0){ // si on sort du plateau
      if (plateau[(y + i) * DIMENSION + x - i] == couleur){
        if(bloque1 == 0){nbr_alligne ++;}}
      else{bloque1 = 1;}
    }
    if (y - i >= 0 && x + i < DIMENSION){ // symetrique
      if (plateau[(y - i) * DIMENSION + x + i] == couleur){
        if(bloque2 == 0){nbr_alligne ++;}}
      else{bloque2 = 1;}
    }
  }
  if (nbr_alligne == 0) {ligne = 4;}
  return ligne;
}


int main(){
  int plateau[DIMENSION*DIMENSION] = {0};
  affichage(plateau);
  //1er fase
  int x, y, booleen;
  for (int i = 0; i < 2 * (DIMENSION-1); i++) {
    printf("joueur %d ; rentre les coordonnees de la ou tu veux poser ta piece: \n", (i%2)+1);
    scanf("%d", &x);
    scanf("%d", &y);
    booleen = place(plateau, (i%2) +1, x, y);
    while (booleen == 0) {
      printf("ERREUR le pion ne peux pas etre poser \njoueur %d ; rentre les coordonnees de la ou tu veux poser ta piece: \n", (i%2)+1);
      scanf("%d", &x);
      scanf("%d", &y);
      booleen = place(plateau, (i%2) +1, x, y);
    }
    affichage(plateau);
  }
  //2e fase
  int x2, y2, i = 0;
  while (fini(plateau, x, y) == 0) {
    printf("joueur %d ; rentre les coordonnees de la piece que tu veux bouger: \n", (i%2)+1);
    scanf("%d", &x);
    scanf("%d", &y);
    printf("rentre les coordonnees de la ou tu veux poser ta piece: \n");
    scanf("%d", &x2);
    scanf("%d", &y2);
    booleen = deplacement(plateau, x, y, x2, y2);
    while (booleen == 0) {
      printf("ERREUR le pion n'a pas pu etre deplacer \njoueur %d ; rentre les coordonnees de la piece que tu veux bouger: \n", (i%2)+1);
      scanf("%d", &x);
      scanf("%d", &y);
      printf("rentre les coordonnees de la ou tu veux poser ta piece: \n");
      scanf("%d", &x2);
      scanf("%d", &y2);
      booleen = deplacement(plateau, x, y, x2, y2);
    }
    affichage(plateau);
    i++;
  }

}
