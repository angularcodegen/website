# Website theme

Custom WordPress theme for codegen.studio website

## Development Setup

### Prerequisites

- [Node.js](https://nodejs.org/en/) which includes [Node Package Manager](https://docs.npmjs.com/getting-started)
- [PHP](https://www.php.net/) >= 8.0
- [Composer](https://getcomposer.org/)
- [WordPress](https://pl.wordpress.org/) >= 6.0.0
- [ACF Plugin](https://www.advancedcustomfields.com/) >= 5.12

### Setting Up a Project

1. Clone repository into **themes** directory in your WordPress project

```shell
cd ./wp-content/themes/
git clone git@github.com:cdgstudio/website.git
```

2. Install PHP dependencies

```shell
php composer.phar install
```

3. Install Node.js dependencies

```shell
npm install
```

4. Active theme in admin panel

### Development

1. Run npm script to update styles for each change in `.scss` files

```shell
npm run css::watch
```