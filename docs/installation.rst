===========
APPLICATION
===========

Cr�ation de la base de donn�es MYSQL
====================================

    TODO

    
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

    TODO
    
    
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