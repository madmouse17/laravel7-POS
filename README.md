# Laravel 7 POS
Untuk menggunakan aplikasi ini disarankan untuk menggunakan `PHP 7`
# Instalasi
 1.  Jalankan Command Prompt (cmd) dan arahkan ke folder 
 2. ketikkan `composer install` cmd
 3. copy .`env.example`jadi `.env
 4. ketikkan `php artisan key:generate` pada cmd
 5.  Import database `pos-atanltis.sql` 
 6. Ubah nama database di `.env` dengan database yang sudah anda import
 7. ketikkan `php artisan storage:link` pada cmd
 8. ketikkan `php artisan config:cache`pada cmd
 9. ketikkan `php artisan serve`
 10. lalu jalankan `http://localhost:8080`
 11. login menggunakan `email : admin@mail.com` & `password :admin`


# Screenshoot 
![Image 001](https://user-images.githubusercontent.com/33163281/129160501-e419bdc7-6fb1-492a-9ad4-e046c831edf3.png)

![Image 002](https://user-images.githubusercontent.com/33163281/129160507-0a739fb3-b355-4bde-8b44-91347f4ca5c0.png)

![Image 003](https://user-images.githubusercontent.com/33163281/129160509-796dc53f-e925-4ffd-92da-7e3f8644647f.png)

![Image 004](https://user-images.githubusercontent.com/33163281/129160510-943a1155-d681-4370-b864-64a6761fabd3.png)

![Image 005](https://user-images.githubusercontent.com/33163281/129160512-5e5925bb-88b2-4042-be0a-eabc6b2d3fc7.png)

![Image 006](https://user-images.githubusercontent.com/33163281/129160514-125dc9b6-4d1e-44fc-b821-c58643acb79b.png)

![Image 007](https://user-images.githubusercontent.com/33163281/129160517-f2be2d17-b264-42d3-aad4-3c0fb64d7e8e.png)
# Resources
 - [Spatie-permission](https://github.com/spatie/laravel-permission)
 - [Yajra Datables](https://github.com/yajra/laravel-datatables)
 - [Activity-log](https://github.com/spatie/laravel-activitylog)
