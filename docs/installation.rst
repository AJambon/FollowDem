===========
APPLICATION
===========
.. image:: http://geotrek.fr/images/logo-pne.png
    :target: http://www.ecrins-parcnational.fr
    
Cr�ation de la base de donn�es MYSQL
====================================

Sur phpMyAdmin.
	::
		


	Allez dans l�onglet "Importer" depuis la page d�accueil de phpMyAdmin.

	Cliquez sur �Choisissez un fichier� et s�lectionner le fichier ``data/FollowDem_DataBase.sql`` qui est le script de cr�ation des tables.
	
	Ensuite s�lectionnez �utf-8� comme Jeu de caract�res du fichier, autorisez l�importation partielle, s�lectionnez le �SQL� comme Format.
	
	Enfin, cliquez sur �Ex�cuter�

	Votre base de donn�es est maintenant op�rationnelle.
	Si vous voulez, vous pouvez importer un jeu d�essai en effectuant les m�mes �tapes que ci-dessus, mais en s�lectionnant le fichier ``data/FollowDem_DataSet.sql``.

Sur un serveur.

	::

		cd /home/followdem/monprojet/data
		mysql -unomUtilisateur -pmotDePasse
		use nomDeLaBase;
		source FollowDem_DataBase.sql;
		
	Idem que sur phpMyAdmin, si vous souhaitez ajouter un jeu d�essai, saisissez en plus la commande suivante :
	
	::
	
		source FollowDem_DataSet.sql;

Installation du r�pertoire de l'application
===========================================

* R�cup�rez le zip de l'application sur le Github du projet FollowDem : https://github.com/PnEcrins/FollowDem/archive/master.zip

* Extraire le contenu dans un r�pertoire au nom de votre projet � la racine du r�pertoire de publication web d'apache.

Sur un serveur.

    ::
    
        cd /tmp
        wget https://github.com/PnEcrins/FollowDem/archive/master.zip
        unzip master.zip
        mkdir -p /home/followdem/monprojet
        cp master/* /home/followdem/monprojet
        rm master.zip
        cd /home/followdem
        
	
Configuration de l'application
==============================
    
Copier et renommer le fichier ``carto.php.sample`` en ``carto.php``
    
Copier et renommer le fichier ``config.php.sample`` en ``config.php``
    
    ::
    
        cd /home/followdem/monprojet/config
        cp carto.php.sample carto.php
        cp config.php.sample config.php
        cd ..

Editer ces fichiers et mettre � jour les param�tres de connexion � votre base de donn�es, ainsi que tous les param�tres utiles � une personnalisation de votre application.
    
    
Cl� IGN
=======
Commander une cl� IGN de type : Licence g�oservices IGN pour usage grand public - gratuite
Avec les couches suivantes : 

* WMTS-G�oportail - Cartes IGN

Pour cela, il faut que vous disposiez d'un compte IGN pro. (http://professionnels.ign.fr)
Une fois connect� au site: 

* aller dans nouvelle commande

* choisir G�oservices IGN : Pour le web dans la rubrique "LES G�OSERVICES EN LIGNE"

* cocher l'option "Pour un site internet grand public"

* cocher l'option "Licence g�oservices IGN pour usage grand public - gratuite"

* saisir votre url. Attention, l'adresse doit �tre pr�c�d�e de http://

* Finisser votre commande en selectionnant les couches d'int�ret et en acceptant les diff�rentes licences.


Une fois que votre commande est pr�te saisissez la valeur de la cl� IGN re�ue dans le fichier config/config.php : remplacer dans l'url la chaine 'maCleIgn' dans la partie 'leaflet_fonds_carte' "IGNCARTE"=>