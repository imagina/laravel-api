# TODOs for User Module

## HardcodedConstants
- [ ] `defaultDays` para los tokens de Passport  
  📍 Ubicación: `App\Providers\UserServiceProvider::registerPassportConfigurations`  
  📎 Debe moverse a `config/passport.php` para mayor flexibilidad.

- [ ] Email y password del SuperAdmin  
  📍 Ubicación: `database/seeders/CreateUserSeeder.php`  
  📎 Peligroso en producción. Migrar a `.env` + referencia en config.

## Auth
- [ ] Socialite Implementation

## Seeder
- [ ] Add form default_register_user. Only if exist Iform Module
