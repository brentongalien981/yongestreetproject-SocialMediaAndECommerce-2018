export default class ItemDetailsFormEventListeners {

    static implement(data = { eventNames: [], eventSource: null, eventHandler: null }) {

        if (data.eventNames == null || data.eventSource == null || data.eventHandler == null) { return; }

        data.eventNames.forEach(eventName => {

            switch (eventName) {
                case "onItemCreate":

                    let publishBtn = data.eventSource.childComponents.publishBtn;

                    $(publishBtn.node).click(function (event) {
                        event.preventDefault();
                        data.eventHandler.onItemCreate();
                    });

                    break;


                case "onItemUpdate":

                    let updateBtn = data.eventSource.childComponents.updateBtn;

                    $(updateBtn.node).click(function (event) {
                        event.preventDefault();
                        data.eventHandler.onItemUpdate();
                    });

                    break;                    
            }

        });
    }

}