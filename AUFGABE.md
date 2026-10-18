# 05 – Alpine.js & Livewire

**KI erlaubt:** Ja, aber nur **als Chat** (z.B. ChatGPT oder Claude im Browser), keine Agenten, die selbst Code ins Projekt schreiben.
**Wichtig:** Du musst uns **jede Zeile** deines Codes erklären können. Wenn du etwas von der KI übernimmst, das du nicht verstehst, frag nach oder lass es weg.

Doku:
- Alpine.js: https://alpinejs.dev (*x-data*, *x-show*, *x-on*, *x-transition*, *x-text*, Modifier `.outside`, `.window`)
- Livewire & Alpine: https://livewire.laravel.com/docs/alpine (`$wire`)

**Zeit:** ca. 3–4 Stunden

## Ausgangslage

Die Projektliste http://05-alpine.test/projekte funktioniert bereits. Sie hat aber ein paar Schwächen:
- Beim Löschen erscheint das hässliche Browser-Fenster („Diese Seite sagt …“).
- Den Status kann man nicht ändern.
- Die Beschreibung eines Projekts kann man nicht bearbeiten.

Alpine.js ist bei Livewire **schon dabei**. Du musst nichts installieren.

## Starten

```bash
composer run setup
npm run dev
```

Dann http://05-alpine.test im Browser öffnen (Herd).

## Vorgaben vom Team

| | Komponente / URL | Methode |
|---|---|---|
| 5.1 | `pages::projekte.index` → `/projekte` | `delete(int $projectId)` (existiert schon) |
| 5.2 | `pages::projekte.index` | `updateStatus(int $projectId, string $status)` |
| 5.3 | `pages::projekte.edit` → `/projekte/{project}/bearbeiten` | Property `$description`, Methode `save` |

---

## Aufgabe 5.1 – Eigenes Lösch-Modal

Ersetze `wire:confirm` durch ein **eigenes Modal-Fenster** mit Alpine:
- Klick auf „Löschen“ öffnet ein Fenster: „Soll «Projektname» wirklich gelöscht werden?“ mit den Buttons **Abbrechen** und **Löschen**.
- Der Hintergrund wird abgedunkelt.
- Das Modal schliesst sich bei: Abbrechen, **Escape-Taste** und **Klick auf den dunklen Hintergrund**.
- Ein- und Ausblenden mit einer kleinen Animation
- „Löschen“ im Modal ruft die bestehende Livewire-Methode `delete` auf.

**Tipp:** Es reicht **ein** Modal für die ganze Seite und nicht eins pro Zeile.

## Aufgabe 5.2 – Status-Dropdown

Der Status-Badge in jeder Zeile wird klickbar:
- Klick auf den Badge öffnet ein kleines **Dropdown** mit allen Status (Offen / Aktiv / Abgeschlossen).
- Klick auf einen Status speichert ihn sofort, und das Dropdown schliesst sich.
- Klick **irgendwo ausserhalb** schliesst das Dropdown auch.
- Erstelle dafür die Livewire-Methode `updateStatus`.

## Aufgabe 5.3 – Beschreibung mit Zeichenzähler

Neue Seite `/projekte/{project}/bearbeiten` (in der Liste ein Link „Bearbeiten“):
- Textfeld für die Beschreibung, darunter ein Zähler **„123 / 500“**
- Der Zähler aktualisiert sich **bei jedem Tastendruck**, aber **ohne** dass dabei ein Request an den Server geht (prüfe das im Network-Tab der Entwicklertools!).
- Über 500 Zeichen wird der Zähler **rot**.
- Beim Speichern prüft der Server, dass es höchstens 500 Zeichen sind.

---

## Zusatzaufgaben

- **Toast-Meldung:** Nach dem Speichern oder Löschen erscheint unten rechts für 2–3 Sekunden eine kleine Meldung („Status gespeichert.“). Stichwort: `$this->dispatch(...)` in Livewire, `@ereignis.window` in Alpine.
- Das Modal kann man mit der Tastatur bedienen (Fokus liegt beim Öffnen auf „Abbrechen“).
- `x-cloak`: Verhindere, dass das Modal beim Laden der Seite kurz aufblitzt.

## Abgabe

Committe deine Arbeit und erkläre uns:
1. Was läuft im **Browser** (Alpine), was auf dem **Server** (Livewire)?
2. Was ist `$wire`?
3. Kann ein Benutzer `updateStatus` mit einem Status aufrufen, der gar nicht im Dropdown steht? Was passiert dann bei dir?
