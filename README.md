### Tech-test [Yaraku inc]
My technical test for Yaraku Inc.

### Setup
- DB
        
        php artisan migrate --seed
        (or)
        php artisan migrate:refresh --seed
        
- php packages
        
        composer install
        
- css & js
        
        cd public && yarn install (yarn or npm)


### Specs
- The attached image file is an example but feel free to solve the tasks in whatever manner you think is best and with the layout you consider to be the best.
- Use Laravel ([http://laravel.com](http://laravel.com/)) for the backend.
- Any persistence is okay, MySQL, SQLite etc. Just choose the one that feels most convenient. 
- Create a list of books, with the following functions,
    - Add a book to the list.
    - Delete a book from the list.
    - Change an authors name
    - Sort by title or author
    - Search for a book by title or author
    - Export the the following in CSV and XML
        - A list with Title and Author
        - A list with only Titles
        - A list with only Authors
