#include <stdio.h>
#include <conio.h>
#include <windows.h>

#include "affichage.c"
#include "deplacement.c"

#define DIMENSION 5


int main(){
  int plateau[DIMENSION*DIMENSION] = {0}; // init du plateau
  affichage(plateau);
  //1er phase
  int booleen,x , y, i = 1;
  do {
    i++;
    booleen = phaseDeJeu1(plateau, i);
    while (booleen == 0) {
      printf("ERREUR le pion ne peux pas etre poser \n");
      booleen = phaseDeJeu1(plateau, i);
    }
    affichage(plateau);
  } while (i < 2 *(DIMENSION-1)+1 && booleen!=2);

  //2e phase
  int x2= 0, y2=0;
  i = 0;
  while(booleen == 1){
    booleen = phaseDeJeu2(plateau, i);
    while (booleen == 0) {
      printf("ERREUR le pion n'a pas pu etre deplacer\n");
      booleen = phaseDeJeu2(plateau, i);
    }
    affichage(plateau);
    i++;
  }
  printf("Bravo le joueur %d à gagner", (i%2)+1);
}
