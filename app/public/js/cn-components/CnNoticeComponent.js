import CnComponent3 from './CnComponent3.js';
import CnNoticeComponentEventListeners from '../cn-event-listeners/CnNoticeComponentEventListeners.js';

export default class CnNoticeComponent extends CnComponent3 {

    constructor(data = { message: null }) {
        super();

        this.node = CnComponent3.cnCloneTemplate({ id: "cn-notice-component-template" });

        if (data.message != null) {
            $(this.node).find(".message-node").html(data.message);
        }

        this.extraMessageNode = $(this.node).find(".extra-message-node");
        this.dismissBtn = $(this.node).find(".dismiss-btn");



        // Event-handler.
        CnNoticeComponentEventListeners.implement({
            eventNames: ["onDismiss"],
            eventSource: this,
            eventHandler: this
        });
    }

    /** @implements */
    onDismiss() {
        $(this.node).remove();
    }

}