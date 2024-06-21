==============================================================================

### 1 Как в Вашем проекте используются принципы SOLID

    SRP: проекте есть сервисы который есть один отвественность
        напримерь: AuthService, TransactionService
    
    OCP: пока что в моем проекте невижу реализацио.
        Открыты для расширенияб закрыты для модификации уже работяюжего кода
    
    LSP: Функция который использует базовый, должный имет возможность использовать подтипы базового типа незная об этом
        Пример: Http/Middleware/LastSeenWatcherMiddleware.php есть метод "changeAuthUserLastSeenTime" который тип аргумента интерфейс
        "LastSeenWatcherInterface" и в нем свой метод "changeLastSeen"
    
    ISP: Разделения интерфейсы на мелкие, подбираем правильный абстракции 
        тоже подходит в примере LSP
    
    DIP: Инверсия зависимости используется в конструкторах сокторллеров для работы с Response (ResponseFactory) 
        и интерфейсы сервисов. Так-же используется в самих сервисов инверися зависимости Repository через Итерфейсы репозитории 

### Что по Вашему означает правильное использование PHPDoc? Приведите примеры в Вашем коде.
    
    В последних версиях PHP нетребуется описании PHPDoc как раньше,
    так как PHP сам идет к строго типизации и в сигнатурах методах описываетя типы в аргументах и в возвращаемый тип методов
    а также для свойсв класса.

    но бывает таке случай который надо пользоватся PHPDoc для урозании возможных типов полей, переменных и возвраящаемый тип методов

    например для модели используется отдельный пакет который сам описывает описания полей и методов
    "barryvdh/laravel-ide-helper"

    я использовал PHPDoc в несколько репозиториях и в ресурсах что бы PhpShtorm IDE тоже понял с каким типом работает и для получения боле явной инфы о свойстве моделя
    "UserResource", "UserRepository"

### Что Вам понравилось или не понравилось в PHP 7+?
    
    Типизация в PHP 7 внесла значительные улучшения в язык, позволяя указывать типы аргументов функций, типы возвращаемых значений и введя возможность объявления скалярных типов.

    Больше всего понравилос чем не понравилос, не помню минусов, строго типизация очень нравится мне.

    С помощью типизации можно предотвратить ошибки типов, которые могут возникнуть при передаче аргументов функциям или при возвращении значений.

### Как вы относитесь к типизации в PHP 7? Когда стоит использовать, когда нет?
    
    Типизацию отношусь очень положительно, стараюсь везде вставить там где возможно.
    
    если есть старый проект и не определен тип аргументов и возвращаемый типы аргументов и полей,
    если поля исползуется много где и пим может менятся
    
    
==============================================================================

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

==========================================================================================================
