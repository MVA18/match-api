<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

//Create new random user
$app->get('/api/user/create', function(Request $request, Response $response){

    $faker = Faker\Factory::create();

    $genders = ['male','female'];

    $gender = $genders[array_rand($genders, 1)];
    $name = $faker->name($gender);
    $email = $faker->email;
    $password = $faker->password;
    
    $age = rand(18,100);

    $sql = "INSERT INTO users (email, password, name, gender, age) VALUES('$email', '$password', '$name', '$gender', $age)";

    try
    {
        $db = new db();
        $db = $db->connect();

        $db->exec($sql);
        $last_id = $db->lastInsertId();

        $sql = "SELECT * FROM users WHERE id = $last_id";
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;

        echo json_encode($user);        
    }
    catch(PDOException $e)
    {
        echo '{"error"}: {"text": '.$e->getMessage().'}';
    }
});

//Get all profiles
$app->get('/api/profiles', function(Request $request, Response $response){

    $sql = "SELECT * FROM users";

    try
    {
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        echo json_encode($users);
    }
    catch(PDOException $e)
    {
        echo '{"error"}: {"text": '.$e->getMessage().'}';
    }
});

//Get specific profile
$app->get('/api/user/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM users WHERE id = $id";

    try
    {
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        echo json_encode($user);
    }
    catch(PDOException $e)
    {
        echo '{"error"}: {"text": '.$e->getMessage().'}';
    }
});