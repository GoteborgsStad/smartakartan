# Smarta Kartan

Ett Wordpress tema.

## Beroenden

Smarta kartan förutsätter att det finns en del andra saker installerade innan du kan börja. Först och främst behöver du ha Wordpress installerat.

Om du vill ha en snabb och lätt uppsatt dev-miljö rekommenderar vi docker. Här har du en länk till hur man sätter upp projectet med docker: https://docs.docker.com/compose/wordpress/

För uppsättning i produktion så hänvisar vi till wordpress egna guide: https://codex.wordpress.org/Installing_WordPress. Samt att ni själva undersöker vad för säkerhetsåtgärder som verkar rimliga för eran specifika server-uppsättning.

Temat kräver också att några Wordpress plugins är installerade. Ni kan antingen själva välja att installera dem i förväg eller så kommer temat att varna och erbjuda er hjälp att installera dem när temat blir aktiverat.

Pluginen temat förutsätter är följande:

- Advanced Custom Fields PRO
- ACF to REST API
- Ajax Search Lite
- Search Meter
- Menu Icons
- Relevanssi
- WP User Frontend
- Polylang

Alla utom `Advanced Custom Fields PRO` är gratis.

## Installations anvisningar

Nu förutsätter vi att du har en ny Wordpress installerad och klar och att du har lyckats logga in i administrationspanelen.

### Installera Temat

1. Börja med att zippa hela katalogen med Smarta Kartan temat.
2. I Wordpress, i menyn till vänster välj `Utseende` -> `Teman`.  
3. Längst upp till vänster så finns det en knapp `Lägg till nytt` klicka på den.  
4. Igen längst upp till vänster så finns det en knapp som denna gången har texten `Ladda upp tema` klicka på den.  
5. Välj din zippen du skapade precis och klicka på `Installera nu`.
6. När installatoinen är klar, välj `Aktivera`.

### Installera plugin beroenden

Om du redan installerat pluginen som behövs kan du hoppa över detta steget.

1. Om du inte redan installerat alla plugins som behövs så får du upp ett varningsmeddelande efter du aktiverat temat. Medelandet börjar med `This theme requires the following plugins:`. Klicka på länken `Begin installing plugins`.
2. Det första du ser är en lista med plugins som behöver installeras. Och innan du kan låta systemet automatiskt installera dem så behöver du installera de plugin som har en länk under sig som det står `Manual Install` på. Börja med att installera dessa manuellt.
3. Se till att aktivera de pluginen du precis installerade manuellt innan du går vidare.
4. Markera sedan alla plugins i listan och i dropdownen ovanför listan väljer du `Install` och sedan klickar du på knappen bredvid dropdownen `Verkställ`.

När vi är klara så vill vi se texten `All plugins installed and activated successfully` längst ner.

### Configurera pluginen

För att temat ska fungera som det ska behöver vissa av pluginen configureras upp korrekt.

#### Advanced Custom Fields

Navigera till valfri sida i admin så borde ni se ett informationsmedelande överst på sidan som börjar med `Advanced Custom Fields Detected`.
Längst ner i det meddelandet finns det 3 knappar. Klicka på `Compatible & Migrate`.

#### Polylang

1. Börja med att välja `Språk` i vänstermenyn.
2. Under inställningen `Välj ett spårk` så väljer ni ett språk.
3. Längt ner på sidan finns det en knapp `Lägg till nytt språk`, klicka på den.
4. Det kommer då upp ett litet varningsmeddelande överst på sidan som säger `Det finns poster, sidor, kategorier, eller etiketter som är utan språk. Du kan ange att alla ska tillhöra standardspråket.`. Klicka på länken: `Du kan ange att alla ska tillhöra standardspråket.`.

#### Ajax Search Lite

1. Börja med att välja `Ajax Search Lite` i vänstermenyn.
2. Välj `Layout options`.
3. Under Theme, välj `Underline White`.
4. Scrolla ner, välj `Save Options!`.

### Configurera Wordpress

1. Välj `Utseende` -> `Menyer` i vänstermenyn.
2. Skapa upp huvudmenyn.
 1. Skriv `Primary menu` i fältet `Namn för meny`.
 2. Klicka på knappen `Skapa meny`.
 3. Checka de checkboxar som börjar med `primary` följt av språken du har.
 4. Sen väljer du vilka sidor som ska vara kopplade till den menyn till vänster.
 5. Klicka sedan på `Spara meny`.
