<?php require_once("../layout/master.php"); ?>


<div id="log-in-form-container" class="container-fluid">
    <form id="formAdminCreation" action="<?= LOCAL . 'app/request/request.php'; ?>" method="post">

        <h4>Log-in</h4>
        <?= get_csrf_token_tag() ?>
        <input type="hidden" name="menu" value="Login">
        <input type="hidden" name="action" value="create">


        <div class="form-group">
            <label for="user_name">Username</label>
            <input type="text"
                   class="form-control"
                   id="user_name"
                   name="user_name"
                   aria-describedby="emailHelp"
                   placeholder="Enter email">
        </div>


        <div class="form-group">
            <label for="password">Password</label>
            <input type="password"
                   class="form-control"
                   id="password"
                   name="password"
                   placeholder="Password">
        </div>


        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                Extra Option
            </label>
        </div>

        <button type="submit" class="btn btn-primary" name="log_in">Submit</button>
    </form>
</div>


<!--Log-in-error comments-->
<?php if (isset($_GET['log_in_error_comment'])) { ?>
    <h5 id="error_comments"><?= $_GET['log_in_error_comment']; ?></h5>
<?php } ?>


<style>
    #formAdminCreation {
        border: 1px solid gray;
        background-color: white;
        padding: 50px;
        margin: 100px;
        border-radius: 5px;
    }

    body {
        background-color: azure;
    }

    #error_comments {
        color: red;
    }
</style>