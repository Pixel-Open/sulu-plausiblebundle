# Plausible Bundle for Sulu

This bundle allows you to integrate Plausible analytics statistics into the Sulu administration interface via an embedded iframe.

## Installation

1. The bundle is already configured in the project
2. Configure the environment variables in your `.env` file:

```bash
# Plausible Configuration
PLAUSIBLE_DOMAIN=your-domain.com
PLAUSIBLE_BASE_URL=https://plausible.io
PLAUSIBLE_AUTH_KEY=your-auth-key
```

## Configuration

### Environment Variables

- `PLAUSIBLE_DOMAIN`: The domain configured in Plausible (required)
- `PLAUSIBLE_BASE_URL`: The base URL of your Plausible instance (default: https://plausible.io)
- `PLAUSIBLE_AUTH_KEY`: Authentication key for shared links (optional but recommended)

### Advanced Configuration

You can customize the configuration in `config/packages/plausible.yaml`:

```yaml
plausible:
    domain: 'my-site.com'
    base_url: 'https://analytics.my-domain.com'
    auth_key: '%env(PLAUSIBLE_AUTH_KEY)%'
```

## Usage

1. Log in to the Sulu administration
2. Click on "Plausible Statistics" in the navigation menu
3. Statistics are displayed in an integrated iframe

## Features

- ✅ Display Plausible statistics in Sulu admin
- ✅ Configuration via environment variables
- ✅ Support for custom Plausible instances
- ✅ Interface integrated with Sulu design
- ✅ Responsive and optimized for administration
- ✅ Multilingual support (English/French)
- ✅ Translation system using Sulu standards

## Requirements

- Sulu CMS ^2.6
- PHP ^8.2
- A Plausible account with a configured domain
- Public sharing enabled in Plausible for your site

## Translations

The bundle includes full translation support:

### Supported Languages
- **English** (`admin.en.json`)
- **French** (`admin.fr.json`)

### Translation Keys
- `plausible.statistics` - Main navigation title
- `plausible.configuration_missing` - Error message for missing config
- `plausible.domain_not_configured` - Domain configuration error
- `plausible.check_env_variable` - Environment variable check message
- `plausible.domain` - Domain label
- `plausible.statistics_for` - Iframe title with domain interpolation

### Adding New Languages
To add support for additional languages, create new translation files:
```
src/Resources/translations/admin.{locale}.json
```

## Notes

- Ensure that public sharing is enabled in your Plausible settings
- The iframe uses the parameters: `embed=true&theme=light&background=transparent`
- The bundle automatically integrates into the administration navigation
- All user-facing text uses Sulu's translation system for internationalization support