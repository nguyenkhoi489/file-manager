# Laravel File Manager

File Manager is a package library for Create File Manager For Laravel App.

## Installation

## Step 1

Create folder "PACKAGES/NAME" in root laravel app.

Example

```bash
cd /path-laravel-app
```

```bash
mkdir packages/nguyenkhoi
```

```bash
cd packages/nguyenkhoi
```

## Step 2

Use the git clone repo

```bash
git clone https://github.com/nguyenkhoi489/file-manager.git 
```

## Step 3

Open file composer.json in root folder app & adding config

```bash
 "repositories": [
        {
            "type": "path",
            "url": "./packages/nguyenkhoi/*"
        }
    ]
```

```bash
    "require": {
         ...
        "nguyenkhoi/file-manager": "dev-master"
    },
```

## Step 4

Use command "Composer update"

## Step 5

```php
php artisan vendor:publish --tag=nkd-file-manager
```

## Step 6

```php
php artisan migrate
```

## USE

Include File

```php
 @include('file-manager::media')
```

Or

Add to your project with this cript

```html

<script src="{{ asset('vendor/file-manager/assets/js/CKMedia.js') }}"></script>
```

Or
Check exists for this script before add to your project

```html

<script defer>
    if (!document.querySelector(`script[src="{{ asset('vendor/file-manager/assets/js/CKMedia.js') }}"]`)) {
        let script = document.createElement('script');
        script.src = "{{ asset('vendor/file-manager/assets/js/CKMedia.js') }}";
        document.body.appendChild(script);
    }
</script>
```

How to use Function CKMedia

```javascript
    CKMedia.popup({
    isMultiple: false,
    isChoose: true,
    onInit: function (event) {
        event.on('files:choose', function (files) {
            //Handle Actions File
        })
    }
})
```

## CKEDITOR 4

```javascript
  CKEDITOR.replace('editor1',
    {
        filebrowserImageBrowseUrl: '{{ route('media.file - manager',['isChoose' => true]) }}',
        filebrowserImageUploadUrl: '{{ route('media.ckeditor4.upload', ['_token' => csrf_token()]) }}'
    }
);
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
