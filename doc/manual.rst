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
* Erstellen der Seiten: Neuen Knoten mit Unterseiten anlegen; im globalen Template die Root::PageID des Knotens zu den Fachknoten hinzufügen; 
* Installation der ``buechertransport`` Extension
* Hinzufügen des Frontend-Plugins auf der entsprechenden Seite
* Anlegen des SysFolder für den Büchertransportdienst und Angabe der ID ``plugin.tx_buechertransport.persistence.storagePid = 1800`` (z.B.) in ``Configuration/TypoScript/constants.txt``
* Extbase-Scheduler einrichten: Büchertransport::Import für Datenimport manuell laufen lassen


TYPOSCRIPT
==========
...
