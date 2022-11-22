#include <stdio.h>

#define DIMENSION 5   //on part du principe que le plateau a une dimension fixe pour le moment

int affichage(int *plateau){
  //made by Pierre
  //fonction qui affiche le plateau
  for (int i = 0; i < DIMENSION; i++) {
    printf("|");
    for (int j = 0; j < DIMENSION; j++){
      if(plateau[i*DIMENSION + j] == 0){printf("   |");}
      else{printf(" %d |", plateau[i*DIMENSION + j]);}
    }
    printf("\n");
  }
  printf("\n\n\n");
}

void place(int *plateau, int couleur, int x, int y){
  //made by Pierre
  //fonction qui place la couleur au coordonnees x et y du plateau
  //couleur peut etre 0 pour vider la case
  plateau[x * DIMENSION +y] = couleur;
}

void deplacement(int *plateau, int x_depart, int y_depart, int x_arrive, int y_arrive){
  //made by Pierre
  if (plateau[x_arrive * DIMENSION + y_arrive]!=0){
    int couleur = plateau[x_depart * DIMENSION + y_depart];
    place(plateau, 0, x_depart, y_depart);
    place(plateau, couleur, x_arrive, y_arrive);
  }
}

int main(){
  int plateau[5*5] = {0};
  affichage(plateau);
  place(plateau, 1, 1,1);
  affichage(plateau);
  deplacement(plateau, 1,1,2,2);
  affichage(plateau);
}
