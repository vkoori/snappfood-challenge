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
