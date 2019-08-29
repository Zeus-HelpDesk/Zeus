# {{config('app.name')}}

---

- [Basic Overview](#basic-overview)
- [Requirements](#requirments)
- [License](#license)

<a name="basic-overview"></a>
## Basic Overview

> {warning} If you are a user looking for documentation please refer to the [user documentation](/docs/users/)

**{{config('app.name')}}** is a help desk software designed for multi-district school IT departments. This documentation is designed for the administrators in mind, all data in this documentation is as accurate as possible.

<a name="requirements"></a>
## Requirements
The following server requirements are required for this application to run properly.

- Caddy **OR** Nginx **OR** Apache2
- MySQL 5.7+
- Redis 5.0+
- PHP 7.2+
- **PHP Extensions**
    - PDO MySQL
    - GMP
    - GD
    - ZIP
    - JSON
    - MbString
    - Tokenizer
    - XML/DOM
    - CURL
    - OpCache (not required but recommended)

<a name="license"></a>
## License

Zeus Help-Desk 
Copyright (C) 2019 Matthew Kilgore

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.