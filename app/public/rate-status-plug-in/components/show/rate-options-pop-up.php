<div id="rate-options-pop-up" class="rate-options-pop-up-trigger-elelements">
    
    <div class="rate-options-pop-up-trigger-elelements">

        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="5">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/MJGoat.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">+5 GOAT</h6>
        </div>



        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="4">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/NDZone.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">+4 nDzone</h6>
        </div>



        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="3">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/Ballin.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">+3 Ballin</h6>
        </div>


        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="2">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/Cookin.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">+2 Cookin</h6>
        </div>


        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="1">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/Swaggy.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">+1 Swaggy</h6>
        </div>


        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="0">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/SosoFace.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">00 PokerFace</h6>
        </div>


        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="-1">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/Sucks.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">-1 Sucks</h6>
        </div>


        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="-2">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/Nuts.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">-2 Nuts</h6>
        </div>


        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="-3">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/Shit.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">-3 Buggy</h6>
        </div>


        <div class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="-4">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/Bomb.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">-4 Bomb</h6>
        </div>



        <div id="last-rate-option" class="rate-option rate-options-pop-up-trigger-elelements orange-hovered-shadow" rate-value="-5">
            <img class="rate-option-img rate-options-pop-up-trigger-elelements" src="<?= PUBLIC_LOCAL . "img/rate-icons/CryingMJ.png" ?>">
            <h6 class="rate-option-label rate-options-pop-up-trigger-elelements">-5 MEME</h6>
        </div>

    </div>

</div>





<style>
    #rate-options-pop-up {
        display: none;
        margin: 0;
        margin-top: 0px;
        margin-left: 0px;
        padding: 15px 15px;
        background-color: rgb(250, 250, 230);
        position: absolute;
        border-radius: 10px;

        box-shadow: 0 0 20px rgb(130, 130, 130);
        z-index: 1000;


    }

    #rate-options-pop-up button {
        display: block;
    }

    #rate-options-pop-up button:hover {
        cursor: pointer;
    }

    #rate-options-pop-up img {
        width: 30px;
    }

    .rate-option-label {
        display: inline-block;
        font-size: 80%;
        font-weight: 100;
        margin-left: 10px;
    }

    .rate-option {
        border-bottom: 1px solid rgb(200, 200, 200);
        padding: 5px 10px;
    }

    .rate-option:hover {
        box-shadow: 0 0 20px orange;
        cursor: pointer;
        border-radius: 10px;
    }

    #last-rate-option {
        border-bottom: none;
    }
</style>