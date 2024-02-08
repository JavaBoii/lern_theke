<?php

declare(strict_types=1); // Strengt den Typmodus an, um sicherzustellen, dass Typen strikt gehandhabt werden.

namespace Hermann\MMS\Playground;
// Definiert den Namespace für die Klasse, um Namenskonflikte zu vermeiden.

include_once 'errorReporting.php'; // Bindet die Datei ein, um Fehlerberichterstattung zu konfigurieren.
require_once 'anotherPlaygroundHKN.php'; // Stellt sicher, dass die Datei für die AnotherPlayground-Klasse genau einmal eingebunden wird.

class Playground
{
    private array $data = []; // Ein privates Array, das zum Speichern von Eigenschaften verwendet wird, auf die mit Magiemethoden zugegriffen wird.

    // Konstruktor, der beim Erstellen eines Objekts der Klasse aufgerufen wird.
    public function __construct()
    {
        echo('hello world. Im a Playground. The beginning<br>'); // Begrüßungsnachricht beim Erstellen des Objekts.
    }

    // Wird aufgerufen, wenn das Objekt wie eine Funktion aufgerufen wird.
    public function __invoke($random): void
    {
        printf('oh bobr. Im %s <br>', $random); // Gibt eine formatierte Nachricht aus, wenn das Objekt aufgerufen wird.
    }

    // Wird aufgerufen, wenn das Objekt zerstört wird oder das Skript endet.
    public function __destruct()
    {
        echo "<br>File closed."; // Nachricht beim Zerstören des Objekts.
    }

    // Wird aufgerufen, wenn auf eine nicht zugängliche/existierende Eigenschaft lesend zugegriffen wird.
    public function __get($name)
    {
        return $this->data[$name] ?? null; // Gibt den Wert der Eigenschaft zurück, wenn vorhanden, sonst null.
    }

    // Wird aufgerufen, wenn eine nicht zugängliche/existierende Eigenschaft beschrieben wird.
    public function __set($name, $value)
    {
        $this->data[$name] = $value; // Setzt den Wert einer Eigenschaft im $data-Array.
    }

    // Wird aufgerufen, wenn eine nicht zugängliche/existierende Methode aufgerufen wird.
    public function __call($name, $arguments)
    {
        echo "Trying to call `$name` with parameters: " . implode(', ', $arguments); // Gibt eine Nachricht mit dem Methodennamen und den Parametern aus.
    }

    // Wird aufgerufen, wenn das Objekt in einen String umgewandelt wird, z.B. durch echo.
    public function __toString()
    {
        return "This is an object of class " . Playground::class; // Gibt eine Beschreibung des Objekts zurück.
        //::class gibt
    }

    // Eine Methode, die ein AnotherPlayground-Objekt instanziiert und zurückgibt.
    public function lol(): AnotherPlayground
    {
        return new AnotherPlayground(); // Erstellt und gibt ein neues AnotherPlayground-Objekt zurück.
    }
}
