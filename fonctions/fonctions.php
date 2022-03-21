<?php
$BD = new connexionBD();
function getParam(string $name) {
    if (isset($_POST) && isset($_POST[$name])) return $_POST[$name];
    if (isset($_GET) && isset($_GET[$name])) return $_GET[$name];
    return null;
}

function userExist($data): bool {
    global $BD;
    $sql = "SELECT * FROM users WHERE login = ? OR email = ?";
    $stmt = $BD->query($sql, array($data, $data));

    while ($result = $stmt->fetch()) {
        if ($result['login'] != "") {
            return true;
        }
    }
    return false;
}

function addUser($pseudo, $mail, $pass): bool {
    global $BD;
    return $BD->insert("INSERT INTO users (login, email, password, date) VALUES (?, ?, ?, now())", array($pseudo, $mail, $pass));
}

function getPass($email) {
    global $BD;
    $results = $BD->query("SELECT password FROM users WHERE email = ?", array($email));
    foreach ($results as $result) {
        if ($result['password'] != "") {
            return $result['password'];
        }
    }
    return null;
}

function getId(string $email) {
    global $BD;
    $req = $BD->query("SELECT ID FROM users WHERE email = ?", array($email));
    while ($result = $req->fetch()) {
        if ($result['ID'] != "") {
            return $result['ID'];
        }
    }
    return null;
}
function getPseudo($ID) {
    global $BD;
    $req = $BD->query("SELECT login FROM users WHERE ID = ?", array($ID));
    while ($result = $req->fetch()) {
        if ($result['login'] != "") {
            return $result['login'];
        }
    }
    return null;
}

function getAllPilotes() {
    global $BD;
    return $BD->query("SELECT * FROM pilotes");
}


function getPilote($numero) {
    global $BD;
    $result = $BD->query("SELECT last_name, first_name FROM pilotes WHERE number = ?", array($numero));
    foreach ($result as $res) {
        if ($res['last_name'] != "") {
            return $res['first_name']." ".$res['last_name'];
        }
    }
    return null;
}

function getAllGP() {
    global $BD;
    return $BD->query("SELECT * FROM gp");
}

function newProno($user_id, $gp, $P1, $P2, $P3): bool {
    global $BD;
    return !pronoExist($user_id, $gp) ? $BD->insert("INSERT INTO pronostique (user_id, gp, date, P1, P2, P3) VALUES (?, ?, now(), ?, ?, ?)", array($user_id, $gp, $P1, $P2, $P3)) : false;
}

function pronoExist($user_id, $gp): bool {
    global $BD;
    $result = $BD->query("SELECT * FROM pronostique WHERE gp = ? AND user_id = ?", array($gp, $user_id));
    foreach ($result as $res) {
        if ($res['date'] != "") {
            return true;
        }
    }
    return false;
}

function getGP($gp_id) {
    global $BD;
    $result = $BD->query("SELECT piste FROM gp WHERE numero = ?", array($gp_id));
    foreach ($result as $res) {
        if ($res['piste'] != "") {
            return $res['piste'];
        }
    }
    return null;
}

function getPronos($user_id) {
    global $BD;
    return $BD->query("SELECT * FROM pronostique WHERE user_id = ?", array($user_id));
}

function getAllPronosGP($gp_id) {
    global $BD;
    return $BD->query("SELECT * FROM pronostique WHERE gp = ?", array($gp_id));
}

function getAllPronos() {
    global $BD;
    return $BD->query("SELECT * FROM pronostique");
}

function getResultat($gp_id) {
    global $BD;
    return $BD->query("SELECT * FROM resultat WHERE gp = ?", array($gp_id));
}

function getAllResultats() {
    global $BD;
    return $BD->query("SELECT * FROM resultat GROUP BY gp");
}

function getAllResultatsGP($gp_id) {
    global $BD;
    return $BD->query("SELECT * FROM resultat WHERE gp = ?", array($gp_id));
}