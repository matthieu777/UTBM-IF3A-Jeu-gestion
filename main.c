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

void place(int *plateau, int couleur, int x, int y){
  //made by Pierre
  //fonction qui place la couleur au coordonnees x et y du plateau
  //couleur peut etre 0 pour vider la case
  plateau[y * DIMENSION +x] = couleur;
}

int deplacement(int *plateau, int x_depart, int y_depart, int x_arrive, int y_arrive){
  //made by Pierre
  //fonction qui effectu le deplacement d'un pion
  //return 1 si l'operation est correct, 0 sinon
  // condition: la case d'arrivé doit etre vide et suffisament proche
  if ((plateau[y_arrive * DIMENSION + x_arrive]==0) && x_arrive-x_depart<=1 && x_arrive-x_depart>=-1 && y_arrive-y_depart<=1 && y_arrive-y_depart>=-1){  // condition a simplifier
    int couleur = plateau[y_depart * DIMENSION + x_depart];
    place(plateau, 0, x_depart, y_depart);
    place(plateau, couleur, x_arrive, y_arrive);
    return 1;
  }
  else{
    return 0;
  }
}

int fini(int *plateau, int x, int y){
  //made by Pierre    PAS FINI
  //fonction qui parcour toutes les possibilités au tour d'un seul point ( le dernier jouer)
  int couleur = plateau[y * DIMENSION + x];
  int nbr_alligne = 1 ,bloque1 = 0 , bloque2 = 0; //nbr de pions sur l'allignement
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
  printf("%d\n", nbr_alligne);

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
  printf("%d\n", nbr_alligne);

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
  printf("%d\n", nbr_alligne);

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
  printf("%d\n", nbr_alligne);

}


int main(){
  int plateau[5*5] = {0};
  affichage(plateau);
  place(plateau, 1, 0,1);
  place(plateau, 1, 1,1);
  place(plateau, 1, 2,1);
  place(plateau, 2, 3,1);
  place(plateau, 1, 4,1);
  place(plateau, 1, 2,2);
  place(plateau, 1, 3,3);
  place(plateau, 1, 0,2);
  affichage(plateau);
  fini(plateau, 1,1);
  affichage(plateau);
}
