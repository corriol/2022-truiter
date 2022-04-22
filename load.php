<?php
$pdo = new PDO("mysql:host=127.0.0.1;dbname=truiter;user=root;password=secret");


$theSimpsonQuotes = [
    "Mom has expressed herself.\nWe should nurture her.\nLet's kiss boys.",
    "Shut up Flanders!",
    "Let's all go out for frosty chocolate milkshakes!",
    "If God didn't want us to eat animals, why did he make them out of meat?",
    "I'm not popular enough to be different.",
    "Kids, just because I don't care doesn't mean I'm not listening.",
    "If he's so smart, how come he's dead?",
    "English? Who needs that? I'm never going to England.",
    "Christmas is the one time of year when people of all religions come together to worship Santa Claus.",
    "Facts are meaningless. You can use facts to prove anything that’s even remotely true.",
    "What’s the point of going out? We’re just going to wind up back here, anyway.",
    "For once, maybe someone will call me ‘sir’ without adding, ‘you’re making a scene.'",
    "I’m not normally a praying man, but if you’re up there, please save me, Superman.",
    "Wow, your first day at the new school! Lisa, have fun. Bart, don’t!",
    "Lisa’s growing up. It’s a really complicated time in a girl’s life from age eight to… Actually, all the rest of the way"
];

// ESBORRA'T
$pdo->exec("DELETE FROM truit");
$pdo->exec("DELETE FROM user");

// INSERCIÓ

$stmt = $pdo->prepare("INSERT INTO user(username, name, email, password) 
    VALUES (:username, :name, :email, :password)");

$ids = [];
$users = [
    [
        "username"=>"homer",
        "name"=>"Homer Simpson",
        "email"=>"hsimpson@springfield.us",
        "password"=>password_hash("1234", PASSWORD_DEFAULT)],
    [
        "username"=>"marge",
        "name"=>"Marge Simpson",
        "email"=>"msimpson@springfield.us",
        "password"=>password_hash("1234", PASSWORD_DEFAULT)],
];

foreach ($users as $user) {
    $stmt->execute($user);
    // Guarde en un array indexat els ID generats d'usuaris
    $ids[] = $pdo->lastInsertId();
}

$stmt = $pdo->prepare("INSERT INTO truit(text, created_at, user_id) 
    VALUES (:text, :created_at, :user_id)");

for ($i = 0; $i < 10; $i++) {
    $date = new DateTime();
    // La data serà aleatòria de 0 a 200 minuts abans de la data actual.
    $date->sub(new DateInterval("PT".rand(0, 200)."M"));
    $stmt->bindValue("text", $theSimpsonQuotes[array_rand($theSimpsonQuotes)]);
    $stmt->bindValue("created_at", $date->format("Y-m-d h:i:s"));
    $stmt->bindValue("user_id", $ids[array_rand($ids)]);

    $stmt->execute();
}