#include <stdio.h>



#include "affichage.c"
#include "deplacement.c"
#include "enregistrement.c"

#define DIMENSION 5


int main(){
  char touche_menu;
  int plateau[DIMENSION*DIMENSION] = {0};
  int isecondephase = -1, color_joueur1 = 1, color_joueur2 = 4, couleur;
  int i;
  printf("Bonjour, bien venu dans le menu du jeu du Teeko,\nSi Vous souhaitez:\n - Commencez une nouvelle partie PvP - tapez C\n - Commencez une nouvelle partie PvE - tapez J\n - Ouvrir une partie sauegarde   -     tapez S\n - Changer la couleur du");
  Color(color_joueur1, 0);
  printf(" Joueur 1");
  Color(15, 0);
  printf("    - tapez 1\n - Changer la couleur du");
  Color(color_joueur2, 0);
  printf(" Joueur 2");
  Color(15, 0);
  printf("    - tapez 2\n");

  fflush(stdin) ;
  scanf("%c", &touche_menu);

  if (touche_menu == 'C' || touche_menu == 'c'){
    int plateau[DIMENSION*DIMENSION] = {0};
    i = 1;
  }
  else if (touche_menu == 'J' || touche_menu == 'j'){
    printf("Dommage ca marche pas encore, on attend avec impatience que Josh ai remis tous ses points virgule %c \n", 1);
    int plateau[DIMENSION*DIMENSION] = {0};
    i = 1;
  }
  else if(touche_menu == '1' || touche_menu == '&'){
    printf("Voici la pallette de couleur disposible :\n");
    for(int i = 1; i<16;i++){
      Color(i, 0);
      printf("Pour me chosir entrez %d\n", i);
    }
    fflush(stdin);
    scanf("%d", &couleur);
    if(couleur == color_joueur2 && couleur >1 && couleur >16){
      printf("Cette couleur n'est pas valable \n");
    }
    else{
      color_joueur1 = couleur;
    }
  }
  else if(touche_menu == 'S' || touche_menu == 's'){
    open_enregistrement(plateau);
  }

   // init du plateau
  affichage(plateau);
  //1er phase
  int booleen, x , y;
  do{
    i++;
    booleen = phaseDeJeu1(plateau, i);
    while (booleen == 0) {
      Color(4, 0);
      printf("ERREUR");
      Color(15, 0);
      printf(" le pion ne peux pas etre poser \n");
      booleen = phaseDeJeu1(plateau, i);
    }
    affichage(plateau);
  } while (i < 2 *(DIMENSION-1)+1 && booleen!=2 && booleen !=4);
  //2e phase
  int x2= 0, y2=0;
  i = 0;
  while(booleen == 1){
    booleen = phaseDeJeu2(plateau, i);
    while (booleen == 0) {
      Color(4, 0);
      printf("ERREUR");
      Color(15, 0);
      printf(" le pion n'a pas pu etre deplacer\n");
      booleen = phaseDeJeu2(plateau, i);
    }
    affichage(plateau);
    i++;
  }
  if (booleen == 4){
    Color(11, 0);
    printf("sauvgarde ici\n");
    Color(15,0);
      // Ouverture du fichier en mode écriture
    enregistrement(plateau,i);
  }
  else if(booleen == 2) {
    Color(15, 0);
    printf("Bravo, le ");
    if ((i%2)+1 == 1){
      Color(1, 0);
      printf("Joueur 1 ");
    }
    else{
      Color(4, 0);
      printf("Joueur 2 ");
    }
    Color(15, 0);
    printf("a gagner");
  }

}
