#include <stdio.h>
#include <conio.h>
#include <windows.h>

#define DIMENSION 5   //on part du principe que le plateau a une dimension fixe pour le moment

void Color(int couleurDuTexte, int couleurDeFond){
  // made by Pierre
  // fonction qui change la couleur du texte de la console
  HANDLE H = GetStdHandle(STD_OUTPUT_HANDLE);
  SetConsoleTextAttribute(H, couleurDeFond*16+couleurDuTexte);
}

int affichage(int *plateau){
  // made by Pierre
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

int check(int *plateau, int x, int y, int signe_x, int signe_y){
  // fonction qui ckek une unique direction au tour d'un points
  int i = 1, nbr_alligne = 0; //  verifie que x et y soit compris entre 0 et Dimenson                                  regarde si la couleur de la case est toujours la meme sinon c'est pas la peine de continuer
  while (x + signe_x * i < DIMENSION && x + signe_x * i >= 0 && y + signe_y * i < DIMENSION && y + signe_y * i >= 0 && plateau[(y + signe_y * i) * DIMENSION + x + signe_x * i] == plateau[y  * DIMENSION + x]) {
    nbr_alligne ++;
    i++;
  }
  return nbr_alligne;
}

int fini(int *plateau, int x, int y){
  //made by Pierre
  //fonction qui parcour toutes les possibilités au tour d'un seul point ( le dernier jouer)
  int ligne_la_plus_grande = 1, Vtemporaire;
  // bloque => booleen qui dit indique si il y a un trou dans la ligne se qui bloquera l'incrementation de nbr_alligne
  //check horizontale
  ligne_la_plus_grande = check(plateau, x, y, 1, 0) + check(plateau, x, y, -1, 0);
  //check verticale
  Vtemporaire = check(plateau, x, y, 0, 1) + check(plateau, x, y, 0, -1);
  if(Vtemporaire > ligne_la_plus_grande){
    ligne_la_plus_grande = Vtemporaire;
  }
  //check autre diagonale \.
  Vtemporaire = check(plateau, x, y, 1, 1) + check(plateau, x, y, -1, -1);
  if(Vtemporaire > ligne_la_plus_grande){
    ligne_la_plus_grande = Vtemporaire;
  }
  //check autre diagonale /
  Vtemporaire = check(plateau, x, y, -1, 1) + check(plateau, x, y, 1, -1);
  if(Vtemporaire > ligne_la_plus_grande){
    ligne_la_plus_grande = Vtemporaire;
  }
  return ligne_la_plus_grande + 1; // +1 parce qu'on n'avait pas encore compte
}                                  //  le pion selectionne

int phaseDeJeu1(int *plateau, int i){
  // cette fonction effectu un tour lors de la premiere phase de jeu
  // return 0 si le placement n'a pas pu etre effectue
  // return 1 le placement a ete effectue avec succe, on peut passer a la suite
  // return 2 si la partie est gagné
  int x , y, booleen;
  printf("joueur %d ; rentre les coordonnees de la ou tu veux poser ta piece: \n", (i%2)+1);
  scanf("%d", &x);
  scanf("%d", &y);
  booleen = place(plateau, (i%2) +1, x, y); // effectu le placement du pion
  if(fini(plateau, x, y) == DIMENSION-1){ // verifie si la partie est fini
    booleen = 2;
  }
  return booleen;
}

int phaseDeJeu2(int *plateau, int i){
  // cette fonction effectu un tour lors de la 2e phase de jeu
  // return 0 si le placement n'a pas pu etre effectue
  // return 1 le placement a ete effectue avec succe, on peut passer a la suite
  // return 2 si la partie est gagné
  int x, y, x2, y2, booleen;  //booleen est une variable tres mal nomme comme dans tous le programe
  // elle etait a la base un simple indicateur de si l'operation avait pu etre effectue mais mtn elle sert aussi a indiquer que la partie est fini
  // cela permet de sortir de la boucle sans devoir faire sortir les coordonne du dernier mouvement dans le main.
  printf("joueur %d ; rentre les coordonnees de la piece que tu veux bouger: \n", (i%2)+1);
  scanf("%d", &x);
  scanf("%d", &y);
  printf("rentre les coordonnees de la ou tu veux poser ta piece: \n");
  scanf("%d", &x2);
  scanf("%d", &y2);
  if (plateau[y *DIMENSION + x] == (i%2)+1) { // s'assurer que l'on deplace notre pion
    booleen = deplacement(plateau, x, y, x2, y2);
  }
  else{
    booleen = 0;
  }
  if(fini(plateau, x2, y2) == DIMENSION-1){ // verifie si la partie est fini
    booleen = 2;
  }
  return booleen;
}

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
}
