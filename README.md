# Blue Fission Tenancy Addon

![Blue Fission Technology](https://bluefission.com/assets/img/logo-small.png)

## Overview

The **Tenancy Addon** is a multi-tenant management extension for the Opus framework by Blue Fission Technology. This addon is designed to provide robust and scalable multi-tenancy features, including tenant management, schema management, addon deployment, and logging, all while ensuring tenant isolation and security.

This addon allows you to manage multiple tenants within a single application, each with their own data schemas and configurations. It supports the installation of addons across multiple tenants, offering a modular approach to extending the functionality of your multi-tenant application.

## Features

- **Tenant Management:** Create, update, and delete tenants within the Opus framework. Manage tenant-specific configurations and ensure data isolation.
- **Schema Management:** Dynamically create, update, and delete schemas for tenants. Supports schema versioning and migrations.
- **Addon Deployment:** Install, uninstall, and manage addons across multiple tenants with ease. Each tenant can have its own set of active addons.
- **Logging:** Monitor and audit activities across all tenants with comprehensive logging features.
- **Backup Management:** Configure and manage backup schedules and retention policies for each tenant.

## Installation

### Install via Composer

1. **Add the package to your project**:
    ```bash
    composer require bluefission/tenancy-addon
    ```

2. **Activate the addon**:
    - Go to the Admin panel in your Opus application.
    - Navigate to the "AddOns" section.
    - Find the "Tenancy Addon" and click "Install".
    - After installation, click "Activate".

### Manual Installation

1. **Download the addon**:
    - Download the latest release from the [GitHub repository](https://github.com/bluefission/tenancy-addon).

2. **Upload the addon**:
    - Place the downloaded addon folder into the `addons` directory of your Opus application.

3. **Activate the addon**:
    - Go to the Admin panel in your Opus application.
    - Navigate to the "AddOns" section.
    - Find the "Tenancy Addon" and click "Install".
    - After installation, click "Activate".

## Usage

Once installed and activated, the Tenancy Addon provides a set of tools and services available through the Opus framework to manage tenants, schemas, and addons. You can access these features via the Admin panel or programmatically via the provided services and APIs.

### Managing Tenants
- Create and manage tenants through the Admin panel.
- Assign schemas and install addons specific to each tenant.

### Schema Management
- Create, update, and delete schemas within the Tenant management section.
- Manage schema versions and apply migrations.

### Addon Management
- Install or uninstall addons for individual tenants.
- Manage the state of addons (active/inactive) for each tenant.

### Logging and Backup
- Monitor tenant activities with the integrated logging service.
- Configure and manage backup schedules for tenant data.

## Contributing

Contributions are welcome! Please fork this repository and submit pull requests for any features, bug fixes, or improvements.

### Development

- Clone the repository:
  ```bash
  git clone https://github.com/bluefission/tenancy-addon.git
  ```

- Install dependencies:
  ```bash
  composer install
  ```

## License

This addon is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Support

For support and inquiries, please visit [Blue Fission Technology](https://www.bluefission.com) or open an issue on the [GitHub repository](https://github.com/bluefission/tenancy-addon/issues).

---

**Blue Fission Technology**  
Building the future with scalable, secure, and human-centric technology.