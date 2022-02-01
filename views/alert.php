<?php
if (isset($_SESSION['message'])){
    $type = $_SESSION['message']['type'];
    $msgContent = $_SESSION['message']['msgContent'];
    echo"
    <div class='alert alert-$type alert-dismissible col-xl-6 offset-xl-3 col-10 offset-1' role='alert'>
        <div class='row'>
            <div class='col-10 text-center'>
                $msgContent
            </div>
            <span type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </span>
        </div>
    </div>";
}