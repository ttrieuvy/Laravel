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

    -   route web: web.php
    -   route api: api.php
    -   route console: console.php
    -   route channels: channels.php

# day 2

## route

### method

-   tất cả các phương thức ngoại trừ GET và OPTION, muốn gửi được thì cần phải gọi token

```
    => csrf_token(): phải để trong 1 input
    => csrf_field(): laravel tự tạo input để dùng
```

1. match: nhận được nhiều request, nghĩa là khi bạn truy cập đến route bằng phương thức nào bạn đã khai báo ở Route thì bạn sẽ vô được Route đấy

```
   Route::match([$method, $method], 'duongDan', function (){});
```

2. any: chấp nhận tất cả các request, nghĩa là khi bạn truy cập đến route bằng bất cứ phương thức nào thì any nó cũng sẽ nhận

    ```
    Route::any('duongDan', function(){});
    ```

3. prefix: nhóm những route có cùng nhánh với nhau, để tiện sử dụng

```
Route::prefix('products')->group(function(){

    // lấy danh sách sản phẩm
    Route::get('/', [ControllerProduct::class, 'index'])->name('products.index');

    // lấy chi tiết 1 sản phẩm (GET)
    Route::get('/get-product/{id?}', [ControllerProduct::class, 'getProduct']);
});
```

### resource

-   Phương thức **_resource_** được sử dụng để định nghĩa một tập hợp các routes chuẩn RESTful (Representational State Transfer) cho một controller cụ thể. Khi bạn sử dụng nó, Laravel sẽ tự động tạo ra các routes chuẩn RESTful cho tất cả các phương thức trong controller, bao gồm:
    -   GET /categories: Hiển thị danh sách tất cả các danh mục.
    -   GET /categories/create: Trả về một biểu mẫu để tạo mới danh mục.
    -   POST /categories: Lưu trữ một danh mục mới vào cơ sở dữ liệu.
    -   GET /categories/{id}: Hiển thị thông tin chi tiết của một danh mục.
    -   GET /categories/{id}/edit: Trả về một biểu mẫu để chỉnh sửa danh mục.
    -   PUT /categories/{id}: Cập nhật thông tin của một danh mục.
    -   DELETE /categories/{id}: Xoá một danh mục khỏi cơ sở dữ liệu.

**route**

```
Route::prefix('admin')->group(function(){
    Route::resource('categories',CategoriesController::class);
});
```

-   Điều này sẽ giúp bạn trong việc cơ cấu lại các method của route và bạn sẽ ít phải tạo Route cho việc quản lý model lại hơn

**controller**

# day 3

## Route

### parameter

-   truyền para ở Route

```

Route::get('patch/{para1?}/{para2?}', function($para1=null, $para2=null))

```

-   với:

    -   patch là đường route

    -   para1, para2 là tham số truyền vào, khi thêm dấu '?' đằng sau para thì có nghĩa là para này có hay không cũng được, nhưng nếu muốn không có lỗi thì biến nhận giá trị của para phải khai báo giá trị mặc định

    -   $para1, $para2 là biến sẽ nhận giá trị từ para para1 và para2, 2 biến này được khai báo giá trị mặc định là null

    -   **vị trí tham số truyền vào như thế nào, thì đặt biến nhận giá trị cũng đúng vị trí như vậy**
    -   **para một khi đã định nghĩa trên patch thì bắt buộc phải có, trừ khi mình thêm dấu '?' để định nghĩa rằng tham số này có hay không cũng được**

-   đặt name cho route

    -   không có param

```

    => route 1
    Route::get('route1', function(){})->name(name-route1);
    => view 2
    <a href="<?php echo route('name-route1') ?>">Chuyển trang</a>

```

    -   có param

```

    => route 1
    Route::get('route1/{param1?}', function($param1=null){})->name(name-route1)
    => view 2
    <a href="<?php echo route('name-route1', [param1 => 123]) ?>">Chuyển trang</a>

```

# day 4

## Controller

-   Khởi tạo controller

```

    php artisan make:controller TenController

```

**lưu ý tên của controller phải trùng với tên class trong Controller**

-   muốn dùng controller nào thì phải khai báo controller đó trong web.php
-   có các method như sau POST, PUT, PATCH, DELETE, GET
    -   put: nếu như không tìm được data nào trùng với dữ liệu đầu vào thì thêm mới, còn nếu tìm được thì sẽ thay để toàn bộ các field
    -   patch: sẽ chỉ cập nhật những field mà người dùng nhập, những field người dùng không nhập sẽ để nguyên, nếu như không tìm thấy record trùng với đầu vào thì trả về kq false

## resource

-   tài liệu cũ ở #day2/route/resource

```
php artisan make:controller TenController --resource
```

-   là câu lệnh tạo ra 1 controller có sẵn những phương thức làm việc với model

# day 5

## middleware

-   được dùng để lọc các điều kiện mà mình định nghĩa để có thể thực hiện các bước tiếp theo, ví dụ như kiểm tra xem account có đủ quyền truy cập vào admin k.
-   middleware sẽ được chạy trước khi vô controller
-   Khởi tạo:

```
php artisan make:middleware TenMiddleware
```

_*Middleware/CheckLoginAdmin.php*_

```
public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
```

-   Với:

    -   **Request $request** là một đối tượng kiểm tra được truyền vào

    -   **Closure $next** là một closure đại diện cho middleware tiếp theo trong chuỗi middleware hoặc controller

-   chèn middle vào _*kernel.php*_

### global

-   khi bạn truy cập vào bất kì route nào thì middleware này cũng chạy

```
 protected $middleware = [
       [...]
      \App\Http\Middleware\CheckLoginAdmin::class,
      // namespace và class của Middleware/CheckLoginAdmin.php
    ];
```

### web, api

-   khi truy cập vào route của web với api thì mới chạy middleware này

```
protected $middlewareGroups = [
        'web' => [
          [...]
            \App\Http\Middleware\CheckLoginAdmin::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
```

### tự cấu hình

-   Khi tự cấu hình thì tại file kernel bạn chỉ đăng ký thôi, còn muốn sử dụng middleware thì bạn phải khai báo thêm bên route

_*kernel.php*_

```
protected $middlewareAliases = [
       [...]
        'checkLogin.admin' => \App\Http\Middleware\CheckLoginAdmin::class

    ];
```

-   với **\App\Http\Middleware\CheckLoginAdmin::class** là class được khai báo trong folder Middleware

_*web.php*_

```
Route::middleware('checkLogin.admin')->prefix('admin')->group(function(){
    Route::middleware('checkLogin.admin')->get('/', [CategoriesController::class, 'test']);

    Route::resource('categories',CategoriesController::class);
});
```

-   có thể đặt middleware cho group hay từng route đều được

-   tên middle sẽ được lấy ở file _*kernel*_

### xử lý tác vụ trong middleware

# day 6

## query builder

_*db_product*_

```
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use DB;

use Illuminate\Support\Facades\DB;
class db_product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function getAll(){
        $query = DB::table('db_product')->get();

        $kq = $query;

        return $kq;
    }
}
```

_*ProductsController*_

-   nhớ phải use model mà mình cần dùng vô thì mới dùng được

```
use App\Models\db_product;
```

-   constractor

```
private $products;
    public  function __construct(db_product $products)
    {
        $this->products = $products;
        echo 'khởi động';
    }
```

-   trả data về cho view

```
 public function index(){

       $data = $this->products->getAll();
       echo '<h1> hehe</h1>';
        return view('admin/products/product', ['id' => $data]);
    }
```
