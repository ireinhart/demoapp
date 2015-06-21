DemoApp
=======

Eine Buchverwaltung die als DemoApp für den TechTalk "Professionelle und schnelle PHP Entwicklung mit PHP" dient.


# Setup
* virtualbox installieren
* vagrant installieren


# Entwicklungsumgebung starten
Mit ``vagrant up`` im Projekt-Verzeichnis die VM starten.


# cli: Buch hinzufügen
In der console kann ein Buch hinzugefügt werden

    app/console book:add "A new Book" "1"

Parameter:

* Title des Buch
* locationId für das Buch

# Funktionale Tests
Die App kann Funktional getestet werden mit dem Befehl

    bin/phpunit -c app/
