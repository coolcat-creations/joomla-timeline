# joomla-timeline
This menutype for a category shows article items in a gantt diagramm.

## Usage
1) Copy the timeline.php and timeline.xml file into your frontend template in 
yourtemplate/html/com_content/category 

2) Copy the language lines into your templates sys.ini file

3) Create a category

4) Create a custom field of the type repeatable

5) Add the fields: from (numeric), to(numeric), color(text), class(text), text(textarea)

6) Edit Articles and add them to your desired category

7) Create a new Menüitem and select Gantt Chart. Select your Category and define the number of leading articles.

Note: If you change the field titles, you have to change them in the override too. Also keep in mind to change the ID of the called jcfield.

If you have any issues, post a issue here in Github

Dieser Menütyp zeigt Beitröge in einem sogenannten gantt Diagramm / einer Zeitleiste dar

## Verwendung
1) Kopiere die timeline.php und timeline.xml Datei in dein Frontend Template in
deintemplate/html/com_content/category 

2) Kopiere die Übersetzungen aus den hier zur Verfügung gestellten sys.ini Dateien in die sys.ini Datei deines Temaplates

3) Erstelle eine Kategorie

4) Erstelle ein eigenes Feld vom Typ Wiederholbar (Repeatable) 

5) Füge folgende Felder hinzu: from (numeric), to(numeric), color(text), class(text), text(textarea)

6) Erstelle neue Beiträge und füge sie deiner gewünschten Kategorie hinzu

7) Erstelle einen neuen Menüeintrag vom Typ "Zeitstrahl", wähle deine Kategorie aus und unter Optionen die Anzahl der führenden Beiträge

Hinweis: Falls du die Feldtitel anders nennst, musst du diese im Override in der Foreach Schleife, die diese Einträge abruft auch abändern. Weiterhin musst du beim Abruf des jcfields ebenso die ID ändern.

Bei Fragen oder Fehlern, eröffne bitte einen Issue.
