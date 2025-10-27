# PRG120V – Obligatorisk oppgave 2 (PHP + MySQL)

Denne løsningen oppfyller kravene i oppgaveteksten:
- Registrering, visning og sletting i tabellene **klasse** og **student**
- Bruk av listebokser (dropdowns) der det er hensiktsmessig
- En **index.php** som samler alle brukerfunksjoner
- SQL-skjema tilsvarende i oppgaven
- Kan kjøres i Dokploy

## Hurtigstart

1. **Konfigurer databaseforbindelse**
   - Kopier `config.sample.php` til `config.php` og legg inn korrekte DB-verdier (host, brukernavn, passord, databasenavn).
   - I Dokploy settes dette typisk som miljøvariabler eller direkte i filen.
2. **Initialiser databasen**
   - Kjør `init_db.php` i nettleser _én gang_ (for eksempel `https://dokploy.usn.no/app/BRUKERNAVN-REPONAVN/init_db.php`).
   - Dette oppretter tabellene `klasse` og `student` med riktig struktur.
3. **Bruk applikasjonen**
   - Åpne `index.php` for å registrere, liste og slette data.

## Filstruktur
- `index.php` – meny med lenker til alle funksjoner
- `db.php` – oppretter databaseforbindelse basert på `config.php`
- `init_db.php` – oppretter tabellene iht. oppgaven (trygg å kjøre flere ganger)
- `style.css` – enkel styling
- `config.sample.php` – mal for konfig, kopier til `config.php` og tilpass

### Klasse
- `klasse_create.php` – registrering av klasse
- `klasse_list.php` – visning av alle klasser
- `klasse_delete.php` – sletting av klasse (med dropdown)

### Student
- `student_create.php` – registrering av student (med dropdown for klassekode)
- `student_list.php` – visning av alle studenter
- `student_delete.php` – sletting av student (med dropdown)

## Sikkerhet og kvalitet
- Alle INSERT/DELETE bruker **forberedte spørringer (prepared statements)**.
- Enkle **server-side valideringer** (tom input, lengder).
- **Uten** ekstern rammeverk – ren PHP (mysqli).

## Tipstriks
- Om du fjerner en klasse som har studenter, vil slettingen feile pga. fremmednøkkel. Slett studenter først, eller legg til `ON DELETE CASCADE` i `init_db.php` om læreren tillater det.
- PHP-versjon 8.x anbefales.
