<?php
include 'header.php';
?>

<!--the form to fill the values for the question and send the values to mail.php with POST-->
<div class="container">
    <legend>Stel uw vraag aan <?= $_GET['naam']?></legend>
    <div class="col-md-12">
        <div class="form-area rounded">
            <form id="mailform" action="mail.php" method="post" >
                <div class="form-group">
                    <label for="name">Uw naam:</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Adres:</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="city">Woonplaats:</label>
                    <input type="text" name="city" class="form-control">
                </div>
               <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="question">Uw vraag:</label>
                    <textarea  rows="4" name="question" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Verzend</button>
            </form>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>