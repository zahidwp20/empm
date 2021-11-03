<?php

include 'header.php';
?>



<main class="form-signin text-center mt-5">
    <form>
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-2 mb-2">Don't have any account? <a href="register.php">Register</a> Now</p>
        <p class="mt-5 mb-3 text-muted">&copy; 2020–2021</p>
    </form>
</main>


<?php include 'footer.php'; ?>
