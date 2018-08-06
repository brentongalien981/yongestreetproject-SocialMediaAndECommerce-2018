<div id="cn-notice-component-template" class="cn-notice-component animated">

    <p class="message-node">We are searching for the best shipping options for you..</p>

    <div class="extra-message-node"></div>

    <button class="btn btn-primary dismiss-btn">dismiss</button>
</div>

<style>
    #cn-notice-component-template {
        display: none;
    }

    .cn-notice-component {
        width: inherit;
        background-color: white;
        border-radius: 5px;
        padding: 30px;
        box-shadow: 0 0 20px lightblue;
    }

    .cn-notice-component .message-node,
    .cn-notice-component .extra-message-node {
        text-align: center;
        font-weight: 100;
        font-size: 14px;
        padding-bottom: 15px;
    }

    .cn-notice-component a {
        text-decoration: underline;
    }
</style>