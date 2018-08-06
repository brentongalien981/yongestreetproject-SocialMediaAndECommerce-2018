export default class CnNoticeComponentEventListeners {

    static implement(data = { eventNames: [], eventSource: null, eventHandler: null }) {

        data.eventNames.forEach(eventName => {

            switch (eventName) {
                case "onDismiss":

                    $(data.eventSource.dismissBtn).click(function () {

                        data.eventHandler.onDismiss();
                    });

                    break;
            }

        });
    }

}