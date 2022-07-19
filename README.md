# Multi Language Tutorial

you need to install this package
> composer require ssgroup/language

after install package you can publish vendor
> php artisan vendor:publish --tag=ssgroup

and check your browser
> {{url}}/ssgroup-language/admin/language

this this route is change your locale 

```
   Route::get('change/locale/{locale}', function($locale){

        if (! in_array($locale, ['en', 'np'])) {
            abort(400);
        }

           session()->put('locale', $locale);

        return redirect()->back();

    })->name('change.locale');
```
