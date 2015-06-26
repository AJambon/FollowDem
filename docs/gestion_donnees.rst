===================
GESTION DES DONNEES
===================

Apr�s avoir configur� votre serveur, si vous avez besoin d'effectuer des t�ches sur la base de donn�es, r�f�rez vous � ce document.

Tout d'abord, s�lectionnez la base de votre application.

CAS n�1 : Ajouter un objet dont le collier n'a jamais �t� utilis�
=================================================================

Ins�rez une nouvelle ligne dans la table tracked_objects :

� ``id`` : correspond � l'identifiant num�rique du collier.

� ``nom`` : nom de l'objet.

� ``date_creation`` : date du jour ou laisser vide.

� ``date_maj`` : laisser vide.

� ``active`` : d�sactive l'affichage d'un objet qui ne renvoie pas de donn�es satellite. 

Attention mettre ``0`` ne signifie pas que l'objet sera d�sactiv� du site pour toujours mais qu'il n'y appara�t plus tant que de nouvelles donn�es satellites ne sont pas disponibles.

Si des donn�es correspondantes au collier sont de nouveau transmises l'objet sera r�activ� automatiquement.

Ensuite, ins�rez 4 nouvelles entr�es dans la table objects_features (une entr�e par champ ``nom_prop``) :

� ``id_tracked_objects`` : correspond � l'identifiant num�rique du collier (sans le T5HS- devant)

� ``nom_prop`` : peut avoir 4 diff�rentes valeur :

- ``couleurD`` : couleur de la boucle sur l'oreille droite,

- ``couleurG`` : couleur de la boucle sur l'oreille gauche,

- ``naissance`` : ann�e de naissance

- ``sexe``

� ``valeur_prop`` : valeur selon ``nom_prop`` :

- ``couleurD`` ou ``couleurG`` : couleur h�xadecimale pr�c�d�e de # (ex : #FF4574)

- ``naissance`` : ann�e au format num�rique (ex : 2010)

- ``sexe`` : F ou M

Il ne reste plus qu'� faire un import manuel des donn�es existantes si des donn�es ont d�j� �t� transmises apr�s la pose du collier sur l'objet traqu�.

Ces donn�es se trouvent dans le r�pertoire ``/tmp/csv`` dans les fichier TXT.

Il faut donc ex�cuter le script http://mon-domaine.com/controler/import_imap_csv. Les donn�es sont import�es dans la table ``gps_data``.

Il se peut que le fichier contienne des donn�es avant la pose du collier, il faut donc �xecuter dans MYSQL la requ�te suivante :

	::
		DELETE FROM `gps_data` WHERE `id_tracked_objects` = 'id_collier' AND `dateheure` > 'date_de_pose';
		
CAS n�2 : Ajout d'un nouvel objet dont le collier a d�j� �t� utilis� sur un autre objet
=======================================================================================

Si le collier a d�j� �t� utilis� il convient de supprimer toutes les donn�es ant�rieures � la nouvelle date de pose pour le collier.

	::
		DELETE FROM `gps_data` WHERE `id_tracked_objects` = 'id_collier' AND `dateheure` > 'date_de_pose';
		
Si vous souhaitez conserver les donn�es de l'ancien objet, vous pouvez effectuer la requ�te suivante :

	::
		UPDATE `gps_data` SET `id_tracked_objects` = 'id_objet_O' WHERE `id_tracked_objects` = 'id_objet';
		
Ensuite reprenez les �tapes du cas n�1.

CAS n�3 : Un objet change de collier
====================================

Modifiez l'identifiant du collier dans la table ``tracked_objects``, pour ceci vous avez juste � �diter la ligne avec l'id souhait�.

Par la suite, modifiez l'identifiant du collier dans la table ``objects_features``, vous devez �diter 4 lignes comme dans le cas n�1.

Sinon, tapez la requ�te suivante :

	::
		UPDATE `objects_features` SET `id_tracked_objects` = 'id_ancien_collier' WHERE `id_tracked_objects` = 'id_nouveau_collier';
		
Enfin, supprimez les donn�es datant d'avant la pose du collier :

	::
		DELETE FROM `gps_data` WHERE `id_tracked_objects` = 'id_collier' AND `dateheure` > 'date_de_pose';
		
Tr�s important, si vous souhaitez conserver les anciennes donn�es de l'objet, tapez la requ�te suivante :

	::
		UPDATE `gps_data` SET `id_tracked_objects` = 'id_ancien_collier' WHERE `id_tracked_objects` = 'id_nouveau_collier';
		
Mais si vous souhaitez les supprimer, privil�giez plut�t la requ�te suivante :

	::
		DELETE FROM `gps_data` WHERE `id_tracked_objects` = 'id_ancien_collier';
		
Tout comme dans le cas n�1, si vous voulez importer des donn�es existantes, ex�cutez le script suivant : http://mon-domaine.com/controler/import_imap_csv.

CAS n�4 : Ne plus afficher un objet
===================================

2 solutions s'offrent � vous :

- Vous voulez conserver les anciennes donn�es :

Il suffit pour cela de renommer l'identifiant dans la table ``tracked_objects``.

Et apr�s il faut mettre le champ ``active`` � ``0``.

- Vous souhaitez supprimer d�finitivement les donn�es :

Ex�cutez les requ�tes suivantes :

	::
		DELETE FROM `tracked_objects` WHERE `id` = 'id_collier';
		DELETE FROM `objects_features` WHERE `id_tracked_objects` = 'id_collier';
		DELETE FROM `gps_data` WHERE `id_tracked_objects` = 'id_collier';