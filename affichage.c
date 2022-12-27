#include <conio.h>
#include <windows.h>



#define DIMENSION 5

void Color(int couleurDuTexte, int couleurDeFond){
  
  // fonction qui change la couleur du texte de la console
  HANDLE H = GetStdHandle(STD_OUTPUT_HANDLE);
  SetConsoleTextAttribute(H, couleurDeFond*16+couleurDuTexte);
}

int affichage(int *plateau){
  
  // fonction qui affiche le plateau
  
  printf("            ");
  for (int i = 0; i < DIMENSION; i++) {
    printf("%c   ", i  + 48);
  }
  printf("\n          ");
  for (int i = 0; i < DIMENSION; i++) {
    printf("---------------------\n        ");
    printf("%c |", i+48);
    for (int j = 0; j < DIMENSION; j++){
      switch (plateau[i*DIMENSION + j]) {
        case 0:
          printf("   |");
          break;
        case 1 :
          Color(1, 0);
          printf(" %c ", 2);
          Color(15, 0);
          printf("|");
          break;
        case 2 :
          Color(4, 0);
          printf(" %c ", 2);
          Color(15, 0);
          printf("|");
          break;
      }
    }
    printf("\n          ");
  }
  printf("---------------------\n\n\n");
}


