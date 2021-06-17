## Ticketing for Mien Dong Station - How to use
Laravel - VueJS - API

- Clone the repository with __git clone__

__Back-end__

- Go to the sub-folder `cd laravel-api`
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Add correct value of your domain for front URL in this variable: `FRONTPAGE_VERIFY_URL=[your_domain]/verify/`
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (it has some seeded data for your testing)
- Run __php artisan passport:install__


__Front-end__

- Go to the sub-folder `cd front`
- Copy __.env.local.example__ to __.env.local__ and edit URL of your API
- Run __npm install__ 
- Run __npm run serve__ 
- That's it: launch the URL that appears in the terminal - could be `http://localhost:8080`


## License

Basically, feel free to use and re-use any way you want.

---
