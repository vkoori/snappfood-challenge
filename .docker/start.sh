set -e

role=${CONTAINER_ROLE}
workdir=${WORKDIR}

if [ "$role" = "app" ]; then

    echo "Lumen has not cache configuration :)"
    (cd ${WORKDIR})

    echo "Running Application..."
    exec php-fpm

elif [ "$role" = "queue" ]; then

    echo "Running the queue..."
    (cd ${WORKDIR} && php artisan queue:work)

elif [ "$role" = "scheduler" ]; then

    echo "Running the scheduler..."
    while [ true ]
    do
      (cd ${WORKDIR} && php artisan schedule:run) &
      sleep 60
    done

else

    echo "Could not match the container role \"$role\""
    exit 1

fi
