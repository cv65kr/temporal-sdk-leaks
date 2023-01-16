### First CLI window

```
docker-compose up -d app temporal mysql temporal-admin-tools temporal-ui
docker-compose exec app composer install
docker-compose exec app rr serve -c .rr.dev.yaml
```

### Second CLI window
```
docker-compose exec app watch -n1 php trigger.php
```
