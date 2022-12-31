#define DIMENSION 5


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


void recuperation_de_coordonnee(int* pX, int* pY){
  //Cette fonction permet de pouvoir rentrer un couple de coordonnees de facon plus souple
  //  (gestion des espaaces, des saut de lignes et des caractere non conformes)
  //Elle prend en entree un couple de pointeur pointant vers un couple de coordonnees
  //Elle renvoie se couple de coordonnees complete, -1 si la coordonnee n'a pas été remplie
  // et 88  88 si un x a ete indique en debut de chaine indiquant la sauvegarde

  printf("Ecrit un truc:\n");
  fflush(stdin);
  int x = -1, y = -1, c;
  for(int i = 0; i<10; i++){
    scanf("%c", &c);
    c = c%256;
    if((c == 120 || c == 88) && x == -1 && y == -1){ //si on rentre x en premier, on enregistrera
      x = 88;
      y = 88;
      i = 10;
    }
    else if(c >= 48 && c <=57){
      x = (x+1) * 10 + c - 49;
    }
    else if(c >= 65 && c <=90){
      y = (y+1) * 26 + c - 65;
    }
    else if(c >= 97 && c <=122){
      y = (y+1) * 26 + c - 97;
    }
    else if(x != -1 && y != -1){
      i=10;
    }
  }
  *pX = x;
  *pY = y;
}
