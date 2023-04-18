set -e

role=${CONTAINER_ROLE}
workdir=${WORKDIR}

if [ "$role" = "app" ]; then

    echo "Lumen has not cache configuration :)"
    (cd ${WORKDIR})

    echo "Running Application..."
    exec php-fpm

elif [ "$role" = "order-queue" ]; then

    echo "Running the order's queue..."
    (cd ${WORKDIR} && php artisan queue:work --queue=ORDER_QUEUE)

elif [ "$role" = "trip-queue" ]; then

    echo "Running the trip's queue..."
    (cd ${WORKDIR} && php artisan queue:work --queue=TRIP_QUEUE)

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
