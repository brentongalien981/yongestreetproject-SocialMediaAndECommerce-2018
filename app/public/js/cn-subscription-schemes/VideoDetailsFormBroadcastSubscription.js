let broadcaster = null;
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

                subscribers.forEach(function (element) {
                    element.onVideoUpdateSuccess();
                });
                break;
        }
    }

    static subscribe(data = { subscriber: null }) {
        if (data.subscriber == null) { return; }

        subscribers.push(data.subscriber);
    }


}

export { VideoDetailsFormBroadcastSubscription as default }