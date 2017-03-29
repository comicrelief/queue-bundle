<?php
namespace ComicRelief\QueueBundle\Service;

use Frost\Queue;

/**
 * Class DataQueue
 * @package ComicRelief\QueueBundle\Service
 */
class DataQueue
{

    /**
     * @var Queue\Queue
     */
    protected $queue;

    /**
     * @var string
     */
    protected $queueName;

    /**
     * DataQueue constructor.
     * @param Queue\Queue $queue
     * @param string $queueName
     */
    public function __construct(Queue\Queue $queue, $queueName = 'default')
    {
        $this->setQueue($queue);
        $this->setQueueName($queueName);
    }

    /**
     * @return bool
     */
    public function publish($data)
    {
        return $this->getQueue()->publish($this->getMessage($data));
    }

    /**
     * @return Queue\Message
     */
    private function getMessage($data): Queue\Message
    {
        $message = new Queue\Message();
        $message->setQueueName($this->getQueueName());
        $message->setPayload($data);
        return $message;
    }


    /**
     * @return Queue\Queue
     */
    protected function getQueue(): Queue\Queue
    {
        return $this->queue;
    }

    /**
     * @param Queue\Queue $queue
     * @return DataQueue
     */
    protected function setQueue(Queue\Queue $queue): DataQueue
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->queueName;
    }

    /**
     * @param string $queueName
     * @return DataQueue
     */
    public function setQueueName(string $queueName): DataQueue
    {
        $this->queueName = $queueName;
        return $this;
    }

    /**
     * @return bool
     */
    public function getStatus()
    {
        return $this->getQueue()->getStatus();
    }
}
