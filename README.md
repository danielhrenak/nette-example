# PHP developer úloha
## Zadanie

Úlohou je vytvorenie aplikácie (v Nette), ktorá bude umožňovať:

- jednoduchú správu zvieratiek v obchode s domácimi miláčikmi
- ku každému zvieratku budú evidované informácie ako meno, kategória, obrázok, status
- cez webové rozhranie (pomocou API volaní definovaných na https://petstore3.swagger.io) bude možné pridávať, editovať, vypisovať zoznam podľa statusu a mazať zvieratko
- všetky dáta o zvieratkách budú uložené v XML súbore, ktorého štruktúru si musíte navrhnúť
- pri programovaní využite OOP
- všetko ostatné, čo použijete je na Vás

Ďalšie podúlohy, ktoré kandidátom určite pomôžu:

- aplikáciu napíšte tak, aby bola čo najjednoduchšie rozšíriteľná o ďalšie atribúty evidovné pri zvieratkách (napríklad vek zvieratka) - k vypracovaniu napíšte krátky popis ako a kde v aplikácií je potrebné urobiť zmeny, aby bolo možné pridať nový atribút
- nie je nutné, aby aplikácia obsahovala nejakú premyslenú grafiku
- k úlohe priložte sprievodný text s jednoduchým popisom riešenia - ako a prečo ste sa rozhodli spraviť veci tak, ako ste ich spravili

## Vypracovanie
- Ukladanie dát do data/pets.xml
- Handlovanie JSON requestov pre:
    - pridanie zvieratka (POST)
    - editovanie zvieratka (PUT)
    - vypisovanie zvieratka podla statusu (GET)
    - mazanie zvieratka (DELETE)
    - zobrazenie zvieratka podla ID (GET)
- Základné testovanie API

## Spustenie
1. Stiahnite si projekt
2. Nainštalujte si pomocou príkazu `composer install`
3. Spustite si docker `docker compose up`
4. Jednotlivé requesty sú testovateľné cez postman - kolekcia Pets.postman_collection.json

## Nedokončené úlohy
- Pridanie tagov k zvieratku
- Pridanie kategórií zvieratka
- Zobrazenie zvieratka podla tagov
- Pridanie fotiek zvieratka

## Rozšíriteľnosť
- Ak by sme chceli pridať nový atribút, napríklad vek zvieratka, musíme pridať nový atribút do PetsRepository.php upraviť Pets.php, kde sa zvieratka načítavajú a ukladajú.