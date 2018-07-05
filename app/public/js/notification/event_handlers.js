function addListenerToDeleteNotificationBtn(notificationEl, anXNotification, className) {
    var notificationId = anXNotification["notification_id"];

    var deleteNotificationBtn = $(notificationEl).find(".delete-notification-btn")[0];

    $(deleteNotificationBtn).click(function () {
        deleteXNotification(className, notificationId);
    });

}