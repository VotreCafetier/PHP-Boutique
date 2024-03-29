<?php 
$PageTitle = 'Login';
require "../templates/header.php";

// if logged redirect to index
if($user->isLoggedIn()){
    header("Location: index.php");  //redirect to the main page
    exit();
}

// check if post request
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // async stuff
    // $json = $db->isJson(file_get_contents('php://input'));
    // if (!empty($json)){
    //     $_POST['email'] = $json['email'];
    //     $_POST['password'] = $json['password'];
    // }
    
    $email = $_POST['email'];
    $pw = $_POST['password'];
    
    try{
        $user->login($email, $pw);  //login the user
        header("Location: index.php");  //redirect to the main page
        exit();
    }
    catch(Error $e){
        $error = $e->getMessage();
    }
}

require "../templates/nav.php";
include_once "../templates/alert.php";
?>

<section class="container small-container">
    <h1>Connection</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="container">
        <div class="form-group">
            <!-- Email -->
            <div class="form-floating mb-3">
                <input required type="email" class="form-control" id="floatingInput" name="email" placeholder="Email" value="<?php echo $_POST['email'] ?? '' ?>">
                <label for="floatingInput">Email</label>
            </div>
            <!-- Password -->
            <div class="form-floating mb-3">
                <input required type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
        </div>

        <!-- Submit btn -->
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</section>

<?php require_once('../templates/footer.php'); ?>