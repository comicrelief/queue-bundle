# Comic Relief QueueBundle
Wraps `comicrelief/queue` in a Symfony bundle way

## Usage
create a service like this:
```yaml
parameters:
    queue_config:
        uri: 'amqp://guest:guest@rabbitmq.local:5671'
        secure: true
        lib: amqplib # or amqpextension
        caCert: 'ssl/rabbitmq-server-cert.pem'
        clientPrivateKey: 'ssl/rabbitmq-client-private-cert.pem'
        clientPublicKey: 'ssl/rabbitmq-client-public-cert.pem'
services:
    queue.example:
        class: ComicRelief\QueueBundle\Service\DataQueue
        factory: ['ComicRelief\QueueBundle\Factory\DataQueueFactory', create]
        arguments:
            - '%queue_config%'
            - 'example'
```
and then in your code:
`$this->get('queue.example')->publish(['message']);`
