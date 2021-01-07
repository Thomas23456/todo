
1. Les fonctionnalités réalisées :

 1.1. En tant qu'utilisateur non connecté, je peux : 
    - accéder à la page d'accueil
    - me connecter si je suis enregistré
    - m'enrigistrer si je ne le suis pas déjà

 1.2. En tant qu'utilisateur connecté, je peux : (on accède au boards depuis le dashboard dans la rubrique "Boards")
    - modifier mon profil
    - me désinscrire
    - créer un board  et j'en serais alors propriétaire (et plus tard automatiquement participant)
    - aller sur les boards dont je suis participant
  
 1.3. En tant que propriétaire d'un board, je peux : 
    - inviter des utilisateurs, ils seront participants du board
    - transferer la propriété du board et j'en serai donc seulement utilisateur
    - faire à minima toutes les actions que peuvent faire les utilisateur de mon board
    - faire à minima toutes les actions que peuvent faire les participants des tâches de mon board
    - supprimer le board
    - supprimer un commentaire des tâches de mon board
    - faire toutes les actions d'un participant du board ou d'un utilisateur assigné à une tâche
  
 1.4. En tant que participant d'un board (invité par son propriétaire), je peux
    - créer une tâche 
    - m'assinger une tâche
    - assigner la tâches à des utilisateur du board
    - éditer tous les champs d'une tâche
    - transferer la propriété et j'en serai donc seulement participant (impossible -> seulement si je suis propriétaire du board
      et je donnerai également la propriété du board au nouvel utilisateur)
    - commenter une tâche
  
 1.5. En tant qu'assigné à une tâche, je peux : 
    - changer son status
    
 1.6. En tant que propriétaire d'un commentaire : 
    - éditer le commentaire
    - supprimer le commentaire


2. Les points de blocage :

 - Passage de tous les tests pour les relations entre les différentes tables
 - Comprendre comment mettre en relation les différentes vues
 - Utiliser les routes afin de changer de vues
 - Changer de vue tout en gardant les infos précédentes
 - Utilisations des jetons
 - Comprendre les différentes actions du CRUD


3. Les solutions mises en oeuvre :

 - Recherches sur la doc laravel et correction des Models avec le prof en cours
 - Mettre en place le debug pour mieux comprendre les erreurs
 - Se baser sur les routes déjà existantes et construire celles nécessaires aux parties dévéloppées
 - Reprendre les anciens liens, pour finalement comprendre qu'un post fonctionne en de la même façon en passant les arguments
   c-a-d --> ex : {{route('tasks.destroy', [$board, $task])}} (ici on passe le board et la task associée pour le futur commentaire)
 - Se renseigner sur la doc et suivre le cours
 - Transformer les actions dont nous avions l'habitude et les adapter avec Laravel (ex : INSERT --> create() puis store())


4. Les fonctionnalités non réalisées :

 - supprimer une pièce jointe des tâches de mon board (non demandé)
 - mettre des pièces jointes dans une tâche (non demandé)
 - supprimer la pièce jointe (non demandé)
