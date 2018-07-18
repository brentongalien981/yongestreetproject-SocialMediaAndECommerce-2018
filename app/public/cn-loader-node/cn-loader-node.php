<style>
    #cn-loader-node-template {
        display: none;
    }

    .cn-loader-node {
        /* display: none; */
        width: inherit;
        background-color: white;
        border-radius: 5px;
    }

    .cn-loader-comment {
        text-align: center;
        font-weight: 100;
        font-size: 12px;
        padding-bottom: 15px;
    }

    .cn-loader-node img {
        display: block;
        width: 20%;
        margin: auto;
    }
</style>
<div id="cn-loader-node-template" class="cn-loader-node animated">
    <img src="<?= PUBLIC_LOCAL . "img/loading3.gif"; ?>">
    <h6 class="cn-loader-comment">We are searching for the best shipping options for you..</h6>
</div>