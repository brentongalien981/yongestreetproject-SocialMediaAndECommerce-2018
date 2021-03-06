let broadcaster = null;
let events = {
    onItemUpdateSuccess: {
        subscribers: []
    }
};
let subscribers = [];

export default class ItemsDetailsFormBroadcastSubscription {

    static implement(data = { broadcaster: null }) {

        if (data.broadcaster == null) { return; }

        if (broadcaster == null) {
            broadcaster = data.broadcaster;
        }

    }


    static broadcast(data = { eventName: null }) {

        switch (data.eventName) {
            case "onItemUpdateSuccess":

                events.onItemUpdateSuccess.subscribers.forEach(function (subscriber) {
                    subscriber.onItemUpdateSuccess({
                        updatedObj: broadcaster.dataSource.obj
                    });
                });
                break;
        }
    }

    static subscribe(data = { subscriber: null, eventNames: null }) {
        if (data.subscriber == null || data.eventNames == null) { return; }

        data.eventNames.forEach(function (eventName) {

            switch (eventName) {

                case "onItemUpdateSuccess":
                    events.onItemUpdateSuccess.subscribers.push(data.subscriber);
                    cnLog("subscribed to event: onItemUpdateSuccess");
                    break;
            }
            subscribers.push(data.subscriber);
        });
    }
}