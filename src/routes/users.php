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
    $password = '12345678';
    
    $age = rand(18,100);

    $sql = "INSERT INTO users (email, password, name, gender, age) VALUES(:email, :password, :name, :gender, :age)";

    try
    {
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':age', $age);

        $stmt->execute();

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
$app->get('/api/profiles/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');
    $id = ($id) ? $id : null;

    $sql = "SELECT * FROM users WHERE id <> $id";

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