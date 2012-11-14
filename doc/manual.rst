=================
 Büchertransport
=================

--------------------------
 Technische Dokumentation
--------------------------

Anzeige des Büchertransportdienstes mit seinen Leihverkehrsregionen im Frontend.

Installation 
============
* Bilddateien für Fachknoten (Header- und Title-Bild) über Dateimanager in ``/fileadmin/media/bilder/Seitenkopf/`` hochladen
* Erstellen der Seiten: Neuen Knoten mit Unterseiten anlegen; im globalen Template die Root::PageID des Knotens zu den Fachknoten hinzufügen und TypoScript von unten einbinden
* Installation der ``buechertransport`` Extension
* Hinzufügen des Frontend-Plugins auf der entsprechenden Seite
* Anlegen des SysFolder für den Büchertransportdienst und Angabe der ID ``plugin.tx_buechertransport.persistence.storagePid = 1800`` (z.B.) in ``Configuration/TypoScript/constants.txt``
* Extbase-Scheduler einrichten: Büchertransport::Import für Datenimport manuell laufen lassen

TYPOSCRIPT
==========
includeLibs.user_buechertransport = EXT:buechertransport/Resources/Private/Scripts/BuecherTransportScripts.php

### Buechertransport-Navigation ###
# [PIDinRootline = 1799]
[globalVar = TSFE:id = 1802]  # PageID Extension
lib.navNeu = USER
lib.navNeu {
  userFunc = user_buechertransport->provinces
}
[global]
