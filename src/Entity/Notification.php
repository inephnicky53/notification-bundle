<?php

namespace Ineph\NotificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ineph\NotificationBundle\Model\Notification as NotificationModel;

/**
 * Class Notification
 *
 * @ORM\Entity
 * @package Ineph\NotificationBundle\Entity
 */
class Notification extends NotificationModel implements NotificationInterface
{

}