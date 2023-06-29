1) go to project-dir
2)sudo  docker-compose -f docker/docker-compose.yml up -d
3)sudo docker exec -it docker_app_1 bash
4)cd /var/www/app
5)composer install
6)your app will be http://localhost:8084
7) chmod -R 777 /var/www/app/backend/web/assets
   chmod -R 777 /var/www/app/backend/runtime
For tests - 
8) ./vendor/bin/codecept run
Access to backend app: admin/pass12345
