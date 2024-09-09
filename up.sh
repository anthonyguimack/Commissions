docker build -t comisions:1.0 .
docker run --name=comisions -d --env-file .env -p 8001:8000 comisions:1.0
# docker-compose build
# docker-compose --env-file .env  up -d 
