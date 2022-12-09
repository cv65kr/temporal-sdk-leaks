FROM spiralscout/php81-grpc

COPY --from=spiralscout/roadrunner /usr/bin/rr /usr/bin/rr
COPY --from=composer /usr/bin/composer /usr/bin/composer

VOLUME /app
WORKDIR /app

ENTRYPOINT ["tail", "-f", "/dev/null"]
