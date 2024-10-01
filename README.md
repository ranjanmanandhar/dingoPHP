# DINGGO
## Description

A Laravel application for Dinggo task

## Installation
### Clone the repository:
   ```
   git clone git@github.com:ranjanmanandhar/dingoPHP.git
  ```
### Navigate to the project directory:
   
    cd dingoPHP
   
    
## Configuration

### Create a .env file in the root of the project directory copy from .env.example

    cp .env.example .env
    
### Build app through docker
   
    docker compose --build
    docker compose up -d
### Goto project inside docker 
    
    docker exec -it <container_name> bash
   
### Migrate and seed Database 
   
    php artiasn db:migrate --fresh
    php artisan db:seed
    
### The app will be running at
    http://localhost:8080

    



