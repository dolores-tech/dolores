# Dolores – Ogłoszenia Towarzyskie Widget

Wtyczka WordPress do wyświetlania ogłoszeń z portalu [Dolores](https://dolores.sex) za pomocą shortcode'ów.

## Opis
Wtyczka "Dolores – Ogłoszenia Towarzyskie Widget" pozwala na osadzanie ogłoszeń z portalu [Dolores](https://dolores.sex) na stronach WordPress. Udostępnia dwa shortcode'y: `[ostatnie_ogloszenia]` do wyświetlania losowych ogłoszeń oraz `[ogloszenia]` do wyświetlania ogłoszeń filtrowanych po mieście.

## Instalacja
1. Pobierz plik ZIP wtyczki.
2. W panelu administracyjnym WordPress przejdź do **Wtyczki > Dodaj nową > Wyślij wtyczkę**, a następnie prześlij plik ZIP.
3. Po przesłaniu aktywuj wtyczkę w sekcji **Wtyczki**.

## Użycie
Wtyczka udostępnia dwa shortcode'y, które można umieścić w treści stron, wpisów lub widgetów tekstowych.

### 1. `[ostatnie_ogloszenia]`
Wyświetla losowe ogłoszenia z portalu [Dolores](https://dolores.sex).

**Parametry:**
- `max` – maksymalna liczba ogłoszeń do wyświetlenia (domyślnie 8).

**Przykład:**
```
[ostatnie_ogloszenia max="10"]
```
Ten przykład wyświetli do 10 losowych ogłoszeń.

### 2. `[ogloszenia]`
Wyświetla ogłoszenia z wybranego miasta.

**Parametry:**
- `miasto` – nazwa miasta, z którego mają być wyświetlone ogłoszenia (np. "Warszawa").
- `max` – maksymalna liczba ogłoszeń do wyświetlenia (domyślnie 6).

**Przykład:**
```
[ogloszenia miasto="Warszawa" max="5"]
```
Ten przykład wyświetli do 5 ogłoszeń z Warszawy.

## Wymagania
- Wordpress 6.0.1
- PHP 7.4

## Licencja
Wtyczka jest licencjonowana na [GPL3](https://www.gnu.org/licenses/gpl-3.0.html).

## Autor
Wtyczka została stworzona przez [Dolores](https://dolores.sex).
