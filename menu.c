#define DIMENSION 5

int menu(int* color_joueur1, int* color_joueur2, int* i, int* dimension, int* nbr_pion, int* nbr_largeur){
  int couleur, etat_du_jeu =0;
  char touche_menu;
  printf("\nBonjour, bien venu dans le menu du jeu du Teeko,\nSi Vous souhaitez:\n - Commencez une nouvelle partie PvP - tapez C\n - Commencez une nouvelle partie PvE - tapez J\n - Ouvrir une partie sauegarde       - tapez S\n - Changer la couleur du");
  Color(*color_joueur1, 0);
  printf(" Joueur 1");
  Color(15, 0);
  printf("    - tapez 1\n - Changer la couleur du");
  Color(*color_joueur2, 0);
  printf(" Joueur 2");
  Color(15, 0);
  printf("    - tapez 2\n - Changer la dimension du plateau   - tapez D\n - Changer le nombre de pion         - tapez P\n");

  fflush(stdin) ;
  scanf("%c", &touche_menu);

  if (touche_menu == 'C' || touche_menu == 'c'){
    *i = 1;
  }
  else if (touche_menu == 'J' || touche_menu == 'j'){
    printf("Dommage ca marche pas encore, on attend avec impatience que Josh ai remis tous ses points virgule %c \n", 1);
    *i = 1;
  }
  else if(touche_menu == '1' || touche_menu == '&'){
    printf("Voici la pallette de couleur disposible :\n");
    for(int j = 1; j<16 ; j++){
      Color(j, 0);
      printf("Pour me chosir entrez %d\n", j);
    }
    fflush(stdin);
    scanf("%d", &couleur);
    if(couleur == *color_joueur2 || couleur <1 || couleur >16){
      printf("Cette couleur n'est pas valable \n");
    }
    else{
      *color_joueur1 = couleur;
    }
    menu(color_joueur1, color_joueur2, i, dimension, nbr_pion, nbr_largeur);
  }
  else if(touche_menu == '2' || touche_menu == 'é'){
    printf("Voici la pallette de couleur disposible :\n");
    for(int j = 1; j<16 ; j++){
      Color(j, 0);
      printf("Pour me chosir entrez %d\n", j);
    }
    fflush(stdin);
    scanf("%d", &couleur);
    if(couleur == *color_joueur1 || couleur <1 || couleur >16){
      printf("Cette couleur n'est pas valable \n");
    }
    else{
      *color_joueur2 = couleur;
    }
    menu(color_joueur1, color_joueur2, i, dimension, nbr_pion, nbr_largeur);
  }
  else if(touche_menu == 'S' || touche_menu == 's'){
    etat_du_jeu = 1;
  }
  else if(touche_menu == 'P' || touche_menu == 'p'){
    int x; //x est une variable temporaire pour ne pas perdre l'encienne valeur de nbr_pion si la valeur n'est corecte
    printf("Quel est le nombre de pions souhaitez vous ?\n");
    fflush(stdin);
    scanf("%d", &x);
    if(x < 1){
      printf("Cette valeur est trop petite, il n'y a pas de pions negatif\n");
    }
    else if(x > *nbr_largeur){
      printf("Cette valeur est trop grande, il ne peux pas y avoir plus de pions que la largeur du plateau\n");
    }
    else{
      *nbr_pion = x;
    }
    menu(color_joueur1, color_joueur2, i, dimension, nbr_pion, nbr_largeur);
  }
  else if(touche_menu == 'D' || touche_menu == 'd'){
    int x; //x est une variable temporaire pour ne pas perdre l'encienne valeur de nbr_largeur si la valeur n'est corecte
    printf("Quelle dimension du plateau de jeu souhaitez vous ?\n");
    fflush(stdin);
    scanf("%d", &x);
    if(x < 1){
      printf("Cette valeur est trop petite, il n'y a pas de taille negatif\n");
    }
    else if(x < *nbr_pion){
      printf("Cette valeur est trop petite, il ne peux pas y avoir plus de pions que la largeur du plateau\n");
    }
    else{
      *nbr_largeur = x;
    }
    menu(color_joueur1, color_joueur2, i, dimension, nbr_pion, nbr_largeur);
  }
  return etat_du_jeu;
}
