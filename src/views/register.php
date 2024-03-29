<?php 
$PageTitle = "Register";
require "../templates/header.php";
// if logged redirect to index
if($user->isLoggedIn()){
    header("Location: index.php");  //redirect to the main page
    exit();
}

// reset post array if there is a submit = reset call
$reset = $_POST['submit'] ?? 0;
if($reset === 'Reset') $_POST = [];

// get all genders
$genders = $user->getAllGenders();

// check if there is a post call
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $FirstName  = $_POST['FirstName'] ?? '';
    $LastName   = $_POST['LastName'] ?? '';
    $Email      = $_POST['Email'] ?? '';
    $Password   = $_POST['Password'] ?? '';
    $ConfPwd    = $_POST['ConfirmPassword'] ?? '';
    $BirthDate  = $_POST['BirthDate'] ?? '';
    $Gender     = $_POST['Gender'] ?? '';
    
    if ($Password != $ConfPwd) $error = 'Password must match';
    
    try {
        $user->register($FirstName, $LastName, $Email, $Password, $BirthDate, $Gender);
        header("Location: login.php");  //redirect to the login page
        $success = "You have successfully created an account";
        exit();
    } catch (Error $e) {
        $error = $e->getMessage();
    }
}

require "../templates/nav.php";
include_once "../templates/alert.php";
?>


<section class="container small-container" id="register_page">
    <h1>Register</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
        <div class="form-group">
            <!-- First + last name -->
            <div class="row">
                <div class="col">
                    <!-- First name -->
                    <div class="form-floating mb-3">
                        <input required type="text" class="form-control" name="FirstName" placeholder="First name" value="<?php echo $_POST['FirstName'] ?? '' ?>">
                        <label>First name</label>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="form-floating mb-3">
                        <input required type="text" class="form-control" name="LastName" placeholder="Last Name" value="<?php echo $_POST['LastName'] ?? '' ?>">
                        <label>Last Name</label>
                    </div>
                </div>
            </div>
            <!-- Email -->
            <div class="form-floating mb-3">
                <input required type="email" class="form-control" name="Email" placeholder="Email" value="<?php echo $_POST['Email'] ?? '' ?>">
                <label for="floatingInput">Email</label>
            </div>
            <!-- Password -->
            <div class="form-floating mb-3">
                <input required type="password" class="form-control" placeholder="Password" name="Password">
                <label>Password</label>
            </div>
            <!-- Conf password -->
            <div class="form-floating mb-3">
                <input required type="password" class="form-control" placeholder="Confirm Password" name="ConfirmPassword">
                <label>Confirm Password</label>
            </div>
            <!-- Birth date -->
            <div class="form-floating mb-3">
                <input required type="date" class="form-control" placeholder="Birth date" name="BirthDate" value="<?php echo $_POST['BirthDate'] ?? date('Y-m-d') ?>">
                <label>Birth date</label>
            </div>
            <!-- Gender -->
            <div class="mb-3">
                <select required class="form-select" name="Gender">
                    <option value="" hidden>Gender</option>
                    <?php foreach($genders as $k=>$v): ?>
                        <option value="<?php echo $v['GENDERID'] ?>" <?php if (isset($_POST['Gender']) && $_POST['Gender']==$k) echo "selected" ?>><?php echo $v["gName"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Submit +reset -->
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <input class="btn btn-outline-secondary btn-sm" type="submit" name="submit" id="reset_register" value="Reset" />
                </div>
            </div>
        </div>
    </form>
</section>
<?php require_once('../templates/footer.php'); ?>
