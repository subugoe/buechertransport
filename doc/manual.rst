=================
 Büchertransport
=================

--------------------------
 Technische Dokumentation
--------------------------

Anzeige des Büchertransportdienstes mit seinen Leihverkehrsregionen im Frontend.

Installation 
============
* Bilddateien für Fachknoten Header und Title-Datei über Dateimanager in ``/fileadmin/media/bilder/Seitenkopf/`` hochladen
* Erstellen der Seiten: Neuen Knoten mit Unterseiten anlegen; im globalen Template die Root::PageID des Knotens zu den Fachknoten hinzufügen 
* Installation der ``buechertransport`` Extension
* Hinzufügen des Frontend-Plugins auf der entsprechenden Seite
* Anlegen des SysFolder für den Büchertransportdienst und Eingabe der ID in ``plugin.tx_buechertransport.persistence.storagePid = 1800`` (z.B.)
* Extbase-Scheduler einrichten: Büchertransport::Import und für Datenimport manuell laufen lassen


TYPOSCRIPT
==========
::

  #Angenommen die UID des Powermailfeldes ist {$selectID}:
  lib.uebergabe = TEXT
  lib.uebergabe.data = GPvar:tx_powermail_pi1|uid{$selectID}
  lib.uebergabe.intval = 1
  lib.uebergabe.required = 1
  lib.uebergabe.wrap = uid = |

  # lib.uebergabeNo = TEXT
  # lib.uebergabeNo.data = GPvar:tx_powermail_pi1|uid{$selectID}
  # lib.uebergabeNo.intval = 1
  # lib.uebergabeNo.required = 1
  # lib.uebergabeNo.wrap = uid != |

