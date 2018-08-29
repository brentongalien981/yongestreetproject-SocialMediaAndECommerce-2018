<main id="my-store-items-holder" class="container-fluid">

    <!--  Store Name -->
    <h1 class="my-store-name">CJ's Store</h1>

    <!--  search-bar-plug-in -->
    <?php require_once(PUBLIC_PATH . "search-bar-plug-in/index/index.php"); ?>

    <!--  item-cards-holder -->
    <div id="item-cards-holder-actual-container" class="cn-container row justify-content-center">
        <?php require_once(PUBLIC_PATH . "item-card/index/index.php"); ?>
    </div>

    <!--  page-number-navigator -->
    <?php require_once(PUBLIC_PATH . "page-number-navigator/index/index.php"); ?>
</main>