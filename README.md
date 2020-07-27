## Zadanie rekrutacyjne na stanowisko Regular/Senior PHP Developer

#Pobieranie danych o walutach z NBP

#####Komendy potrzebne do wykonania aby poprawnie uruchomić kod:
1. docker-compose build app
2. docker-compose up -d
3. cp .env.example .env
4. docker-compose exec app composer install
5. docker-compose exec app php artisan migrate
6. docker-compose exec app php ./vendor/bin/phpunit

System dostępny jest pod adresem: http://localhost:8000

Endpointy systemu:
1. http://localhost:8000/api/currency/getActual - Pobranie najnowszych danych o wszystkich walutach
2. http://localhost:8000/api/currency/getSpecify/{CURRENCY}/{FROM_DATE}/{TO_DATE}/{SORT} - 
Pobranie danych dla konkretnej waluty.
Parametry zapytania:
- {CURRENCY} - Kod waluty (np. eur)
- {FROM_DATE} - Od jakiej daty mają być pobrane dane (format YYYY-MM-DD, np: 2020-03-17)
- {TO_DATE} - Do jakiej daty mają być pobrane dane (format YYYY-MM-DD, np: 2020-03-17)
- {SORT} - W jakiej kolejności ma sorotwać rekordy (desc albo asc)


