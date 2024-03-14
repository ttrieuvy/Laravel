# day 1

## khởi tạo thư mục laravel

```
laravel new tenProject
```

## vòng đời request của laravel

1. đầu tiên sẽ chạy vào public/index.php
2. chạy vào boostrap/app.php
3. chạy vào app/http/kernel.php để tiền xử lý các request
4. chạy vào folder provider
5. chạy vào routes để xem xét nên chạy vào route nào
6. chạy vào middleware để lọc các điều kiện, nếu bộ lọc cho phép thì đi tiếp, không thì dừng lại
7. chạy vào controller để action đến xử lý từng model liên quan

## cấu hình laravel

1. tạo application_key
   => php artisan key:generate

2. timezone: config/app.php 'timezone'
   => app.php

3. app_debug(true/false): bật/tắt màn hình giao diện lỗi
   => .env
4. app_env: thay đổi môi trường từ local sang sản phẩm hoàn thiện
   vd: env => local =>thanh toán bằng call api sandbox (thanh toán ảo)
   env => production => call api live (thanh toán bằng tiền thật)

5. thiết lập csdl
   => tạo bảng mẫu bằng câu lệnh: php artisan migrate
   nó sẽ tạo ra các model mẫu trong table đã cấu hình trong file .env

6. Bật chế độ bảo trì

```
   php artisan down //turn on
   php artisan up //turn off
```

-   Khi bật chế độ này, bạn cần phải tạo 1 folder errors trong views để báo lỗi

## route

-   có 4 loại route

** route web: web.php
** route api: api.php
** route console: console.php
** route channels: channels.php

# day 2

## route

### method

-   tất cả các phương thức ngoại trừ GET và OPTION, muốn gửi được thì cần phải gọi token

```
    => csrf_token(): phải để trong 1 input
    => csrf_field(): laravel tự tạo input để dùng
```

1. match: nhận được nhiều request, nghĩa là khi bạn truy cập đến route bằng phương thức nào bạn đã khai báo ở Route thì bạn sẽ vô được Route đấy
   => Route::match([$method, $method], 'duongDan', function (){});

2. any: chấp nhận tất cả các request, nghĩa là khi bạn truy cập đến route bằng bất cứ phương thức nào thì any nó cũng sẽ nhận
   => Route::any('duongDan', function(){});

# day 3

## Route

### parameter

-   truyền para ở Route

```
   Route::get('patch/{para1?}/{para2?}', function($para1=null, $para2=null))
```

    với:

    -   patch là đường route
    -   para1, para2 là tham số truyền vào, khi thêm dấu '?' đằng sau para thì có nghĩa là para này có hay không cũng được, nhưng nếu muốn không có lỗi thì biến nhận giá trị của para phải khai báo giá trị mặc định
    -   $para1, $para2 là biến sẽ nhận giá trị từ para para1 và para2, 2 biến này được khai báo giá trị mặc định là null
        => vị trí tham số truyền vào như thế nào, thì đặt biến nhận giá trị cũng đúng vị trí như vậy
        => para một khi đã định nghĩa trên patch thì bắt buộc phải có, trừ khi mình thêm dấu '?' để định nghĩa rằng tham số này có hay không cũng được

-   đặt name cho route
    -- không có param
    => route 1
    Route::get('route1', function(){})->name(name-route1);
    => view 2
    <a href="<?php echo route('name-route1') ?>">Chuyển trang</a>

    -- có param
    => route 1
    Route::get('route1/{param1?}', function($param1=null){})->name(name-route1)
    => view 2
    <a href="<?php echo route('name-route1', [param1 => 123]) ?>">Chuyển trang</a>

# day 4

## Controller

-   Khởi tạo controller
    php artisan make:controller TenController
    => lưu ý tên của controller phải trùng với

-   muốn dùng controller nào thì phải khai báo controller đó trong web.php

## resource

php artisan make:controller TenController --resource

-   là câu lệnh tạo ra 1 controller có sẵn những phương thức làm việc với model
