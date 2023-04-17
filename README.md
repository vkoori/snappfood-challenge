### Introduction

The challenge is considered as a microservice, so that it has the following services:

1. Vender
2. Agenet
3. User
4. Order
5. Delivery
6. Gateway
7. Workflow

It is assumed that the gateway service will log the user's IP and some other request information, and there is no need to log again in this service.

It is better for services to communicate with each other using `Protobuf`. (If I have time, I will refactor the project with this protocol)

### Installation

install `docker` according to official document

> If your server is in Iran, it is better to choose one of the following solutions:
>
> 1. use `https://registry.docker.ir` as `registry-mirrors`
> 2. use `shecan` service
>
> If your server is not in Iran, delete aminidc.com from the Dockerfile

> **Warning**
>
> When you pull the project from the repository, it's possible that "\r\n" was used instead of "\n" in `.docker/start.sh` file. Please replace all "\r\n" with "\n".

```shell
docker compose up -d --build
```

The Laravel sail package is much more extensive than we need, and in accordance with Docker's suggestion, instead of using a large image, we used a smaller custom image.

### Attentions:

1. Lumen has no config cache. So reading env directly is not a problem.
2. Rate limit is set on routes as an example. It is better to leave this restriction to pgp.
3. It is better to use tools like Sentry to error handling.
4.

### Postman:

Postman's information will be placed in `storage/doc` path.

You can also send a request to join the team through the [link](https://app.getpostman.com/join-team?invite_code=b350787dfee0667ce12fd3bed455af12).

### Partitioning

To avoid heavy reading from `delay_reports` table, we partition its data monthly.

we can change partitioning according to [this link](https://dev.mysql.com/doc/refman/8.0/en/partitioning-limitations-functions.html)

To make sure that the next month's partitioning is done, we run the `partition:delay_reports` command every day.

### Queue

Any fifo queue drive can be used

The list of queues is in the `App\Enums\Queues::class`. It is recommended to run the queues separately.
Also, the `AGENT_QUEUE` should not be run by cli.
The command to run the queue is as follows. which I must add in the `satrt.sh` file located in the Docker directory.

```shell
php artisan queue:work --queue=QUEUE_NAME
```

### Broadcast

After sending the delay report by the user, we immediately send `http response` and also create a `socket.io` connection, until in case of a delay in response or unavailability of other services, they will not cause any problems in the user's experience.

### Responses

All the responses that are sent must follow the same standard in both the origin and destination sides. These principles can be found in the `App\Resources` path.

### Tests

`php vendor\bin\phpunit`

### Get Orders

Requests to receive orders are fake in the following ways:

1. OrderId 1 : An order whose delivery time has not arrived
2. OrderId 2 : An order whose delivery time has arrived and has trip but has not been delivered
3. OrderId 3 : An order whose delivery time has arrived and has trip but has been delivered
4. OrderId 4 : An order whose delivery time has arrived and has not trip
5. Other OrderIds: timeout
