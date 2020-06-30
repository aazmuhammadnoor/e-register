#### Work Around Untuk Permission Not Found

Edit File `vendor/spatie/laravel-permission/src/PermissionRegistrar.php@getPermissions()`, ganti

```
return $this->cache->rememberForever($this->cacheKey, function () {
    return app(Permission::class)->with('roles')->get();
    }
);
```

jadi

```
return app(Permission::class)->with('roles')->get();
```


### Default Passphare Tandatangan Digital

```
qwe1234.
```

Tambahkan Baris berikut di file `.env` dan jalankan `./clean.sh`

```
X-MPP-KEY=7b5ef3cfda4dec8740f8e554aa4602dd2257251685355d5835dd49132ca599bf
```


### Backup

untuk backup database saja

```
php artisan backup:run --only-db
```

untuk backup files saja

```
php artisan backup:run --only-files
```

untuk backup semua (db dan data)

```
php artisan backup:run
```

untuk melihat semua backup

```
php artisan backup:list
```

untuk menghapus semua backup *kecuali yang paling terakhir tidak akan dihapus*

```
php artisan backup:clean
```

untuk menjalankan scheduler backup, gunakan perintah berikut

```
php artisan schedule:run 1>> NUL 2>&1 &
```

backup akan dijankan secara otomatis sehari sekali setiap jam 1 malam.

```php
// Backup data dan database setiap jam 1 malam
$schedule->command('backup:monitor')->daily()->at('01:00');
```
