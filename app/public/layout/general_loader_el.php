<style>
    .mcn-loader-el-template {
        display: none;
    }

    .mcn-loader-el {
        display: none;
        width: inherit;
        background-color: white;
        border-radius: 5px;
    }

    .mcn-loader-comment {
        text-align: center;
        font-weight: 100;
        font-size: 12px;
        padding-bottom: 15px;
    }

    .mcn-loader-el img {
        display: block;
        width: 20%;
        margin: auto;
    }
</style>
<div id="mcn-loader-el" class="mcn-loader-el-template">
    <img src="<?= PUBLIC_LOCAL . "img/loading3.gif"; ?>">
    <h6 id="loading-comment" class="mcn-loader-comment">We are searching for the best shipping options for you..</h6>
</div>