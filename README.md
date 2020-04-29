# Mock-up bundle

A Symfony bundle for building html mock-ups.

## Installation

```sh
composer require itk-dev/mock-up-bundle
```

Add `ItkDev\MockUpBundle\ItkDevMockUpBundle` to `config/bundles.php`:

```php
return [
    …,
    ItkDev\MockUpBundle\ItkDevMockUpBundle::class => ['all' => true],
];
```

Import routes in `config/routes/itkdev_mockup.yaml`, say:

```yaml
itkdev_mockup:
    prefix: /mock-up
    resource: "@ItkDevMockUpBundle/Resources/config/routes.xml"
```

## Use

Create mock-up templates in `templates/mock-up` and go to `/mock-up` (`prefix`
key from `config/routes/itkdev_mockup.yaml`).
