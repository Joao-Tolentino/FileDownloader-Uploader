# FileDownloader-Uploader

[![License: AGPL v3](https://img.shields.io/badge/License-AGPL_v3-blue.svg)](LICENSE)
[![Platform: Windows](https://img.shields.io/badge/Platform-Windows-0078D6.svg?logo=windows&logoColor=white)](#)

A secure, session-based PHP application built to manage user-isolated file uploads and downloads. It features user authentication and protects your server by enforcing strict file size limits and name sanitization.

---

## Features

- **User Isolation**: Authenticated sessions dictate exactly where files are stored (`/storage/$user/`), ensuring zero overlap between different accounts.
- **Strict Size Limits**: The `upload.php` logic enforces a strict 10MB maximum file size upload ceiling to prevent server flooding.
- **Robust Security**: Uploaded filenames are scrubbed using a `preg_replace` Regex, stripped of special characters, and prefixed with `uniqid()` to prevent arbitrary code execution attacks.

---

## Quick Start

1. Clone or download the repository.
2. Ensure you have a local PHP web server installed (XAMPP, WAMP, or standalone PHP).
3. Place the repository inside your local web root.
4. Navigate your browser to the `public/index.php` directory.

---

## Configuration Details

No external database is required. The system handles "accounts" by utilizing simple PHP session keys to lock users into explicit folders inside the `storage/` directory automatically. Ensure PHP has write permissions to create new user directories inside `storage/`.

---

## Usage Guidelines

- **Login**: Authenticate at `index.php` using the user management system.
- **Upload**: Select a file under 10MB and click upload. The file is sanitized, renamed with a unique ID, and securely transported via `move_uploaded_file` into your isolated storage folder.
- **Dashboard**: Visit `dashboard.php` to view and download any of your previously uploaded files!
- **Logout**: End your session securely.

---

## Technical Documentation

For developers interested in directory structures, code architecture, or compilation guidelines, please refer to the **[Documentation.md](Documentation.md)** file.

---

## License

This project is licensed under the **GNU Affero General Public License Version 3 (AGPLv3)**. See the LICENSE file for details.
