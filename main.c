#include <stdio.h>



#include "affichage.c"
#include "deplacement.c"
#include "enregistrement.c"

#define DIMENSION 5


int main(){


  char recomencer; 


  int plateau[DIMENSION*DIMENSION] = {0};
  int isecondephase = -1;
  int i ;

  printf("Voulez vous reprendre une sauvgarde ou commencer une nouvelle partie ? (Ecrivez S ou C)");
  fflush(stdin) ; 
  scanf("%c", &recomencer);

  if (recomencer == 'C'){

  int plateau[DIMENSION*DIMENSION] = {0};

  i = 1;

  } else {
    
    printf("utiliser sauvgarde \n");



    // Ouvrez un fichier en mode lecture
    FILE* fichier = fopen("tableau.txt", "r");

    // Vérifiez si l'ouverture du fichier a réussi
    if (fichier == NULL)
    {
        printf("Impossible d'ouvrir le fichier\n");
        return 1;
    }

    // Parcourez chaque élément du tableau et lisez-le à partir du fichier
    for (int i = 0; i < DIMENSION; i++)
    {
        for (int j = 0; j < DIMENSION; j++)
        {
            fscanf(fichier, "%d", &plateau[i * DIMENSION + j]);
        }
    }



    int compteur = 0;
    char ligne[256];

    while (fgets(ligne, sizeof(ligne), fichier) != NULL) // lecture des lignes du fichier
  {
    compteur++; // incrémentation du compteur de lignes
    if (compteur == 3) // si c'est la 3 ligne
    {
      sscanf(ligne,"%d", &i); // lecture du nombre à partir de la chaîne de caractères
      i--;
      break; // sortie de la boucle
    }
  }



    

    // Fermez le fichier
    fclose(fichier);

     
    for (int i = 0; i < DIMENSION; i++)
    {
        for (int j = 0; j < DIMENSION; j++)
        {
            printf("%d ", plateau[i * DIMENSION + j]);
        }
        printf("\n");
    }


  }


   // init du plateau
  affichage(plateau);
  //1er phase
  int booleen, x , y;
  
  

  do{
    i++;
    
    booleen = phaseDeJeu1(plateau, i);

    while (booleen == 0) {
      printf("ERREUR le pion ne peux pas etre poser \n");
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
      printf("ERREUR le pion n'a pas pu etre deplacer\n");
      booleen = phaseDeJeu2(plateau, i);
    }
    affichage(plateau);
    i++;
  }
  



  if (booleen == 4){
    
     
   printf("sauvgarde ici");
    // Ouverture du fichier en mode écriture

  
    
  enregistrement(plateau,i);

  } else if(booleen == 2) {
    
    printf("Bravo le joueur %d a gagner", (i%2)+1);
  }

}
