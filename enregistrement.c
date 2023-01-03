#include <conio.h>
#include <windows.h>
#include <stdio.h>




int open_enregistrement_dim(){
  int dimension = 0;

  // Ouvrez un fichier en mode lecture
  FILE* fichier = fopen("tableau.txt", "r");

  // Vérifiez si l'ouverture du fichier a réussi
  if (fichier == NULL)
  {
      Color(4,0);
      printf("Impossible d'ouvrir le fichier\n");
      Color(15,0);
      return 1;
  }

  int compteur = 0;
  char ligne[256];

  while (fgets(ligne, sizeof(ligne), fichier) != NULL) // lecture des lignes du fichier
  {
    compteur++; // incrémentation du compteur de lignes
    if (compteur == 1) // si c'est la 5 ligne
    {
      sscanf(ligne,"%d", &dimension); // lecture du nombre à partir de la chaîne de caractères
      break; // sortie de la boucle
    }

  }

  //refaire la meme chose pour la ligne suivante :

  // Fermez le fichier
  fclose(fichier);

  return dimension;

}







int enregistrement(int *plateau, int i,int phasencours, int dimension){
    FILE*fichier = fopen("tableau.txt", "w");

    if (fichier == NULL) {
    printf("Impossible d'ouvrir le fichier\n");
    return 1;
    }

    fprintf(fichier,"%d\n",dimension);
    fprintf(fichier,"%d\n",i);
    fprintf(fichier,"%d\n",phasencours);

    for (int o = 0; o < dimension; o++) {
    for (int j = 0; j < dimension; j++) {
      fprintf(fichier,"%d ", plateau[o * dimension + j]);
    }
    fprintf(fichier,"\n");
  }




  // Fermeture du fichier
    fclose(fichier);

}

int open_enregistrement(int *plateau ,int i ,int* phasencours, int dimension ){

  printf("utiliser sauvgarde \n");

  // Ouvrez un fichier en mode lecture
  FILE* fichier = fopen("tableau.txt", "r");

  // Vérifiez si l'ouverture du fichier a réussi
  if (fichier == NULL)
  {
      Color(4,0);
      printf("Impossible d'ouvrir le fichier\n");
      Color(15,0);
      return 1;
  }
  // ici tu va récuperer la DIMENSION parce qu'elle doit etre installer

//int DIMENSION = 5;


  // Parcoure de chaque élément du tableau à partir du fichier


  int compteur = 0;
  char ligne[256];

  while (fgets(ligne, sizeof(ligne), fichier) != NULL) // lecture des lignes du fichier
  {
    compteur++; // incrémentation du compteur de lignes
    if (compteur == 2) // si c'est la 3 ligne
    {
      sscanf(ligne,"%d", &i); // lecture du nombre à partir de la chaîne de caractères
      i--;

    }
    if (compteur == 3) // si c'est la 3 ligne
    {
      sscanf(ligne,"%d", phasencours); // lecture du nombre à partir de la chaîne de caractères
      break; // sortie de la boucle
    }
  }

  for (int i = 0; i < dimension; i++)
  {
      for (int j = 0; j < dimension; j++)
      {
          fscanf(fichier, "%d", &plateau[i * dimension + j]);
      }
  }


  //refaire la meme chose pour la ligne suivante :

  // Fermez le fichier
  fclose(fichier);





  //affichage(*pointeur_plateau, 1, 4);

  return i;

}

/*
int enreeegistrement(int *plateau){
    FILE*fichier = fopen("tableau.txt", "w");
    if (fichier == NULL) {
    printf("Impossible d'ouvrir le fichier\n");
    return 1;
    }
    fprintf(fichier,"            ");
    for (int i = 0; i < DIMENSION; i++) {
    fprintf(fichier,"%c   ", i  + 48);
    }
    fprintf(fichier,"\n          ");
    for (int i = 0; i < DIMENSION; i++) {
    fprintf(fichier,"---------------------\n        ");
    fprintf(fichier,"%c |", i+48);
    for (int j = 0; j < DIMENSION; j++){
      switch (plateau[i*DIMENSION + j]) {
        case 0:
          fprintf(fichier,"   |");
          break;
        case 1 :
          Color(1, 0);
          fprintf(fichier," %c ", 2);
          Color(15, 0);
          fprintf(fichier,"|");
          break;
        case 2 :
          Color(4, 0);
          fprintf(fichier," %c ", 2);
          Color(15, 0);
          fprintf(fichier,"|");
          break;
      }
    }
    fprintf(fichier,"\n          ");
  }
  fprintf(fichier,"---------------------\n\n\n");
    // Fermeture du fichier
    fclose(fichier);
}
*/
