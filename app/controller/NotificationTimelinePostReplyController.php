<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-01-09
 * Time: 05:31
 */

namespace App\Controller;

use App\Core\Main\MainController;


class NotificationTimelinePostReplyController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
    }

    protected function setSpecificQueryClauses() {

        $this->sanitizedFields['where_clause'] = "WHERE notified_user_id = {$this->session->actual_user_id}";
        $this->sanitizedFields['where_clause'] .= " AND notification_msg_id = 5";

        $this->sanitizedFields['order_by_field'] = "initiation_date";

        switch ($this->action) {

            case 'read':

                $this->sanitizedFields['where_clause'] .= " AND initiation_date < '{$this->sanitizedFields['earliestNotificationDate']}'";
                break;

            case 'fetch':

                $this->sanitizedFields['where_clause'] .= " AND initiation_date > '{$this->sanitizedFields['latestNotificationTimelinePostReplyElDate']}'";
                break;

        }
    }

    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':

                $this->menuObj->notification_id = null;
                $this->menuObj->timeline_post_reply_id = $this->sanitizedFields['timeline_post_reply_id'];

                break;

            case 'update':
                break;
            case 'read':
                break;

            case 'delete':

                $this->menuObj->notification_id = $this->sanitizedFields["notificationId"];
                break;

            case 'fetch':
                break;
            case 'patch':
                break;
        }
    }

    protected function delete()
    {

        // Delete this pseudo-child-obj first (NotificationRateableItemController)
        $isDeletionOk = $this->menuObj->deleteByPk();


        /* Then delete the pseudo-parent-obj (Notification). */
        if ($isDeletionOk) {

            // Get the FK
            $pseudoChildPkName = $this->menuObj->primary_key_id_name;
            $pseudoChildPkValue = $this->menuObj->$pseudoChildPkName;

            // Create the pseudo-parent obj.
            $pseudoParentNotification = new \App\Model\Notification();

            // Assign the PK for the pseudo-parent obj based on the
            // pseudo-child's FK.
            $pseudoParentPkName = $pseudoParentNotification->primary_key_id_name;
            $pseudoParentNotification->$pseudoParentPkName = $pseudoChildPkValue;


            //
            $isDeletionOk = $pseudoParentNotification->deleteByPk();
        }

        return $isDeletionOk;
    }


    /** @overrid */
    protected function create() {

        $timelinePostId = $this->sanitizedFields["timeline_post_id"];

        //
        $timelinePostSubscriptions = $this->menuObj->getSubscriptions($timelinePostId);

        //
        if (!$timelinePostSubscriptions) { return false; }

        //
        foreach ($timelinePostSubscriptions as $subscription) {

            //
            $subscriberUserId = $subscription->subscriber_user_id;
            $parentNotification = $this->createPseudoParent($subscriberUserId);

            //
            if (!$parentNotification) { return false; }

            //
            $this->menuObj->notification_id = $parentNotification->id;
            $isCreationOk = parent::create();
            if (!$isCreationOk) { return false; }

        }

        //
        return true;
    }

    private function createPseudoParent($notifiedUserId) {

        $pseudoParent = new \App\Model\Notification();

        $pseudoParent->id = null;
        $pseudoParent->notified_user_id = $notifiedUserId;
        $pseudoParent->notifier_user_id = $this->session->actual_user_id;
        $pseudoParent->notification_msg_id = 5;
        $pseudoParent->is_deleted = false;
        $pseudoParent->initiation_date = 'CURRENT_TIMESTAMP';

        $isCreationOk = $pseudoParent->create();

        if ($isCreationOk) { return $pseudoParent; }
        else { return false; }

    }

    protected function fetch() {
        return $this->read();
    }

    /** @override */
    protected function read() {

        $this->setSpecificQueryClauses();

        /* Sample notification message. */
        /*
         * Alice replied "tae" on Bren's wall post "champion OKC!".
         */

        try {

            /* Read pseudo-parent-notification objs. */
            $parentNotifications = $this->menuObj->getParentNotifications($this->sanitizedFields);


            /* Loop through all notification objs.*/
            foreach ($parentNotifications as $parentNotification) {

                /* Get the user who replied. */
                $notifier = $parentNotification->getNotifier();

                /* Get the reply msg. */
                $childNotificationTimelinePostReply = $parentNotification->getChildNotificationTimelinePostReply();

                $timelinePostReply = $childNotificationTimelinePostReply->getTimelinePostReply();


                /* Get the parent timeline-post. */
                $timelinePost = $timelinePostReply->getTimelinePost();

                /* Get the user who owns the parent timeline-post.*/
                $timelinePostOwner = $timelinePost->getTimelinePostOwner();



                /* Filter the extentional objs. */
                $parentNotification->filterExclude(['id', 'is_deleted']);
                $notifier->filterInclude(['user_id', 'user_name']);
                $childNotificationTimelinePostReply->filterExclude(['N*O*T*H*I*N*G']);
                $timelinePostReply->filterInclude(['parent_post_id', 'message']);
                $timelinePost->filterInclude(['owner_user_id', 'message']);
                $timelinePostOwner->filterInclude(['user_name']);


                /* Replace some obj's field name to avoid confusion. */
                $timelinePostReply->replaceFieldNamesForAjax(['message' => 'reply_message']);
                $timelinePost->replaceFieldNamesForAjax(['owner_user_id' => 'post_owner_user_id', 'message' => 'post_message']);
                $notifier->replaceFieldNamesForAjax(['user_name' => 'notifier_user_name']);
                $timelinePostOwner->replaceFieldNamesForAjax(['user_name' => 'post_owner_user_name']);



                /*
                 * Decide the mainly-referenced-obj (Notification),
                 * and combine it with all the necessary obs.
                 */
                $parentNotification->combineWithObj($notifier);
                $parentNotification->combineWithObj($childNotificationTimelinePostReply);
                $parentNotification->combineWithObj($timelinePostReply);
                $parentNotification->combineWithObj($timelinePost);
                $parentNotification->combineWithObj($timelinePostOwner);

                /* Add a carbon-date field to the obj. */
                $rawDateTimeFieldName = "initiation_date";
                $parentNotification->addReadableDateField($rawDateTimeFieldName);
            }


            /* NOTE: Returning a JSON obj automatically remove static fields. */
            foreach ($parentNotifications as $parentNotification) {
                $parentNotification->removeStaticFields();
            }

            //
            return $parentNotifications;
        }
        catch (\Exception $e) {

            $customErrorMsg = "Error reading NotificationTimelinePostReply.";
            array_push($this->json['comments'], $customErrorMsg);
            array_push($this->json['comments'], $e->getMessage());
        }

    }


    /** @override */
    protected function setFieldsToBeValidated()
    {

        switch ($this->action) {
            case 'create':

                $this->validator->fieldsToBeValidated['timeline_post_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'blank' => 1,
                    'numeric' => 1
                ];

                $this->validator->fieldsToBeValidated['timeline_post_reply_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'blank' => 1,
                    'numeric' => 1
                ];

                break;

            case 'update':
                break;
            case 'read':

                $this->validator->fieldsToBeValidated['earliestNotificationDate'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];

                break;
            case 'delete':

                $this->validator->fieldsToBeValidated['notificationId'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 14,
                    'blank' => 1,
                    'numeric' => 1
                ];

                break;

                break;

            case 'fetch':

                $this->validator->fieldsToBeValidated['latestNotificationTimelinePostReplyElDate'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];

                break;

            case 'patch':
                break;
        }
    }
}