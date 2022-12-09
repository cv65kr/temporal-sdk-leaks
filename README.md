// First CLI window

docker-compose up -d
docker-compose exec app composer install
docker-compose exec app rr serve -c .rr.dev.yaml


// Second CLI window
docker-compose exec app watch -n1 php trigger.php


Open prometheus (UI: http://localhost:3000)
1. Add datasource - http://prometheus:9090
2. Open metrics browser and put `rr_temporal_workers_memory_bytes/1024/1024`


Steps to reproduce
1. Run 10 transactions
2. Wait 5min
3. Run another 20 transactions
