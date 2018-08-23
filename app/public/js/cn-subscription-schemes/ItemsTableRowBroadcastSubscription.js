let broadcaster = null;
let events = {
    onRowClicked: {
        subscribers: []
    }
};
let subscribers = [];

export default class ItemsTableRowBroadcastSubscription {

    static implement(data = { broadcaster: null }) {

        if (data.broadcaster == null) { return; }

        if (broadcaster == null) {
            broadcaster = data.broadcaster;
        }

    }


    static broadcast(data = { eventName: null }) {

        switch (data.eventName) {
            case "onRowClicked":

                events.onRowClicked.subscribers.forEach(function (subscriber) {
                    subscriber.onRowClicked({ dataSourceObj: broadcaster.dataSource.obj });
                });
                break;
        }
    }

    static subscribe(data = { subscriber: null, eventNames: null }) {
        if (data.subscriber == null || data.eventNames == null) { return; }

        data.eventNames.forEach(function (eventName) {
            switch (eventName) {
                case "onRowClicked":
                    events.onRowClicked.subscribers.push(data.subscriber);
                    cnLog("subscribed to event: onRowClicked");
                    break;
            }
            subscribers.push(data.subscriber);
        });
    }
}