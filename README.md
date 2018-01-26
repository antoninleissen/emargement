# Emargement
A laravel project to develop an API for register students

Before beginning, you need to install two things :
  - Install docker : 
 
  ubuntu install link : https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/
  mac install link : https://docs.docker.com/docker-for-mac/install/#download-docker-for-mac
  windows install link : https://docs.docker.com/docker-for-windows/install/
         
  - Install docker-compose : https://docs.docker.com/compose/install/

# Start docker

Go on your docker directory, then in a terminal just do that : 
```
sudo docker-compose -f back.yml build
```
then start your docker : 
```
sudo docker-compose -f back.yml up
```

# Npm and Composer

Open a terminal and do : 
```
sudo docker ps
```
Pick the id number of php docker then do :
```
sudo docker exec -ti {yournumber} bash
```
Then do :
```
composer.phar install
```

Go on your back directory, then in a terminal do : 
```
npm install
``` 

# Migrate and Seeds

Open a terminal and do : 
```
sudo docker ps
```
Pick the id number of php docker then do :
```
sudo docker exec -ti {yournumber} bash
```
Then do for migrate (database creation) :
```
php artisan migrate
```
And do for seed (generate data):
```
php artisan db:seed
```


