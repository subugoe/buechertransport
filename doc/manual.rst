=================
 Büchertransport
=================

--------------------------
 Technische Dokumentation
--------------------------

Anzeige des Büchertransportdienstes mit seinen Leihverkehrsregionen im Frontend.

Installation 
============
* Bilddateien für Fachknoten (Header- und Title-Bild) aus EXT/Resources/Public/Images über Dateimanager in ``/fileadmin/media/bilder/Seitenkopf/`` hochladen
* Anlegen des SysFolder für den Büchertransportdienst und Angabe der SysFolder-ID unter ``plugin.tx_buechertransport.persistence.storagePid = 1800`` in ``Configuration/TypoScript/constants.txt`` oder direkt im Typoscript-Object-Browser
* Erstellen der Seiten: Neuen Knoten mit Unterseiten anlegen; Knoten sollte versteckt werden mit der Option 'not in menu but with node'; Die Seite, auf der die Extension eingebunden werden soll, muss aus programmier-technischen Gründen eine `Placeholder`-Unterseite haben um das Navigationsmenü der Leihverkehrsregionen anzeigen zu können.
* Im globalen Template die Root::PageID des Knotens unter ``plugin.tx_buechertransport.node.pageId = 1799`` in ``Configuration/TypoScript/constants.txt`` speichern
* Im globalen Template das Plugin-Typoscript ``setup.txt`` aus tmpl_sub/Configuration/TypoScript/010_Plugins/Buechertransport direkt nach dem Navigations-Typoscript einbinden
* Installation der ``buechertransport`` Extension
* Hinzufügen des Frontend-Plugins auf der entsprechenden Seite
* Einrichten der Extbase-Scheduler-Tasks (Extbase CommandController Task), beiden Tasks muss das Argument 'run' übergeben werden.
** Büchertransport::Import für Datenimport manuell laufen lassen
** Büchertransport::Geocode für das Laden der Geocodes von Bundesländern und Städten manuell laufen lassen (teilweise mehrfacher Durchlauf nötig, bis ``alle`` Geocodes heruntergeladen wurden)


TYPOSCRIPT
==========
## EXT:/tmpl_sub/Configuration/TypoScript/constants.txt
plugin.tx_buechertransport.node.pageId = 1799
plugin.tx_buechertransport.persistence.storagePid = 1800

## EXT:/tmpl_sub/Configuration/TypoScript/006_BreadCrumbs/setup.txt
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

## EXT:/tmpl_sub/Configuration/TypoScript/010_Plugins/Buechertransport/setup.txt
includeLibs.user_buechertransport = EXT:buechertransport/Resources/Private/Scripts/BuecherTransportScripts.php

### Buechertransport-Subnavigation ###
[PIDinRootline = {$plugin.tx_buechertransport.node.pageId}]
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
      40 = COA
      40 {
        wrap = &cHash=|
        10 = TEXT
        10.field = cHash
      }
      rawUrlEncode = 1
    } 
    # useCacheHash = 1
  }
  ACT = 1
  ACT {
    wrapItemAndSub = <li class="submenu-selected">|</li>
    ATagParams = class="submenu-highlight"
  }
}
[global]

##### Büchertransport #######
[PIDinRootline = {$plugin.tx_buechertransport.node.pageId}]
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
