<?php

namespace Ineph\NotificationBundle;

final class InephNotificationEvents
{
    /**
     * Occurs when a Notification is created.
     *
     * @Event("Ineph\NotificationBundle\Event\NotificationEvent")
     */
    const CREATED = 'ineph.notification.created';

    /**
     * Occurs when a Notification is assigned to a NotifiableEntity.
     *
     * @Event("Ineph\NotificationBundle\Event\NotificationEvent")
     */
    const ASSIGNED = 'ineph.notification.assigned';

    /**
     * Occurs when a Notification is marked as seen.
     *
     * @Event("Ineph\NotificationBundle\Event\NotificationEvent")
     */
    const SEEN = 'ineph.notification.seen';

    /**
     * Occurs when a Notification is marked as unseen.
     *
     * @Event("Ineph\NotificationBundle\Event\NotificationEvent")
     */
    const UNSEEN = 'ineph.notification.unseen';

    /**
     * Occurs when a Notification is modified.
     *
     * @Event("Ineph\NotificationBundle\Event\NotificationEvent")
     */
    const MODIFIED = 'ineph.notification.modified';

    /**
     * Occurs when a Notification is removed.
     *
     * @Event("Ineph\NotificationBundle\Event\NotificationEvent")
     */
    const REMOVED = 'ineph.notification.removed';

    /**
     * Occurs when a Notification is deleted
     *
     * @Event("Ineph\NotificationBundle\Event\NotificationEvent")
     */
    const DELETED = 'ineph.notification.delete';
}
