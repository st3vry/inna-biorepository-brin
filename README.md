<p align="center">
  <img src="public/images/inna-biorepo-red.png" alt="Indonesian Nucleotide Archive logo" width="280">
</p>

# Indonesian Nucleotide Archive (InNA)

InNA is a repository platform for storing, discovering, and sharing nucleotide
(DNA/RNA) data for life sciences, agriculture, biodiversity, and related
bioinformatics research. The application is developed by the Research Center
for Computing at the National Research and Innovation Agency (BRIN).

The public prototype is available at
[inna-prototype.brin.go.id](https://inna-prototype.brin.go.id/).

## What The Application Provides

- Public browsing of BioProjects, BioSamples, and BioArchives.
- Authenticated submission and management of projects, samples, archives,
  experiments, and runs.
- BRIN SSO login and user profile management.
- Permission-controlled data downloads and request approval workflows.
- Dataverse synchronization for projects, samples, archives, and data files.
- INNAlysis workflows backed by Galaxy.
- Organism and taxonomy lookups through the NCBI datasets API.
- Administrative and curator interfaces for metadata and release management.

## Technology Stack

- PHP 8.0.2 or newer with Laravel 9.
- MySQL, PostgreSQL, and optional MongoDB integrations, depending on the
  deployment configuration.
- Vue 3 and Vite for frontend assets.
- Livewire for server-driven interactive components.
- Composer and npm for dependency management.
- BRIN SSO, InnaKM, Dataverse, FTP/SFTP, and Galaxy integrations.

## Requirements

Install the following before setting up the application:

- PHP 8.0.2 or newer with the extensions required by Laravel and the selected
  database driver.
- Composer.
- Node.js and npm.
- A configured relational database.
- Access credentials for any integrations enabled in the deployment.

## Local Installation

```bash
git clone https://github.com/st3vry/inna-biorepository-brin.git
cd inna-biorepository-brin

composer install
cp .env.example .env
php artisan key:generate

npm ci
npm run build

php artisan storage:link
php artisan migrate
```

Set the database and integration values in `.env` before running migrations.
Do not commit `.env` or any access keys.

## Environment Configuration

At minimum, configure the application URL and database connection:

```dotenv
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inna
DB_USERNAME=root
DB_PASSWORD=
```

The application also reads these integration groups from `.env`:

| Integration | Environment keys                                                                                                                                 |
| ----------- | ------------------------------------------------------------------------------------------------------------------------------------------------ |
| BRIN SSO    | `OAUTH2_CLIENT_ID`, `OAUTH2_CLIENT_SECRET`, `OAUTH2_URL_ACCESSTOKEN`, `OAUTH2_URL_AUTHORIZE`, `OAUTH2_URL_RESOURCE_OWNER`, `OAUTH2_REDIRECT_URI` |
| InnaKM      | `API_INNAKM_BASE_URL`, `API_INNAKM_TIMEOUT`                                                                                                      |
| Dataverse   | `API_DATAVERSE_BASE_URL`, `API_DATAVERSE_TIMEOUT`, `API_DATAVERSE_API_KEY`                                                                       |
| SFTP        | `SFTP_HOST`, `SFTP_PORT`, `SFTP_USERNAME`, `SFTP_PASSWORD`, `SFTP_ROOT`, `SFTP_PRIVATE_KEY`                                                      |
| FTP         | `FTP_HOST`, `FTP_PORT`, `FTP_USERNAME`, `FTP_PASSWORD`, `FTP_ROOT`, `FTP_KEY`                                                                    |
| NCBI        | `NCBI_API_KEY`, `NCBI_API_URL`, `NCBI_QUERY_PATH`, `NCBI_NAME_PATH`, `NCBI_DATASET_PATH`                                                         |
| MongoDB     | `DB_MONGO`, `DB_MONGO_CONNECTION`, `DB_MONGO_HOST`, `DB_MONGO_PORT`, `DB_MONGO_DATABASE`                                                         |

Use environment-specific endpoints and credentials. The local `.env` should
contain values for the services that are required by that deployment; blank
optional integrations can remain disabled.

## Running Locally

Start Laravel and Vite in separate terminals:

```bash
php artisan serve
npm run dev
```

The application is then available at `http://127.0.0.1:8000` unless another
host or port is configured. After changing cached environment or service
configuration, clear the cache:

```bash
php artisan config:clear
php artisan cache:clear
```

## Main Routes

Public collection routes:

- `/bioprojects`
- `/biosamples`
- `/bioarchives`

Authenticated application routes:

- `/login/sso` for BRIN SSO login.
- `/dashboard` for user and administrative workflows.
- `/dashboard/innalysis_galaxy` for INNAlysis workflows.
- `/permission-request` for restricted data access requests.

API routes include organism lookups under `/api/organism` and INNAlysis
workflow operations under `/api/innalysisworkflows`.

To inspect the complete route table for the current checkout:

```bash
php artisan route:list
```

## Testing And Code Quality

Run the test suite with:

```bash
php artisan test
```

Format PHP code with Laravel Pint when appropriate:

```bash
./vendor/bin/pint
```

Build production frontend assets with:

```bash
npm run build
```

## Deployment Notes

- Set `APP_ENV=production` and `APP_DEBUG=false` in production.
- Use a strong application key and keep all API keys and credentials outside
  version control.
- Configure the SSO redirect URI to match the deployed application URL.
- Configure writable Laravel storage and run `php artisan storage:link`.
- Run `php artisan config:cache` only after all production environment values
  are present.
- Confirm database, Dataverse, file-transfer, and Galaxy connectivity before
  enabling submission or analysis workflows.

## License

This project is distributed under the license specified by the repository
maintainers.
