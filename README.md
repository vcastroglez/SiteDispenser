# SiteDispenser

A tiny PHP dispatcher for serving several Laravel or static HTML projects from one host. Think of it as Apache’s much smaller cousin who skipped most of the manual.

It is useful for personal servers and local development when you have one domain, cannot create convenient subdomains, or simply do not feel like configuring another virtual host.

## What it does

Projects are placed under `projects/` and exposed through:

```text
/site/{project}
```

SiteDispenser can:

- discover projects from the filesystem;
- serve Laravel applications through their `public/index.php`;
- serve basic PHP projects;
- serve static HTML exports;
- route static project assets;
- provide each project with an appropriate `APP_URL`.

The homepage also produces a wonderfully unfancy list of available projects.

## Structure

```text
SiteDispenser/
├── projects/       # Hosted projects live here
└── public/
    ├── .htaccess   # Apache routing and required headers
    └── index.php   # Project dispatcher
```

## Apache setup

Point the virtual host’s document root at `public/` and ensure that:

- `mod_rewrite` and `mod_headers` are enabled;
- `.htaccess` overrides are permitted;
- the web server user can read the hosted projects.

## Status and safety

This is a personal deployment experiment, not a general-purpose or multi-tenant hosting platform.

Do not allow untrusted users to create or upload projects. Before exposing it more broadly, it should receive stricter path validation, cleaner error handling, access controls, and production-oriented logging.
