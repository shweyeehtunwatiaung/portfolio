### Artisan Command

- php artisan make:controller PageController
- php artisan make:model Post -m
- php artisan make:model Post --migration
- php artisan migrate
- php artisan make:auth
- php artisan serve
- php artisan serve --port=3000
- php artisan make:middleware AuthWare
- php artisan make:seeder PostSeeder
- php artisan db:seed --class=PostSeeder
- php artisan db:seed
- php artisan migrate:reset 
- php artisan migrate
- php artisan migrate:fresh
- php artisan migrate:fresh --seed
- php artisan make:request PostRequest
- php artisan route:list
- php artisan make:resource PostResource
- php artisan tinker (laravel command line tool)

```
php artisan make:controller Backend/PostController -r
```

### Other Package

- composer require tymon/jwt-auth "1.*"

### Git 

git init
git add .
git commit -m "sample crud"
git remote add origin https://github.com/bm-member/bm-blog-2.git
git push -u origin master


### Todo
- search
- image upload
- factory
- login with username
- role and permission
- localization
- email verify
- api
- api auth
- api resouce
- sql query join

---

   <div class="form-group">
        <label>Profile Image</label>
        <input type="file" class="form-control-file" name="image">
    </div>
---
    $table->string('image')->nullable();
----

sidebar(layout/sidebar)

    @if(auth()->user()->image)
        <img src="{{ asset( 'upload/profile/' . auth()->user()->image) }}" class="img-circle elevation-2"
            alt="User Image">
    @endif

--- <img src="{{ asset( 'upload/profile/' .$shop->image) }}"
conrtoller

    
    if($request->hasFile('image')) {
        $img = $request->file('image');
        $folder = public_path('upload/profile/');
        $imgName = time() . '.' . $img->getClientOriginalExtension();
        $img->move($folder, $imgName);
        $old_folder=$folder.$user->image;
        if(file_exists($old_folder)){
            @unlink($old_folder);
        }
        $user->image = $imgName;
    }

    if($request->password !== null) {
        $user->password = bcrypt($request->password);
    }
    $user->save();

---
categories (name)
	
	- categories_shop ( category_id,shop_id )

	- belongsToManyy(Shop::class)

shop 	(name, description,address,latitude, longitude, image, active)
	
	- day_shop( day_id, shop_id, from_hours, from_minutes, to_hours, to_minutes )

	- belongsToMany(Category::class)
	- belongsToMany(Day::class)

day (name)

	- no

One to Many 
~~~~~~~~~~~
User
    - hasMany(Shop::class, 'created_by_id', 'id');

Shop
    - belongsTo(User::class, 'created_by_id');


git init
git add .