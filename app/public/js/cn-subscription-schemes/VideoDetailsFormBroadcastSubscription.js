let broadcaster = null;
let events = {
    onVideoUpdateSuccess: {
        subscribers: []
    },
    onVideoCreateSuccess: {
        subscribers: []
    }
};
let subscribers = [];

class VideoDetailsFormBroadcastSubscription {

    static implement(data = { broadcaster: null }) {

        if (data.broadcaster == null) { return; }

        if (broadcaster == null) {
            broadcaster = data.broadcaster;
        }

    }


    static broadcast(data = { eventName: null }) {

        switch (data.eventName) {
            case "onVideoUpdateSuccess":

                events.onVideoUpdateSuccess.subscribers.forEach(function (subscriber) {
                    subscriber.onVideoUpdateSuccess({ updatedObj: broadcaster.dataSource.obj });
                });
                break;
        }
    }

    static subscribe(data = { subscriber: null, eventNames: null }) {
        if (data.subscriber == null || data.eventNames == null) { return; }

        data.eventNames.forEach(function (eventName) {
            switch (eventName) {
                case "onVideoUpdateSuccess":
                    events.onVideoUpdateSuccess.subscribers.push(data.subscriber);
                    cnLog("subscribed to event: onVideoUpdateSuccess");
                    break;
            }
            subscribers.push(data.subscriber);
        });
    }


}

export { VideoDetailsFormBroadcastSubscription as default }