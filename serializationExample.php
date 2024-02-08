<?php

// Aktiviert strenge Typüberprüfung, um sicherzustellen, dass alle Typen korrekt sind.
declare(strict_types=1);

// Bezieht eine externe Datei ein, die für die Fehlerberichterstattung zuständig ist.
include_once 'errorReporting.php';

// Definiert eine Klasse `User` für die Benutzerverwaltung.
class User
{
    // Öffentliche Eigenschaften, die von außerhalb der Klasse zugänglich sind.
    public $username;
    public $email;

    // Private Eigenschaften, die nur innerhalb der Klasse zugänglich sind.
    private $dbConnection;
    private $passwordHash;
    private $timestamps;

    // Konstruktor der Klasse, der aufgerufen wird, wenn ein neues Objekt erstellt wird.
    public function __construct($username, $email)
    {
        $this->username = $username; // Setzt den Benutzernamen.
        $this->email = $email; // Setzt die E-Mail-Adresse.
        $this->dbConnection = $this->connectToDB(); // Stellt eine simulierte Datenbankverbindung her.
        $this->passwordHash = $this->generatePasswordHash("secret"); // Generiert einen Passwort-Hash.
        $this->timestamps = date('l jS \of F Y h:i:s A');
    }

    // Eine private Methode, die eine simulierte Datenbankverbindung herstellt.
    private function connectToDB(): string
    {
        echo "Connected to database.<br>"; // Gibt eine Nachricht aus.
        return "results"; // Simuliert eine erfolgreiche Verbindung.
    }

    // Generiert einen Hash für ein Passwort.
    private function generatePasswordHash($password): string
    {
        return md5($password); // Verwendet MD5 für die Hash-Erstellung.
    }

    /**
     * Die __sleep-Methode wird unmittelbar vor der Serialisierung eines Objekts aufgerufen. Der
     * Zweck von __sleep ist es, das Objekt für die Serialisierung vorzubereiten. In dieser Methode
     * können Sie bestimmte Aktionen durchführen, wie zum Beispiel das Schließen von
     * Datenbankverbindungen oder das Auswählen bestimmter Eigenschaften des Objekts, die
     * serialisiert werden sollen. Das bedeutet, Sie geben ein Array mit Namen der Eigenschaften
     * zurück, die in der serialisierten Darstellung beibehalten werden sollen. Es ist also korrekt zu
     * sagen, dass __sleep vor der eigentlichen Serialisierung stattfindet.
     */
    public function __sleep()
    {
        echo "__sleep triggered...<br>"; // Informiert über das Serialisieren.
        $this->disconnectFromDB(); // Trennt die Datenbankverbindung.
        // Gibt die Eigenschaften zurück, die serialisiert werden sollen.
        return array('username', 'email', 'passwordHash', 'timestamps');
    }

    /**
     * Die __wakeup-Methode wird nach der Deserialisierung eines Objekts aufgerufen. Nachdem ein
     * Objekt deserialisiert wurde, kann PHP die __wakeup-Methode automatisch aufrufen, falls sie
     * definiert ist. Diese Methode wird genutzt, um Aktionen durchzuführen, die nach dem
     * Wiederherstellen eines Objekts aus seiner serialisierten Form notwendig sind, wie zum Beispiel
     * das erneute Herstellen von Datenbankverbindungen oder das Initialisieren von Ressourcen, die
     * nicht Teil der serialisierten Daten sind.
     */
    public function __wakeup()
    {
        echo "waking up...<br>"; // Informiert über das Deserialisieren.
        $this->dbConnection = $this->connectToDB(); // Stellt die Datenbankverbindung wieder her.
    }

    // Simuliert das Schließen einer Datenbankverbindung.
    private function disconnectFromDB(): void
    {
        $this->dbConnection = null; // Setzt die Verbindung auf null.
        echo "Disconnected from database.<br>"; // Gibt eine Nachricht aus.
    }
}

// Erstellt ein neues User-Objekt.
$user = new User("john_doe", "john@example.com");
// Serialisiert das User-Objekt und gibt es aus.
echo '[Serialize aufgerufen]<br>';
$serializedUser = serialize($user);
//serialze ruft vor der serialisierung die methode __sleep() auf (wenn vorhanden)
echo "Objekt wurde zerteilt: <br>Ergebnis: <br>" .$serializedUser . "<br>";

// Deserialisiert das User-Objekt und gibt es aus.
echo '[Unserialize aufgerufen]<br>';
$unserializedUser = unserialize($serializedUser);
//unserialze ruft, nach erfolgreichem rekonstruiren des Objekts, die methode __wakeup() auf (wenn vorhanden)
echo "Objekt re-konstruiert: <br>Ergebnis: <br>";
print_r($unserializedUser);


?>
