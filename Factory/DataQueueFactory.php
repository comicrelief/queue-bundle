<?php
namespace ComicRelief\QueueBundle\Factory;

use ComicRelief\QueueBundle\Service\DataQueue;
use Frost\Queue\Config\QueueConfig;
use Frost\Queue\Queue;

/**
 * Class DataQueueFactory
 * @package ComicRelief\QueueBundle\Factory
 */
class DataQueueFactory
{
    public static function create(array $settings, string $queueName)
    {
        $queueConfig = new QueueConfig();
        $queueConfig->setServerUri($settings['uri']);
        $queueConfig->setServerSecure($settings['secure']);
        $queueConfig->setCaCertPath($settings['caCert']);
        $queueConfig->setClientPrivateKeyPath($settings['clientPrivateKey']);
        $queueConfig->setClientPublicKeyPath($settings['clientPublicKey']);

        switch ($settings['lib']) {
            case 'amqpextension':
                $queue = new Queue\AmqpExtensionQueue($queueConfig);
                break;
            case 'amqplib':
            default:
                $queue = new Queue\PhpAmqpLibQueue($queueConfig);
                break;
        }
        return new DataQueue($queue, $queueName);
    }
}
