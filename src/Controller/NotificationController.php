<?php

namespace Ineph\NotificationBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Ineph\NotificationBundle\Entity\Notification;
use Ineph\NotificationBundle\NotifiableInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class NotificationController
 * the base controller for notifications
 */
class NotificationController extends AbstractController
{

    /**
     * List of all notifications
     *
     * @Route("/{notifiable}", name="notification_list", methods={"GET"})
     * @param NotifiableInterface $notifiable
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($notifiable, EntityManagerInterface $entityManager)
    {
        $notifiableRepo = $entityManager
            ->getRepository('InephNotificationBundle:NotifiableNotification');
        $notificationList = $notifiableRepo->findAllForNotifiableId($notifiable);
        return $this->render('@InephNotification/notifications.html.twig', array(
            'notificationList' => $notificationList,
            'notifiableNotifications' => $notificationList, // deprecated: alias for backward compatibility only
        ));
    }

    /**
     * Set a Notification as seen
     *
     * @Route("/{notifiable}/mark_as_seen/{notification}", name="notification_mark_as_seen", methods={"POST"})
     * @param int           $notifiable
     * @param Notification  $notification
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \LogicException
     */
    public function markAsSeenAction($notifiable, $notification)
    {
        $manager = $this->get('ineph.notification');
        $manager->markAsSeen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            $manager->getNotification($notification),
            true
        );

        //return new JsonResponse(true);

        $this->addFlash('success', "Vous venez de marquer comme lue");
        return $this->redirectToRoute('notification_list', ['notifiable' => $notifiable]);
    }

    /**
     * Set a Notification as unseen
     *
     * @Route("/{notifiable}/mark_as_unseen/{notification}", name="notification_mark_as_unseen", methods={"POST"})
     * @param $notifiable
     * @param $notification
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \LogicException
     */
    public function markAsUnSeenAction($notifiable, $notification)
    {
        $manager = $this->get('ineph.notification');
        $manager->markAsUnseen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            $manager->getNotification($notification),
            true
        );

        //return new JsonResponse(true);
        $this->addFlash('success', "Vous venez de marquer comme non lue");
        return $this->redirectToRoute('notification_list', ['notifiable' => $notifiable]);
    }

    /**
     * Remove a Notification
     *
     * @Route("/{notifiable}/remove/{notification}", name="notification_remove", methods={"POST"})
     * @param $notifiable
     * @param $notification
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \LogicException
     */
    public function removeAction($notifiable, $notification)
    {
        $manager = $this->get('ineph.notification');
        $manager->removeNotification(
            [$manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable))],
            $manager->getNotification($notification),
            true
        );

        //return new JsonResponse(true);
        $this->addFlash('success', "Vous venez de supprimer la notification");
        return $this->redirectToRoute('notification_list', ['notifiable' => $notifiable]);
    }

    /**
     * Set all Notifications for a User as seen
     *
     * @Route("/{notifiable}/markAllAsSeen", name="notification_mark_all_as_seen", methods={"POST"})
     * @param $notifiable
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function markAllAsSeenAction($notifiable)
    {
        $manager = $this->get('ineph.notification');
        $manager->markAllAsSeen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            true
        );

        //return new JsonResponse(true);
        $this->addFlash('success', "Vous venez de tout marquer comme lue");
        return $this->redirectToRoute('notification_list', ['notifiable' => $notifiable]);
    }
}
