#include <conio.h>
#include <windows.h>
#include <stdio.h>


#define DIMENSION 5


int enregistrement(int *plateau, int i){
    FILE*fichier = fopen("tableau.txt", "w");

    if (fichier == NULL) {
    printf("Impossible d'ouvrir le fichier\n");
    return 1;
    }

    for (int i = 0; i < DIMENSION; i++) {
    for (int j = 0; j < DIMENSION; j++) {
      fprintf(fichier,"%d ", plateau[i * DIMENSION + j]);
    }
    fprintf(fichier,"\n");
  }
  
  fprintf(fichier,"\n%d",i);


  // Fermeture du fichier
    fclose(fichier);

}

/*
int enregistrement(int *plateau){

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