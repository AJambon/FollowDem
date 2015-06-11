=======
SERVEUR
=======
.. image:: http://geotrek.fr/images/logo-pne.png
    :target: http://www.ecrins-parcnational.fr
    


Pr�-requis
===========

Vous devez disposer d'un serveur ou d'un h�bergement avec mysql, php5.4 et apache. Le mod_rewrite doit �tre activ�

Si vous avez la main sur le serveur, cette documentation peut vous aider � sa mise en place.

Si vous disposez d'un h�bergement, le serveur doit �tre pr�t � l'utilisation.

* Ressources minimales du serveur :

Un serveur disposant d'au moins de 1 Go RAM et de 10 Go d'espace disque.


* disposer d'un utilisateur linux que vous pouvez nomm� par exemple ``followdem``. Le r�pertoire de cet utilisateur ``followdem`` doit �tre dans ``/home/followdem``

  :: 
    
        sudo adduser --home /home/followdem followdem


* r�cup�rer le zip de l'application sur le Github du projet

  ::
    
        cd /tmp
        wget https://github.com/PnEcrins/FollowDem/archive/master.zip
        unzip master.zip
        mkdir -p /home/followdem/monprojet
        cp master/* /home/followdem/monprojet
        cd /home/followdem

        
Installation et configuration du serveur
========================================

Installation pour ubuntu.

:notes:

    Cette documentation concerne une installation sur Ubuntu 12.04 LTS. Elle devrait �tre valide sur Debian ou une version plus r�cente d'Ubuntu. Pour tout autre environemment les commandes sont � adapter.

.

:notes:

    Durant toute la proc�dure d'installation, travailler avec l'utilisateur ``followdem``. Ne changer d'utilisateur que lorsque la documentation le sp�cifie.

.

  ::
   
     su - 
     usermod -g www-data followdem
     usermod -a -G root followdem
     adduser followdem sudo
     exit
    
    Fermer la console et la r�ouvrir pour que les modifications soient prises en compte
    
* Activer le mod_rewrite et red�marrer apache

  ::  
        
        sudo a2enmod rewrite
        sudo apache2ctl restart


Installation et configuration de MYSQL
==========================================

* Mise � jour des sources

  ::  
    
        sudo apt-get update

* Configuration MYSQL

  ::
  
		apt-get install mysql-server mysql-client libmysqlclient15-dev mysql-common
		sudo mysqladmin -u root password Nouveau_mot_de_passe -p ""
		sudo vi /etc/mysql/my.cnf

Dans le fichier my.cnf, modifier les lignes de la fa�on suivante :
	
  ::
  
		language = /usr/share/mysql/french
		key_buffer = 32M
		query_cache_limit = 2M
		#log_bin = /var/log/mysql/mysql-bin.log
		#expire_logs_days = 10
		log_slow_queries = /var/log/mysql/mysql-slow.log
		long_query_time = 2
		default-character-set = utf8
		default-collation = utf8_general_ci
		default-character-set = utf8

* Rechargez ensuite le serveur

  ::

	  /etc/init.d/mysql reload
		
* Cr�ation d'un utilisateur MYSQL

  ::
  
		CREATE USER "nom_utilisateur"@"localhost";
		SET password FOR "nom_utilisateur"@"localhost" = password('mot_de_passe');

* Cr�ation d'une base de donn�ees MYSQL

  ::
  
		CREATE DATABASE nom_de_la_base;
	
* Pour se placer dans la base, tapez dans MYSQL :

  ::
  
	  USE nom_de_la_base;	
		
		
* Attribution des droits � l'utilisateur MYSQL

  ::
  
		GRANT ALL ON nom_de_la_base.* TO "nom_utilisateur"@"localhost";
	