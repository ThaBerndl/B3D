<?php
$_db_host = "localhost";            # meist localhost
$_db_datenbank = "datenbankname";
$_db_username = "root";
$_db_passwort = "";

SESSION_START();

# Datenbankverbindung herstellen
$link = mysqli_connect($_db_host, $_db_username, $_db_passwort);

# Hat die Verbindung geklappt ?
if (!$link)
{
    die("Keine Datenbankverbindung möglich: " . mysqli_error());
}

# Verbindung zur richtigen Datenbank herstellen
$datenbank = mysqli_select_db($_db_datenbank, $link);

if (!$datenbank)
{
    echo "Kann die Datenbank nicht benutzen: " . mysqli_error();
    mysqli_close($link);        # Datenbank schliessen
    exit;                    # Programm beenden !
}

##################################################################

# Ist die $_POST Variable submit nicht leer ???
# dann wurden Logindaten eingegeben, die müssen wir überprüfen !
if (!empty($_POST["submit"]))
{
    # Die Werte die im Loginformular eingegeben wurden "escapen",
    # damit keine Hackangriffe über den Login erfolgen können !
    # Mysql_real_escape ist auf jedenfall dem Befehle addslashes()
    # vorzuziehen !!! Ohne sind mysql injections möglich !!!!
    $_username = mysqli_real_escape_string($_POST["username"]);
    $_passwort = mysqli_real_escape_string($_POST["passwort"]);

    # Befehl für die MySQL Datenbank
    $_sql = "SELECT * FROM login_usernamen WHERE
                    username='$_username' AND
                    passwort='$_passwort' AND
                    user_geloescht=0
                LIMIT 1";

    # Prüfen, ob der User in der Datenbank existiert !
    $_res = mysqli_query($_sql, $link);
    $_anzahl = @mysqli_num_rows($_res);

    # Die Anzahl der gefundenen Einträge überprüfen. Maximal
    # wird 1 Eintrag rausgefiltert (LIMIT 1). Wenn 0 Einträge
    # gefunden wurden, dann gibt es keinen Usereintrag, der
    # gültig ist. Keinen wo der Username und das Passwort stimmt
    # und user_geloescht auch gleich 0 ist !
    if ($_anzahl > 0)
    {
        echo "Der Login war erfolgreich.<br>";

        # In der Session merken, dass der User eingeloggt ist !
        $_SESSION["login"] = 1;

        # Den Eintrag vom User in der Session speichern !
        $_SESSION["user"] = mysqli_fetch_array($_res, MYSQLI_ASSOC);

        # Das Einlogdatum in der Tabelle setzen !
        $_sql = "UPDATE login_usernamen SET letzter_login=NOW()
                     WHERE id=".$_SESSION["user"]["id"];
        mysqli_query($_sql);
    }
    else
    {
        echo "Die Logindaten sind nicht korrekt.<br>";
    }
}

# Ist der User eingeloggt ???
if ($_SESSION["login"] == 0)
{
    # ist nicht eingeloggt, also Formular anzeigen, die Datenbank
    # schliessen und das Programm beenden
    include("login-formular.html");
    mysqli_close($link);
    exit;
}

# Hier wäre der User jetzt gültig angemeldet ! Hier kann
# Programmcode stehen, den nur eingeloggte User sehen sollen !!
echo "Hallo, Sie sind erfolgreich eingeloggt !<br>";

##################################################################

# Datenbank wieder schliessen
mysqli_close($link);
?>