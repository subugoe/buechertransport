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

### Breadcrumb-Navigation: Buechertransport ###
[globalVar = GP:tx_buechertransport_buechertransport|province > 0]
  lib.rootline.10.special.range = 0|-1
  lib.rootline.20 = RECORDS
  lib.rootline.20 {
    tables = tx_buechertransport_domain_model_province
    source.data = GP:tx_buechertransport_buechertransport|province
    conf {
      tx_buechertransport_domain_model_province >
      tx_buechertransport_domain_model_province = TEXT
      tx_buechertransport_domain_model_province.field = name
      tx_buechertransport_domain_model_province.typolink {
        parameter.data = TSFE:id
        addQueryString = 1
      }
    }
    wrap = <li>|</li>
  }
[end]


### Buechertransport-Navigation ###
[PIDinRootline = 1799]
lib.leihVerkehr = TMENU
lib.leihVerkehr {
   
   wrap = <ul class="submenu-l2 js">|</ul>  
   # Übermittelt Untermenü-Array ($menuArr) an User-Function
   # Falls Unterseiten exisitieren!
   itemArrayProcFunc = user_buechertransport->provinces 
   noBlur = 1
   expAll = 1
   NO = 1
   NO {
      wrapItemAndSub = <li>|</li>
      additionalParams.cObject = COA
      additionalParams.cObject {
      10 = COA
      10 {
         wrap = &tx_buechertransport_buechertransport[province]=|
         10 = TEXT
         10.field = id
      }
      20 = COA
      20 {
         wrap = &tx_buechertransport_buechertransport[action]=|
         10 = TEXT
         10.value = show
       }
       30 = COA
       30 {
          wrap = &tx_buechertransport_buechertransport[controller]=|
          10 = TEXT
          10.value = Province
       }
       rawUrlEncode = 1
     } 
     useCacheHash = 1
   }
#   CUR = 1
#   CUR {
#     wrapItemAndSub = <li class="submenu-selected">|</li>
#     ATagParams = class="submenu-highlight"
#   }
   ACT = 1
   ACT {
     wrapItemAndSub = <li class="submenu-selected">|</li>
     ATagParams = class="submenu-highlight"
   }
}
[global]

##### Büchertransport #######
[PIDinRootline = 1799]
lib.navNeu = COA
lib.navNeu {
  # Setzt obersten Menüpunkt 
  # Legt Einstiegspunkt fest {$startseitenId}
  wrap = <div class="submenu">|</div>
  10 = TEXT
  10 {
    typolink {
      parameter = {$startseitenId}
      ATagParams = class="submenu-trigger"
    }
    wrapItemAndSub = <li>|</li>
    wrap = <ul id="menu1" class="submenu-l1 expand"><li>|
  }

  # Setzt 2. Menüpunkt
  # Relativ zu PIDinRootline
  15 = TEXT
  15 {
    wrap = <li class="submenu-l1 selected">|</li>
    data = leveltitle:2
    value = {page:title}
    insertData = 1
    typolink {
      parameter.data = leveluid:2
      ATagParams = class="submenu-highlight-parent submenu-trigger"
    }
  }
    
  # Setzt komplettes Menü ab Position 3.
  20 = HMENU
  20 {
    entryLevel = 2
    1 < lib.navInterface.1
    2 < lib.leihVerkehr    
  }
  30 = TEXT
  30 {
    wrap = </li></ul>
  }
}
[global]
