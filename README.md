# Symfony Attribute Routing MVP

Symfony MVP demonstrating PHP 8 attribute-based routing.
A minimal viable product (MVP) demonstrating the implementation of attribute-based routing in Symfony. This project showcases how to use PHP 8 attributes for defining routes in a Symfony application, providing a modern and clean approach to route configuration.

## Features

- PHP 8 attribute-based route definitions
- Custom attribute loader for Symfony routing
- Example API endpoint implementations
- Clean and minimal implementation

## Requirements

- PHP 8.0 or higher
- Symfony framework
- Composer for dependency management

## Installation

1. Clone the repository
2. Run `composer install` to install dependencies
3. Configure your web server to point to the `public` directory
4. Start the development server:
   ```bash
   php -S localhost:8000 -t public
   ```
5. Access the application at [http://localhost:8000](http://localhost:8000).

## Usage

The project demonstrates attribute routing through example endpoints. Here's a sample endpoint:

```php
#[Route('/api/example/{id}', methods: ['GET'])]
public function __invoke(Request $request, ?string $id = null): JsonResponse
{
    return new JsonResponse([
        'id' => $id,
        'message' => 'Data fetched successfully',
    ]);
}
```

## Project Structure

- `src/Api/` - Contains example API endpoints
- `src/Routing/` - Contains the custom attribute routing implementation
- `public/` - Web server entry point

## Contributing

Feel free to submit issues and enhancement requests.

## License

This project is open-source software licensed under the MIT license.
