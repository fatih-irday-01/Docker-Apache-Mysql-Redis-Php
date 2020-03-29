# Docker
test
Debian 10 üzerinden **nginx** ve **php** kurulumtur. __docker-composer.yml__ dosyasında **MySql** ve **Redis** de ekli. kullanılmayacağı durumda kaldırılabilir.

<br />

## Makefile

<center>

|komut|işlev|
|---|---|
|make build|Dockerfile'ı build eder|
|make up|docker-compose içindeki container'ları çalıştırır|
|make up-build|**make build** ve **make up** komutlarını birlikte çalıştırır|
|make down|Çalıştırılmış container'ları kapatır|

</center>

<br />

## Docker Container'larının adı
Docker Container'larının adı `Makefile` dosyasından `ApplicationName := lisans` değişkeninden verilebilir.

<br />

## Container'lar
Uygulamalar `docker-composer.yml` dosyasından düzenlenebilir.

<br />

## Uygulamalar
**PHP** uygulamalar `webSite` klasörü içerisinde yer alır.

<br />

---

# Uygulamanın kurulumu
İlk olarak repoyu locale indirin. 

`git clone https://git.macellan.net/rasit.ulcay/lisans.git lisance`

uygulamayı ayağa kaldırmak için

```bash
cd lisance
make up
```
İlk defa çalıştırıldığında *build* edileceği için biraz uzun sürecektir. `docker ps` komutu çalıştırıldığında
 
| IMAGE | PORTS | NAMES |
|---|---|---|
| mysql:5.7.27 | 33060/tcp, 0.0.0.0:3307->3306/tcp | lisans_db_1 |
| redis | 0.0.0.0:6379->6379/tcp | lisans_redis_1 |
| lisans_app | 0.0.0.0:8089->80/tcp | lisans_app_1 |


**App** containerinin içine girmek için 

`docker exec -it lisans_app_1 bash`

Containere girdikten sonra laraveli ayağa kaldıracağız.

```bash
cp .env.example .env 
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```
__.env__ dosyasında yapılacak değişiklilkler

```.dotenv
DB_CONNECTION=mysql
DB_HOST=lisans_db_1
DB_PORT=3306
DB_DATABASE=lisans
DB_USERNAME=lisans
DB_PASSWORD='y#cM8ORG0h'

REDIS_HOST=lisans_app_1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Şu an tüm uygulama çalışır durumda olmalı. [127.0.0.1:8089](http://127.0.0.1:8089/) linkinden uygulamaya ulaşabilirisin. 
**Mysql**'e erişmek için aşağıdaki configi kullanabilirsin.

<center>

| Host | PORT | User Name | Password |
|---|---|---|---|
| 127.0.0.1 | 3307 | lisans | y#cM8ORG0h |

</center>