3. Skapa upp huvudmenyn.
 1. Klicka på länken `skapa en ny meny`.
 2. Skriv `More menu delta` i fältet `Namn för meny`.
 3. Klicka på knappen `Skapa meny`.
 4. Checka de checkboxar som börjar med `Mode Delta Menu` följt av språken du har.
 5. Sen väljer du vilka sidor som ska vara kopplade till den menyn till vänster.
 6. Klicka sedan på `Spara meny`.
4. Login menyn
 1. Klicka på länken `skapa en ny meny`.
 2. Skriv `Login` i fältet `Namn för meny`.
 3. Klicka på knappen `Skapa meny`.
 4. Sen väljer du vilka sidor som ska vara kopplade till den menyn till vänster.
 5. Klicka sedan på `Spara meny`.
4. Footer menyn
 1. Klicka på länken `skapa en ny meny`.
 2. Skriv `Footer meny` i fältet `Namn för meny`.
 3. Klicka på knappen `Skapa meny`.
 4. Sen väljer du vilka sidor som ska vara kopplade till den menyn till vänster.
 5. Klicka sedan på `Spara meny`.

## Avslutande ord

Tack för att ni valt att använda Smarta Kartan temat.  
Nu borde det bara vara att lägga in eget innehåll på sidan.  
Lycka till!

Efter installation
SMARTA KARTAN TEMA-UPPSÄTTNING

Posttypes:
- Verksamheter listas som kort och markörer på kartan.
- Events listar events på kartan och som items under kalendern.
- Stories listas som kort och under historier-arkivet
- Blogg listas under bloggsidan

Sidor:
- Höjdpunkter (samlingssida för samlingar) Skapa sida med template 'Collections'

- collection (samlingar) Skapa sida med template 'collection'. Fyll i fält, under fältet "collection of posts" lägger du till poster som ingår i samlingen.

Menyer:
Primary Menu:
  -kalender - skapa en ny sida > välj template "Calender". Publicera.
  Välj "primary meny" under appearence > menues. Flytta över kalender-sidan till menyn.

  -kartan - skapa en ny sida > välj template "themap". Publicera.
  Välj "primary meny" under appearence > menues. Flytta över kart-sidan till menyn.

  -historier - skapa en ny sida > välj template "stories". Publicera.
  Välj "primary meny" under appearence > menues. Flytta över historier-sidan till menyn. (detta är en arkivsida och fylls på med publiserade stories (se ovan))

  -Blogg - skapa en ny sida > välj template "blogs". Publicera.
  Välj "primary meny" under appearence > menues. Flytta över historier-sidan till menyn. (detta är en arkivsida och fylls på med publiserade stories (se ovan))

  -Om oss (vanlig sida) - Skapa en "om oss" sida och lägg till i menyn

Delta menu:
  -skapa sidorna Lägg till Event och lägg till Verksamhet
    Välj more-delta menu, välj display location > more delta menu.
    publicera

Kategoriikoner och färger:
  Under verksamheter i adminpanelen, klicka på kategorier. Skapa en ny kategori. På denna sida får du alternativ

Theme settings:
  Theme Settings i adminpanelen. Under 'Global Options' justeras färgteman för sidan. Innehåll kan även anpassas per språk. Under 'Options(Sv)' anpassas Footer-inställningar.

Plugins:
  Polylang - translations. För att lägga till ett språk, klicka på add language under pluginet och välj språk från listan. När språket är tilllagt kan du börja översätta poster och sidor genom att klicka på pluset (+) bredvid SV-symbolen och fylla på översatt innehåll.

  WPUF - Skapa formulär. För att besökare ska kunna föreslå verksamheter och event till kartan behöver dessa formulär skapas upp. De kan sedan skrivas ut på sidan med de shortcodes ([...]) som genereras av pluginet. (sätt poststatus till väntande så att admin får godkänna innan post publiceras)

Grundposition karta:
  Under Theme settings finns två fält, 'base long' och 'base lat' som används för att bestämma kartans initiala position. De anges som koordinat, för Göteborg används t.ex 'base lat' => 57.7030712 och 'base long' => 11.9590075. När användaren har godkänt att använda sin position och denne hittas, kommer kartan att  centreras på användaren.
