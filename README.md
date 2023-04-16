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

### Broadcast

After sending the delay report by the user, we immediately send `http response` and also create a `socket.io` connection, until in case of a delay in response or unavailability of other services, they will not cause any problems in the user's experience.
